# nordiceasy Installation Guide

This guide provides step-by-step instructions to set up the Laravel application, using Laravel version 9.19 and PHP version 8.0.2.

Prerequisites
Before you begin, ensure you have the following:

Laravel version 9.19
PHP version 8.0.2
Composer (for package management)

#Installation Steps

Clone the project repository:
git clone
cd nordiceasy_backend

# Install dependencies using Composer:

composer install

# Run migrations to create the database tables:

php artisan migrate

# Run the project

php artisan serve

# API Testing

To test the API endpoints, you can use the provided Postman collection. Follow these steps:

Open Postman.

Import the collection using the following URL:

https://api.postman.com/collections/18064902-f1c7d40a-5d23-4583-b071-ede94959b9b3?access_key=PMAT-01HB63B2Q2EXHGSHZPAQ8M9Y5B

Once imported, you'll have access to the available API requests for testing.

#Additional Assistance
If you encounter any issues during the installation or have further questions, please feel free to reach out for assistance
