# PHP CRUD Application

## Overview
This PHP CRUD application allows users to manage tabs and slides. It provides an admin interface for creating, reading, updating, and deleting records. The application is structured to separate concerns, with distinct directories for public assets, source code, and database schema.

## Project Structure
```
php-crud-app
├── public
│   ├── index.php          # Entry point for the application
│   ├── admin.php          # Admin interface for managing tabs and slides
│   └── assets
│       ├── css            # Stylesheets for the application
│       └── js             # JavaScript files for the application
├── src
│   ├── config.php         # Database connection settings
│   ├── controllers
│   │   └── CrudController.php  # Handles CRUD operations
│   ├── models
│   │   ├── Tab.php        # Represents a tab in the application
│   │   └── Slide.php      # Represents a slide in the application
│   └── views
│       ├── tabs
│       │   ├── list.php   # Displays a list of tabs
│       │   ├── create.php  # Form for creating a new tab
│       │   └── edit.php    # Form for editing an existing tab
│       └── slides
│           ├── list.php    # Displays a list of slides for a tab
│           ├── create.php   # Form for creating a new slide
│           └── edit.php     # Form for editing an existing slide
├── database
│   └── schema.sql         # SQL statements for creating database tables
└── README.md              # Documentation for the project
```

## Setup Instructions
1. **Clone the Repository**
   Clone this repository to your local machine using:
   ```
   git clone <repository-url>
   ```

2. **Database Setup**
   - Create a MySQL database for the application.
   - Import the `Database.sql` file located in the `database` directory to create the necessary tables.

3. **Configuration**
   - Update the `src/config.php` file with your database connection settings.

4. **Run the Application**
   - Start a local server (e.g., using XAMPP or MAMP).
   - Access the application by navigating to `http://localhost/php-crud-app/public/index.php` in your web browser.

## Usage
- Use the admin interface (`admin.php`) to manage tabs and slides.
- Create new tabs and slides, edit existing ones, or delete them as needed.
- The application supports image uploads for slides.