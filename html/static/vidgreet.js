(function (vidGreet, undefined) {
    let bubble, video, _videoStart, _posterStart, _posterEnd, _videoLocation, _videoAspectRatio;
    let _ctaText, _ctaLink, _ctaCallback,_ctaStart, _ctaEnd, _ctaClass, _hasCTA = false;

    vidGreet.CTA = () => {
        console.log('ss');
    };

    /**
     * Initializes the video greeting widget with configuration options
     * @param {string} url - URL of the video to display
     * @param {Object} options - Configuration options
     * @param {number} [options.videoStart=0] - Time in seconds where video should start when maximized
     * @param {number} [options.posterStart=0] - Time in seconds where preview/poster should start
     * @param {number} [options.posterEnd=2] - Time in seconds where preview/poster should end and loop
     * @param {number} [options.delay=0] - Delay in milliseconds before initializing
     * @param {string} [options.location='left'] - Widget position ('left' or 'right')
     * @param {string} [options.aspectRatio='portrait'] - Video aspect ratio ('portrait', 'landscape', 'square', 'circle', 'custom')
     * @param {Object} [options.cta={}] - Call-to-action configuration
     */
    vidGreet.init = (url, { videoStart = 0, posterStart = 0, posterEnd = 2, delay = 0, location = 'left', aspectRatio = 'portrait', cta = {} } = {}) => {
        // Store configuration values
        _posterStart = posterStart;
        _posterStart = posterStart;
        _posterEnd = posterEnd;
        _videoStart = videoStart;
        _videoLocation = location === 'right' ? 'right' : 'left';
        _videoAspectRatio = ['portrait', 'landscape', 'square', 'circle', 'custom'].includes(aspectRatio) ? aspectRatio : 'portrait';

        // Configure CTA settings
        _ctaText = cta.text;
        _ctaLink = cta.link;
        _ctaCallback = cta.callback;
        _ctaStart = cta.start || 0;
        _ctaEnd = cta.end || 1e10;
        _ctaClass = cta.class || 'vidgreet-cta';

        // CTA is valid if it has text and either a link or callback
        _hasCTA = cta.text && (cta.link || cta.callback);

        // Initialize after page load with optional delay
        window.addEventListener("load", (event) => {
            setTimeout(() => {
                init(url);
            }, delay || 0);
        });
    }

    /**
     * Creates and injects the video widget DOM elements
     * @param {string} url - URL of the video to display
     */
    const init = (url) => {
        // Create main container
        const ele = document.createElement('div');
        ele.id = 'vidgreet';
        ele.style.opacity = .5; // Start semi-transparent until video loads
        ele.classList.add('minimized');
        ele.classList.add('vidgreet-' + _videoLocation);
        ele.classList.add('vidgreet-' + _videoAspectRatio);
        ele.innerHTML = `
          <div class="buttons">
            <button onclick="vidGreet.restart()"><svg fill="none" height="100%" viewBox="0 0 24 24" width="100%"
                xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd"
                  d="m13.7071 1.29289c.3905.39053.3905 1.02369 0 1.41422l-1.3018 1.30185c4.7824.21193 8.5947 4.15628 8.5947 8.99104 0 4.9706-4.0294 9-9 9-4.97056 0-9-4.0294-9-9 0-.5523.44772-1 1-1s1 .4477 1 1c0 3.866 3.13401 7 7 7 3.866 0 7-3.134 7-7 0-3.7226-2.9058-6.76651-6.573-6.98719l1.2801 1.28008c.3905.39053.3905 1.02369 0 1.41422-.3905.39052-1.0237.39052-1.4142 0l-3.00001-3c-.18753-.18754-.29289-.44189-.29289-.70711s.10536-.51957.29289-.70711l3.00001-3c.3905-.390521 1.0237-.390521 1.4142 0z"
                  fill="currentColor" fill-rule="evenodd" />
              </svg></button>
            <button id="volume" onclick="vidGreet.toggleMute()">
              <svg fill="none" height="100%" viewBox="0 0 24 24" width="100%" xmlns="http://www.w3.org/2000/svg">
                <path stroke-width="2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-linejoin="round"
                  d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z" />
                <path stroke-width="2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                  d="M17.25 9.75L19.5 12m0 0l2.25 2.25M19.5 12l2.25-2.25M19.5 12l-2.25 2.25m-10.5-6l4.72-4.72a.75.75 0 011.28.531V19.94a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.506-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.395C2.806 8.757 3.63 8.25 4.51 8.25H6.75z" />
              </svg>
            </button>
            <button onclick="vidGreet.minimize()"><svg fill="none" height="90%" viewBox="0 0 24 24" width="90%"
                xmlns="http://www.w3.org/2000/svg">
                <path d="m21 21-9-9m0 0-9-9m9 9 9.0001-9m-9.0001 9-9 9.0001" stroke="#000" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="2.5" />
              </svg></button>
              <a role="button" style="display: none;" class="${_ctaClass}" href="${_ctaLink}" id="vidgreet-cta">${_ctaText}</a>
          </div>
          <video id="video" autoplay playsinline muted width="384" height="216" src="${url}" data-minimized="true" onclick="console.log('ss');"></video>
        `;

        // Add widget to page and store element references
        document.body.appendChild(ele);
        bubble = document.getElementById('vidgreet');
        video = document.getElementById('video');

        // Set up video event listeners
        video.addEventListener('loadeddata', () => {
            bubble.style.opacity = 1; // Show widget once video is ready
            video.currentTime = _posterStart;

            // Add interaction event listeners
            bubble.addEventListener('click', vidGreet.maximize, false);
            video.addEventListener('ended', vidGreet.minimize, false);

            // Handle video timing for preview loop and CTA display
            video.addEventListener('timeupdate', () => {
                // Loop preview video when minimized
                if (bubble.classList.contains('minimized') && video.currentTime > _posterEnd - 0.75) {
                    video.currentTime = _posterStart
                }
                // Show CTA when appropriate
                if (bubble.classList.contains('maximized') && _hasCTA && video.currentTime >= _ctaStart && video.currentTime < _ctaEnd) {
                    document.getElementById('vidgreet-cta').style.display = 'block';
                }
            }, false);
        }, false);
    };

    /**
     * Restarts the video from the configured start time
     */
    vidGreet.restart = () => {
        video.currentTime = _videoStart;
    };

    /**
     * Toggles video mute state and updates UI
     */
    vidGreet.toggleMute = () => {
        video.muted = !video.muted;
        document.getElementById('volume').classList.toggle('muted');
    };

    /**
     * Expands the video widget to full size and starts playing from videoStart
     */
    vidGreet.maximize = () => {
        if (!bubble.classList.contains('minimized')) {
            return;
        }
        bubble.classList.remove('minimized');
        bubble.classList.add('maximized');
        video.muted = false;
        video.currentTime = _videoStart;
        video.setAttribute('data-minimized', "false");
    };

    /**
     * Minimizes the video widget and returns to preview state
     */
    vidGreet.minimize = () => {
        // Hide CTA when minimizing
        document.getElementById('vidgreet-cta').style.display = 'none';
        if (bubble.classList.contains('minimized')) {
            return;
        }
        // Small delay to allow for animations
        setTimeout(() => {
            bubble.classList.remove('maximized');
            bubble.classList.add('minimized');
        }, 10);
        video.muted = true;
        video.currentTime = _posterStart;
    };

}(window.vidGreet = window.vidGreet || {}));
