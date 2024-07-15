
# Bank System App

## Project Overview
This project involves implementing a Laravel-based API system for a bank scenario. The goal is to create a system that manages user accounts, card transactions, and communicates via SMS services.

## Prerequisites
- PHP (preferably the latest version)
- Composer
- Laravel framework
- A database management system (MySQL, PostgreSQL, etc.)

## Installation and Setup

### Step 1: Clone the Repository
Clone this repository from GitHub or GitLab to your local machine:
```bash
git clone https://github.com/alirezaabdolmaleki/bank-system-app.git
cd bank-system-app
```

### Step 2: Install Dependencies
Use Composer to install the necessary dependencies:
```bash
composer install
```

### Step 3: Set Up Environment Variables
Copy the `.env.example` file to `.env` and update the environment variables as needed:
```bash
cp .env.example .env
```
Update the following variables with your own values:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

KAVEHNEGAR_API_KEY=your_kavenegar_api_key
```

### Step 4: Generate Application Key
Generate the application key:
```bash
php artisan key:generate
```

### Step 5: Migrate the Database
Run the migrations to set up your database:
```bash
php artisan migrate
```

### Step 6: Seed the Database
(Optional) Seed the database with initial data:
```bash
php artisan db:seed
```

### Step 7: Serve the Application
Start the local development server:
```bash
php artisan serve
```
Your application should now be running at `http://localhost:8000`.

## API Endpoints

### 1. Account Management
- **Transfer Funds**
  ```
  POST /api/transfer
  ```
  - Request Body:
    ```json
    {
      "source_card": "6219861906788939",
      "destination_card": "6037691626105324",
      "amount": 1000
    }
    ```
  - Response:
    ```json
    {
      Status payment
    }
    ```

### 2. Users
- **Get User List**
  ```
  GET /api/top-users
  ```
  - Response:
    ```json
    [
      ....
    ]
    ```

## Features
1. **User Account Management:** Each user can have multiple accounts with unique account numbers.
2. **Transaction Handling:** Perform fund transfers between accounts, with validation for minimum and maximum transaction amounts.
3. **SMS Notifications:** Send transaction notifications through SMS services like Kavenegar and Ghasedak.
4. **API Security:** Ensures that only validated card numbers are processed, and adheres to RESTful API standards.
5. **Modular Design:** Easy to add new SMS service providers.

## Development Notes
- All API endpoints are designed to be RESTful.
- Follow best practices in coding, including the use of design patterns where applicable.
- Ensure thorough testing of all functionalities before deployment.
- Consider using GitLab or GitHub for version control and collaboration.
- Documentation of the code and API endpoints is crucial for maintenance and future development.

## Deployment
- Deploy the application on a server with Laravel support.
- Set up your database and environment variables on the server.
- Migrate and seed the database on the server.
- Use a service like GitLab or GitHub for continuous integration and deployment.

## Contribution
- Fork the repository.
- Create a new branch (`git checkout -b feature-branch`).
- Make your changes.
- Commit your changes (`git commit -m 'Add some feature'`).
- Push to the branch (`git push origin feature-branch`).
- Create a new Pull Request.


For any further questions, feel free to contact the project maintainer.

---

This README provides a comprehensive guide to setting up, developing, and deploying the Laravel API project. Make sure to follow the steps carefully and refer to the documentation as needed. Happy coding!
