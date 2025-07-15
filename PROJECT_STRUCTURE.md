# Brahma Disaster Management System - Project Structure

## Directory Structure

```
brahma/
├── index.php                 # Main landing page
├── .htaccess                 # Apache configuration
├── README.md                 # Project documentation
├── 
├── admin/                    # Admin panel
│   ├── admin_login.html      # Admin login page
│   └── dashboard.html        # Admin dashboard
├── 
├── assets/                   # Static assets
│   ├── css/
│   │   └── style.css         # Main stylesheet
│   ├── js/
│   │   └── script.js         # Main JavaScript file
│   └── images/               # Image assets
│       ├── bgidn.jpg         # Background image
│       ├── logo.png          # Logo
│       ├── logo_brahma.png   # Brahma logo
│       ├── mapss.png         # Map assets
│       └── screenshots/      # Project screenshots
├── 
├── auth/                     # Authentication system
│   ├── login.php             # User login
│   ├── signup.php            # User registration
│   └── logout.php            # User logout
├── 
├── database/                 # Database files
│   ├── config.php            # Database configuration
│   └── schema.sql            # Database schema
├── 
├── includes/                 # Common includes
│   ├── header.php            # Common header
│   ├── footer.php            # Common footer
│   └── functions.php         # Common functions
├── 
├── libs/                     # Third-party libraries
│   └── PHPMailer-master/     # Email library
├── 
├── pages/                    # Application pages
│   ├── about-page.php        # About page
│   ├── contact-page.php      # Contact page
│   ├── service-page.php      # Services page
│   ├── medical_aid.php       # Medical aid page
│   ├── missing_person.php    # Missing person report
│   ├── view_missing_person.php # View missing persons
│   ├── weather.php           # Weather page
│   ├── weatherForcast.php    # Weather forecast
│   ├── survival_tips.php     # Survival tips
│   ├── donation2.php         # Donation page
│   ├── emergencyForm.php     # Emergency report form
│   ├── helpForm.php          # Help request form
│   ├── profile.php           # User profile
│   └── mapify.php            # Map functionality
├── 
├── uploads/                  # User uploads
│   └── [user uploaded files]
└── 
└── mapify/                   # Map module
    ├── index.html            # Map interface
    ├── script.js             # Map JavaScript
    ├── style.css             # Map styles
    └── icon.png              # Map icons
```

## File Descriptions

### Core Files
- **index.php**: Main landing page with hero section and feature overview
- **.htaccess**: Apache configuration for security and URL rewriting
- **README.md**: Project documentation and setup instructions

### Admin Panel (`admin/`)
- **admin_login.html**: Administrative login interface
- **dashboard.html**: Administrative dashboard for managing system

### Assets (`assets/`)
- **css/style.css**: Main stylesheet with custom styles
- **js/script.js**: Main JavaScript file with common functionality
- **images/**: All image assets including logos, backgrounds, and screenshots

### Authentication (`auth/`)
- **login.php**: User login with session management
- **signup.php**: User registration with validation
- **logout.php**: Session cleanup and logout

### Database (`database/`)
- **config.php**: Database connection configuration with security features
- **schema.sql**: Complete database schema with all required tables

### Includes (`includes/`)
- **header.php**: Common header with navigation and metadata
- **footer.php**: Common footer with links and scripts
- **functions.php**: Utility functions for security, validation, and common operations

### Libraries (`libs/`)
- **PHPMailer-master/**: Email functionality library

### Pages (`pages/`)
- **about-page.php**: Information about the system
- **contact-page.php**: Contact form and information
- **service-page.php**: Overview of available services
- **medical_aid.php**: Medical assistance and hospital finder
- **missing_person.php**: Missing person report form
- **view_missing_person.php**: View reported missing persons
- **weather.php**: Weather information and forecasts
- **weatherForcast.php**: Detailed weather forecasting
- **survival_tips.php**: Emergency survival information
- **donation2.php**: Donation system with payment integration
- **emergencyForm.php**: Emergency incident reporting
- **helpForm.php**: General help request form
- **profile.php**: User profile management
- **mapify.php**: Map-based location services

### Uploads (`uploads/`)
- Directory for user-uploaded files (images, documents)

### Map Module (`mapify/`)
- Standalone map functionality with interactive features

## Key Features

1. **Modular Structure**: Clean separation of concerns with organized directories
2. **Security**: .htaccess configuration, input sanitization, and CSRF protection
3. **Database Integration**: Proper database configuration and schema
4. **Responsive Design**: Mobile-friendly interface with Tailwind CSS
5. **Authentication System**: Secure user login and registration
6. **Admin Panel**: Administrative interface for system management
7. **File Upload**: Secure file upload functionality
8. **Email Integration**: PHPMailer for email notifications
9. **Map Integration**: Interactive maps for location services
10. **Weather API**: Real-time weather information

## Setup Instructions

1. Place the project in your XAMPP htdocs directory
2. Create the database using `database/schema.sql`
3. Configure database connection in `database/config.php`
4. Set appropriate permissions for `uploads/` directory
5. Access the application via `http://localhost/brahma/`

## Security Features

- Input sanitization and validation
- CSRF token protection
- Secure file upload handling
- Protected configuration files
- Session security
- SQL injection prevention

## Future Enhancements

- API integration for emergency services
- Real-time notifications
- Mobile application
- Advanced reporting and analytics
- Integration with IoT devices and drones
