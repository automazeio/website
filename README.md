# Automaze Website

## Development Setup

### Prerequisites

- PHP 8.3+
- Composer

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/automazeio/website.git
   cd website
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
   # Edit .env as needed
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
   git clone https://github.com/automazeio/website.git
   cd website
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

## License

Proprietary - Copyright © 2025 Automaze, Ltd.
