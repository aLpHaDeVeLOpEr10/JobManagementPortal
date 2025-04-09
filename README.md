# Job Management Portal

**Overview**

The Job Management Portal is a web application built with **Laravel** that allows users to browse job listings, apply for jobs, and manage their applications. Administrators can post new job listings, edit existing jobs, and manage applicants. This project implements a **repository pattern** for better organization and maintainability.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
  - [Configuration](#configuration)
- [Usage](#usage)
- [Admin Routes](#admin-routes)
- [User Roles](#user-roles)
  - [User Role Capabilities](#user-role-capabilities)
- [Testing](#testing)
  - [Example Feature Tests](#example-feature-tests)
- [Contributing](#contributing)
- [License](#license)

## Features

- **User Roles**: Different roles for **users** and **admins**.
- **Job Listings**: Users can:
    - View available jobs.
    - Filter jobs by type.
    - Search by title, company, or location.
- **Application Management**: Users can apply for jobs and manage their applications.
- **Admin Panel**: Admins can:
    - Create, edit, and delete job listings.
    - View all applications.
- **Notifications**: Users receive notifications when they apply for a job.
- **Technology Stack**:
    - **Backend**: Laravel
    - **Frontend**: Blade Templating Engine, Tailwind CSS
    - **Database**: MySQL
    - **Testing**: PHPUnit, Laravel Dusk

## Installation

1. **Clone the Repository:**
   ```bash
   git clone <repository_url>
   cd <repository_directory>
