# CitiMed Hospital Management System

## Overview

CitiMed is a comprehensive medical management system designed for healthcare facilities. It provides tools for managing patients, visits, and financial transactions with a focus on streamlining healthcare workflows and improving patient care.

The system features role-based access control, allowing different staff members to access appropriate functionality based on their responsibilities. It supports the complete patient visit lifecycle from registration to payment processing.

## Tech Stack

### Backend
- **PHP 8.2+**
- **Laravel 12.0** - PHP web application framework
- **Livewire 3.6** - Full-stack framework for dynamic interfaces
- **Spatie Laravel Permission 6.20** - Role and permission management

### Frontend
- **Livewire Flux 2.1.1** - UI components for Livewire
- **Livewire Volt 1.7.0** - Template components for Livewire
- **Tailwind CSS 4.0.7** - Utility-first CSS framework
- **Vite 6.0** - Frontend build tool

### Development Tools
- **Laravel Sail** - Docker development environment
- **Laravel Pint** - PHP code style fixer
- **Pest** - Testing framework
- **Laravel Pail** - Log viewer

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and NPM
- MySQL or compatible database

### Setup Instructions

1. Clone the repository:
   ```bash
   git clone https://github.com/jeremy-sheriff/citimed-prod.git
   cd citimed-prod
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install JavaScript dependencies:
   ```bash
   npm install
   ```

4. Create environment file:
   ```bash
   cp .env.example .env
   ```

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Configure your database in the `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=citimed
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. Run database migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

8. Build frontend assets:
   ```bash
   npm run build
   ```

9. Start the development server:
   ```bash
   php artisan serve
   ```

10. Access the application at `http://localhost:8000`

## Project Structure

The project follows the standard Laravel directory structure with some additional organization:

- **app/** - Contains the core code of the application
  - **Livewire/** - Livewire components organized by feature
  - **Models/** - Eloquent models
  - **Http/Controllers/** - Controllers
- **resources/** - Contains views, assets, and language files
  - **views/livewire/** - Blade templates for Livewire components
- **routes/** - Contains route definitions
- **database/** - Contains migrations and seeders
- **config/** - Contains configuration files
- **public/** - Contains publicly accessible files
- **tests/** - Contains test files

## Key Features

### Authentication & Authorization
- User authentication with email and password
- Role-based access control
- Permission management
- User profile management

### Patient Management
- Patient registration and profile management
- Search and filtering by name, patient number, phone, residence, and age
- Patient history tracking
- Bulk operations (delete, export)

### Visit Management
- Patient search and selection
- Medical information entry (complaints, diagnosis, history, allergies, etc.)
- Visit creation and storage
- Financial information processing (charges, payments, balances)
- Visit confirmation and summary

### Financial Management
- Payment processing (Mpesa, Cash)
- Balance tracking
- Transaction history

### Reporting & Analytics
- Patient reports
- Visit statistics
- Financial summaries

## Deployment

The application is configured for deployment using GitHub Actions. When changes are pushed to the main branch, the workflow:

1. Zips the project contents (excluding unnecessary files)
2. Uploads the zipped contents via FTP to the production server
3. Deploys to the domain citimedhospital.co.ke

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For support, please contact the development team or open an issue on the repository.
