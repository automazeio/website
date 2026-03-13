<?php
class Install extends TinyController
{
    // Cache TTL for installation scripts (in seconds)
    private int $cacheTTL = 86400; // 1 day

    /**
     * Handles GET requests for the install endpoint.
     *
     * Detects the client type and serves the appropriate installation script
     * (PowerShell for Windows, bash for Linux/macOS) or redirects browsers
     * to documentation.
     *
     * @param object $request The request object containing query parameters
     * @param object $response The response object for redirects
     * @return void Exits after serving script or redirecting
     */
    public function get($request, $response)
    {

        // Define repository paths for installation scripts
        $repos_paths = [
            'proof' => [
                'repo' => 'automazeio/proof',
                'install_files' => 'install'
            ]
        ];

        // Redirect to home if the path section is not recognized
        if (!in_array($request->path->section, array_keys($repos_paths))) {
            $response->redirect('/', 302);
        }

        $repo_url = $repos_paths[$request->path->section]['repo'] ?? null;
        $repo_install_url = str_replace('//', '/', $repo_url . '/refs/heads/main/' . $repos_paths[$request->path->section]['install_files'] .'/');

        // Detect the client type from User-Agent header
        $clientType = $this->detectClient();

        // Allow manual override via path parameter
        // Supports: 'browser', 'windows', 'linux', 'macos'
        $view = $request->path->section ?? 'browser';

        $context = stream_context_create(array(
            'http' => array(
                'method' => 'GET',
                'header' => "Accept: application/vnd.github.raw\r\n"
            )
        ));

        // Serve PowerShell script for Windows clients or explicit Windows view
        if ($clientType === 'powershell' || $view === 'windows') {
            // Serve PowerShell script
            header('Content-Type: text/plain; charset=utf-8');
            echo tiny::cache()->remember($request->path->section . ':install.ps1', $this->cacheTTL, function () use ($repo_install_url, $context) {
                return file_get_contents('https://raw.githubusercontent.com/' . $repo_install_url . 'install.ps1', false, $context);
            });
            exit;
        }

        // Serve bash script for curl/wget clients or explicit Linux/macOS views
        elseif ($clientType === 'curl' || $clientType === 'wget' || $view === 'linux' || $view === 'macos') {
            // Serve bash script
            header('Content-Type: text/plain; charset=utf-8');
            echo tiny::cache()->remember($request->path->section . ':install.sh', $this->cacheTTL, function () use ($repo_install_url, $context) {
                return file_get_contents('https://raw.githubusercontent.com/' . $repo_install_url . 'install.sh', false, $context);
            });
            exit;
        }
        // Redirect browsers to documentation page
        else {
            // Redirect browsers to documentation
            $response->redirect('https://github.com/' . $repo_url, 302);
        }
    }


    /**
     * Detects the client type from User-Agent string.
     *
     * Analyzes the User-Agent header to determine if the request is coming
     * from PowerShell, curl, wget, or a web browser. Used to serve the
     * appropriate installation script.
     *
     * @param string|null $userAgent Optional User-Agent string for testing.
     *                                If null, uses $_SERVER['HTTP_USER_AGENT']
     * @return string Client type: 'powershell', 'curl', 'wget', or 'browser'
     */
    private function detectClient(?string $userAgent = null)
    {
        // Use provided User-Agent or fall back to server variable
        // Default to empty string if neither is available
        $userAgent = $userAgent ?? $_SERVER['HTTP_USER_AGENT'] ?? '';
        // Normalize to lowercase for case-insensitive matching
        $ua = strtolower($userAgent);

        // PowerShell detection (Windows)
        // Check for both 'windowspowershell' and 'powershell' identifiers
        if (
            strpos($ua, 'windowspowershell') !== false ||
            strpos($ua, 'powershell') !== false
        ) {
            return 'powershell';
        }

        // curl detection (Linux/macOS)
        // curl is commonly used on Unix-like systems
        if (strpos($ua, 'curl') !== false) {
            return 'curl';
        }

        // wget detection (Linux)
        // wget is another common command-line download tool
        if (strpos($ua, 'wget') !== false) {
            return 'wget';
        }

        // Invoke-WebRequest detection (PowerShell modern)
        // PowerShell's Invoke-WebRequest cmdlet uses this User-Agent
        if (strpos($ua, 'invoke-webrequest') !== false) {
            return 'powershell';
        }

        // Default to browser if no command-line tool detected
        return 'browser';
    }
}
