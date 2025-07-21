# Automaze Website

## Development Setup

### Prerequisites

- PHP 8.3+
- Composer
- MySQL/MariaDB
- Stripe API credentials
- Twilio account for SMS verification

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/campaign-refinery/account-portal.git
   cd account-portal
   ```

2. Initialize the Tiny framework submodule:

   ```bash
   git submodule update --init --recursive
   ```

3. Install dependencies:

   ```bash
   composer install
   ```

4. Set up environment variables:

   ```bash
   cp .env.example .env
   # Edit .env with your database, Stripe, and Twilio credentials
   ```

5. Run database migrations:

   ```bash
   php tiny migrate
   ```

6. Start the development server:

   ```bash
   php -S localhost:8000 -t public/
   ```

## Docker Setup

### Prerequisites

- Docker
- Docker Compose
- Git

### Installation with Docker

1. Clone the repository:
   ```bash
   git clone https://github.com/campaign-refinery/account-portal.git
   cd account-portal
   ```

2. Initialize the Tiny framework submodule:
   ```bash
   git submodule update --init --recursive
   ```

3. Set up environment variables:
   ```bash
   cp .env.local.example .env.local
   # Edit .env.local with your configuration
   ```

4. Start the Docker container:
   ```bash
   docker-compose up -d
   ```

5. Install dependencies:
   ```bash
   docker-compose exec app composer install
   ```

6. Run database migrations:
   ```bash
   docker-compose exec app php tiny migrate
   ```

7. Access the application:
   ```
   http://localhost:2345
   ```

### Production Deployment with Docker

The application has been successfully dockerized and deployed to production. The production setup includes:

- Optimized container configuration for performance and security
- Environment-specific configuration management
- Proper volume mounting for persistent data
- Integration with production services
- Enhanced PHP functionality through php84-pecl-excimer extension

### Development with Docker

- View logs:
  ```bash
  docker-compose logs -f app
  ```

- Access shell:
  ```bash
  docker-compose exec app sh
  ```

- Rebuild container after Dockerfile changes:
  ```bash
  docker-compose up -d --build
  ```

### Directory Mounting

The setup mounts these directories:
- Project root to `/var/www`
- `storage` directory for logs and uploads

## Integration Guide

### Campaign Refinery Integration

To integrate with the Campaign Refinery main application:

```php
// In Campaign Refinery application
class AccountController
{
    public function redirectToAccountPortal()
    {
        $userId = $_SESSION['account_id'];
        $timestamp = time();
        $secret = config('account_portal.secret');

        // Generate hash
        $payload = json_encode([
            'userId' => $userId,
            'origin' => 'campaign_refinery',
            'timestamp' => $timestamp
        ]);

        $hash = hash_hmac('sha256', $payload, $secret);

        // Redirect to account portal with hash
        header('Location: ' . config('account_portal.url') . '/auth/' . $hash);
        exit;
    }
}
```

### Toolbox Integration

Similar to Campaign Refinery integration, but with 'toolbox' as the origin.

### Core Email Service Integration

Integration with the Core Email Service is now complete, with authentication hashes enabling seamless navigation between the services:

```php
// In Core Email Service application
class AccountController
{
    public function redirectToAccountPortal()
    {
        $userId = $_SESSION['account_id'];
        $timestamp = time();
        $secret = config('account_portal.secret');

        // Generate hash
        $payload = json_encode([
            'userId' => $userId,
            'origin' => 'core_email_service',
            'timestamp' => $timestamp
        ]);

        $hash = hash_hmac('sha256', $payload, $secret);

        // Redirect to account portal with hash
        header('Location: ' . config('account_portal.url') . '/auth/' . $hash);
        exit;
    }
}
```

### Unified Logout Experience

The platform now supports a unified logout experience across integrated services:

```php
// In Account Portal
class AuthController
{
    public function logout()
    {
        // Clear local session
        session_destroy();

        // Determine origin service to redirect back to
        $origin = $_SESSION['origin'] ?? 'default';

        // Redirect to origin service logout endpoint with return hash
        $timestamp = time();
        $secret = config('auth.secret');

        $payload = json_encode([
            'userId' => $_SESSION['user_id'],
            'action' => 'logout',
            'timestamp' => $timestamp
        ]);

        $hash = hash_hmac('sha256', $payload, $secret);

        // Redirect to appropriate origin logout URL
        $logoutUrl = $this->getLogoutUrlForOrigin($origin, $hash);
        header('Location: ' . $logoutUrl);
        exit;
    }
}
```

## Backend Integration

The Account Portal UI interacts with the existing backend systems through:

1. **User Management**: Centralized user creation and authentication
2. **Transaction Data Display**: All transaction data is fetched from Clickhouse for display purposes
3. **Settlement Processing**: The backend handles all settlement creation and processing
4. **Charge Management**: The backend system manages all subscription top-ups, credits, and actual charges
5. **Stripe Event Handling**: Payment events from Stripe are processed by the backend system

## Security Considerations

- All authentication hashes expire after 5 minutes
- OTP verification for new account registration
- CSRF protection on all forms
- Rate limiting on authentication endpoints
- Input validation and sanitization
- XSS protection via proper output escaping
- Session security with HTTP-only cookies
- Role-based access control with ownership validation for billing features
- Billing feature access restricted to billing account owners only
- Non-owner accounts receive limited access with appropriate UI guidance
- Improved redirect logic for handling missing query parameters securely
- Enhanced webhook validation with proper error handling

## License

Proprietary - Copyright © 2025 Campaign Refinery
