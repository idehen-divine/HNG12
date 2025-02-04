# HNG 12 Tasks Repo - Laravel Backend

This project is part of the HNG12 Internship tasks for backend developers. It is a simple Laravel API that returns basic information in JSON format.

## Project Description

### Stage 0: API to Retrieve Basic Information
This API provides the following information:
- **Email:** My registered email address on the HNG12 Slack workspace.
- **Current DateTime:** The current date and time in ISO 8601 format (UTC).
- **GitHub URL:** The URL of this project's codebase hosted on GitHub.

#### Features

- **Public API Endpoint:** Accepts GET requests and returns a JSON response.
- **Dynamic Timestamp:** Generates the current datetime dynamically.
- **CORS Support:** Configured to allow cross-origin requests.
- **Built with Laravel:** Utilizes Laravel's robust framework to build RESTful APIs.
- **Continuous Deployment:** Integrated with GitHub Actions for automatic deployment.

### Stage 1: Number Classification API

This API classifies a given number based on mathematical properties and provides a fun fact about it.

#### Features

- **Classifies a Number:** Determines if the number is **prime, perfect, Armstrong, even, or odd**.
- **Computes Digit Sum:** Sums up the digits of the number.
- **Fetches a Fun Fact:** Retrieves a fun fact from the Numbers API.
- **Public API Endpoint:** Accepts GET requests and returns a JSON response.
- **CORS Support:** Configured to allow cross-origin requests.
- **Built with Laravel:** Uses Laravel's RESTful API capabilities.
- **Deployed & Publicly Accessible:** Available online for testing.

## Technologies Used

- [Laravel](https://laravel.com/) (PHP Framework)
- PHP 8.x
- GitHub Actions (for CI/CD)

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

For the full API reference including endpoint details, parameters, and examples, please refer to the auto-generated documentation provided by Scribe:

[View API Documentation](https://hng12-backend.koyeb.app/)

## Deployment

This project is set up for continuous deployment using GitHub Actions. Every push to the `main` branch triggers a deployment workflow.
## Useful Links

- [Hire PHP Developers](https://hng.tech/hire/php-developers)
- [Laravel Documentation](https://laravel.com/docs)

---

*Good luck to all the HNG Backend interns!*
