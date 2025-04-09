Job Management Portal
Overview
The Job Management Portal is a web application built with Laravel that allows users to browse job listings, apply for jobs, and manage their applications. Administrators can post new job listings, edit existing jobs, and manage applicants. This project implements a repository pattern for better organization and maintainability.

Table of Contents
Features

Technology Stack

Installation

Configuration

Usage

Admin Routes

User Roles

Testing

Contributing

License

Features
User Roles: Different roles for users and admins.

Job Listings: Users can view available jobs, filter them by type, and search by title, company, or location.

Application Management: Users can apply for jobs and manage their applications.

Admin Panel: Admins can create, edit, and delete job listings, as well as view all applications.

Notifications: Users receive notifications when they apply for a job.

Technology Stack
Backend: Laravel

Frontend: Blade Templating Engine, Tailwind CSS

Database: MySQL

Testing: PHPUnit, Laravel Dusk

Installation
1-Clone the Repository:
composer install
php artisan migrate --seed
php artisan key:generate

Admin Login
{Domain/admin}
email: admin@gmail.com
password: password

User Roles
The application differentiates between user roles:

Admin: Has full access to manage jobs and applications.

User: Can browse jobs, apply for jobs, and manage their own applications.

User Role Capabilities
Admin:

Create, edit, and delete job postings.

View all job applications.

Send notifications to users regarding job applications.

User:

Browse available jobs.

Apply for jobs (with optional cover letter).

View and manage their own applications.


Testing
This project includes feature tests to ensure critical functionality works as expected. To run the tests, use the following command:

php artisan test
Example Feature Tests
Job Application Test: Tests if a user can apply for a job and if they cannot apply for the same job twice.

Job Creation Test: Tests if an admin can create a job and that non-admin users cannot create jobs.