# HNG Stage 0 API Task - Laravel Backend

This project is part of the HNG12 Internship Stage 0 task for backend developers. It is a simple Laravel API that returns basic information in JSON format.

## Project Description

This API provides the following information:
- **Email:** Your registered email address on the HNG12 Slack workspace.
- **Current DateTime:** The current date and time in ISO 8601 format (UTC).
- **GitHub URL:** The URL of this project's codebase hosted on GitHub.

## Features

- **Public API Endpoint:** Accepts GET requests and returns a JSON response.
- **Dynamic Timestamp:** Generates the current datetime dynamically.
- **CORS Support:** Configured to allow cross-origin requests.
- **Built with Laravel:** Utilizes Laravel's robust framework to build RESTful APIs.
- **Continuous Deployment:** Integrated with GitHub Actions for automatic deployment.

## Technologies Used

- [Laravel](https://laravel.com/) (PHP Framework)
- PHP 8.x
- GitHub Actions (for CI/CD)
- Railway.app

## Getting Started

### Prerequisites

- PHP >= 8.0
- Composer
- A local development environment (e.g., [XAMPP](https://www.apachefriends.org/index.html), or Docker)
- Git

### Installation

1. **Clone the Repository:**

   ```bash
   git clone https://github.com/idehen-divine/HNG12.git
   cd HNG12
   ```

2. **Install Dependencies:**

   ```bash
   composer install
   ```

3. **Copy `.env` File and Generate App Key:**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Set Timezone to UTC in `.env`:**

   Ensure the following line is present in your `.env` file:

   ```dotenv
   APP_TIMEZONE=UTC
   ```

5. **Start the Local Development Server:**

   ```bash
   php artisan serve
   ```

   The API will be accessible at: `http://127.0.0.1:8000/api`

## API Documentation

### Endpoint

- **URL:** `/api`
- **Method:** `GET`
- **CORS:** Enabled (allows all origins)

### Response Format

On a successful request (HTTP 200 OK), the API returns a JSON response in the following format:

```json
{
  "email": "your-email@example.com",
  "current_datetime": "2025-01-30T09:30:00Z",
  "github_url": "https://github.com/yourusername/your-repo"
}
```

- **email:** Replace this with your registered email.
- **current_datetime:** A dynamically generated ISO 8601 timestamp in UTC.
- **github_url:** The link to this GitHub repository.

### Example Request using `curl`

```bash
curl -X GET https://your-deployed-api-url/api
```

### Example Response

```json
{
  "email": "your-email@example.com",
  "current_datetime": "2025-01-30T09:30:00Z",
  "github_url": "https://github.com/yourusername/your-repo"
}
```

## Deployment

This project is set up for continuous deployment using GitHub Actions. Every push to the `main` branch triggers a deployment workflow to your chosen hosting platform (e.g., Railway.app, Heroku).

### GitHub Actions Workflow

The deployment workflow is defined in `.github/workflows/deploy.yml` and includes steps for:
- Checking out the repository.
- Setting up PHP.
- Installing Composer dependencies.
- Deploying to the hosting platform using Railway CLI or other relevant tools.

Ensure you add your hosting platform token (e.g., `RAILWAY_TOKEN`) to the repository secrets.

## Useful Links

- [Hire PHP Developers](https://hng.tech/hire/php-developers)
- [Laravel Documentation](https://laravel.com/docs)

## License

This project is open-source and available under the [MIT License](LICENSE).

---

*Good luck to all the HNG Backend interns!*
