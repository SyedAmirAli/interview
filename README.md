# General Information Management App

A brief description of what your project does and its purpose.

## Table of Contents

-   [Installation](#installation)
-   [Running the Project](#running-the-project)
-   [Testing](#testing)
-   [Technologies Used](#technologies-used)
-   [License](#license)

## Installation

### Prerequisites

Ensure you have the following installed on your system:

-   **PHP** >= 8.1
-   **Composer** >= 2.0
-   **Node.js** >= 18.0
-   **SQLite** (or any database you're using)
-   **Git**

### Steps

1. **Clone the repository:**

    ```bash
    git clone https://github.com/yourusername/yourproject.git
    cd yourproject
    ```

2. **Install PHP dependencies:**

    ```bash
    composer install
    ```

3. **Install Node.js dependencies:**

    ```bash
    npm install
    ```

4. **Copy the `.env` file:**

    ```bash
    cp .env.example .env
    ```

5. **Set up your database:**

    In the `.env` file, set up your database connection details. For SQLite, it might look something like this:

    ```dotenv
    DB_CONNECTION=sqlite
    DB_DATABASE=/absolute/path/to/your/database.sqlite
    ```

    Ensure that the SQLite database file exists, or create it using:

    ```bash
    touch database/database.sqlite
    ```

6. **Generate an application key:**

    ```bash
    php artisan key:generate
    ```

7. **Run the migrations:**

    ```bash
    php artisan migrate
    ```

8. **Build the front-end assets:**

    Since you're using Vite with Vue CDN:

    ```bash
    npm run dev
    ```

    To build for production:

    ```bash
    npm run build
    ```

## Running the Project

1. **Start the development server:**

    ```bash
    php artisan serve
    ```

2. **Access the application:**

    Open your browser and navigate to `http://localhost:8000`.

## Testing

To test the project, you can either run automated tests (if you've written any) or manually test the functionality by interacting with the application in the browser.

### Automated Tests

To run automated tests, use:

```bash
php artisan test
```
