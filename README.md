# Brahma Disaster Management System

![Brahma Banner](assets/images/Screenshot%20(960).png)

**Brahma** is an advanced disaster management system designed to assist individuals and organizations in responding effectively during emergencies. The system leverages cutting-edge technology, such as drones and quadrupedal robots, to support disaster relief efforts, ensuring faster and more efficient operations .

## 🚀 Features

- **Disaster Reporting**: Allows users to report disasters and upload relevant details, helping authorities assess the situation quickly.
- **Weather Forecasts**: Displays real-time weather updates to assist with disaster preparedness.
- **Medical Aid**: Helps users find the nearest hospitals, book appointments with doctors, and view essential medical contacts.
- **Missing Person Reporting**: Users can report missing persons and upload images for rescue teams to act swiftly.
- **Evacuation Requests**: Offers users an easy way to request evacuation assistance during emergencies.
- **Points of Interest**: Displays essential points of interest such as hospitals, shelters, and rescue stations on an interactive map.
- **Donation System**: Secure donation platform with Razorpay integration for supporting disaster relief efforts.
- **User Authentication**: Secure login and registration system with session management.
- **Admin Panel**: Administrative interface for managing system operations and user data.

## 🛠️ Technology Stack

- **Frontend**: HTML5, CSS3, JavaScript ES6, Tailwind CSS, Font Awesome
- **Backend**: PHP 7.4+, MySQL 8.0+
- **Libraries**: PHPMailer for email functionality, Leaflet.js for interactive mapping
- **Payment Integration**: Razorpay for secure donation processing
- **Development Environment**: XAMPP (Apache, PHP, MySQL)
- **Version Control**: Git & GitHub
- **Security**: Input sanitization, CSRF protection, prepared statements

## 📁 Project Structure

```
brahma/
├── index.php                 # Main landing page
├── .htaccess                 # Apache configuration
├── README.md                 # Project documentation
├── admin/                    # Admin panel
├── assets/                   # Static assets (CSS, JS, images)
├── auth/                     # Authentication system
├── database/                 # Database configuration
├── includes/                 # Common includes
├── libs/                     # Third-party libraries
├── pages/                    # Application pages
├── uploads/                  # User uploads
└── mapify/                   # Map module
```

## 🚀 Installation

### Prerequisites

- [XAMPP](https://www.apachefriends.org/index.html) (Apache, PHP 7.4+, MySQL 8.0+)
- [Composer](https://getcomposer.org/) (optional, for dependency management)
- Modern web browser (Chrome, Firefox, Safari, Edge)

### Setup Steps

1. **Clone the repository**:
   ```bash
   git clone https://github.com/ritikjain07/Brahma-Disaster-Management-System.git
   cd Brahma-Disaster-Management-System
   ```

2. **Setup XAMPP**:
   - Place the project folder in your XAMPP `htdocs` directory
   - Start Apache and MySQL services from XAMPP Control Panel

3. **Database Configuration**:
   - Create a database named `brahma_db`
   - Import the database schema from `database/schema.sql`
   - Configure database connection in `database/config.php`

4. **File Permissions**:
   - Ensure `uploads/` directory has write permissions
   - Set appropriate permissions for configuration files

5. **Access the Application**:
   ```
   http://localhost/brahma/
   ```

## 🎯 Usage

### User Features
1. **Registration/Login**: Create an account to access all features
2. **Disaster Reporting**: Report emergencies with location and details
3. **Medical Aid**: Find nearby hospitals and medical facilities
4. **Missing Person Reports**: Report and search for missing individuals
5. **Weather Information**: Get real-time weather updates and forecasts
6. **Survival Tips**: Access emergency preparedness information
7. **Donations**: Support disaster relief efforts through secure payments
8. **Profile Management**: Update personal information and preferences

### Admin Features
1. **Dashboard**: Overview of system statistics and activities
2. **User Management**: Monitor and manage user accounts
3. **Report Management**: Review and process disaster reports
4. **Content Management**: Update survival tips and information

## 🔐 Security Features

- **Input Validation**: Comprehensive sanitization of all user inputs
- **SQL Injection Prevention**: Prepared statements for database queries
- **CSRF Protection**: Token-based protection for forms
- **Session Security**: Secure session management and timeout
- **File Upload Security**: Validation and restriction of uploaded files
- **XSS Protection**: Output encoding and content security policies

## 📸 Screenshots

1. **Main Dashboard**
   ![Main Dashboard](assets/images/Screenshot%20(960).png)

2. **Disaster Reporting**
   ![Disaster Reporting](assets/images/Screenshot%20(961).png)

3. **Medical Aid Services**
   ![Medical Aid](assets/images/Screenshot%20(963).png)

4. **Donation Platform**
   ![Donation Page](assets/images/Screenshot%20(968).png)

## 🤝 Contributing

We welcome contributions to improve Brahma! Here's how you can help:

1. **Fork the repository** on GitHub
2. **Create a feature branch**: `git checkout -b feature-name`
3. **Make your changes** and test thoroughly
4. **Commit your changes**: `git commit -am 'Add new feature'`
5. **Push to the branch**: `git push origin feature-name`
6. **Create a pull request** with a detailed description

### Contribution Guidelines
- Follow PHP PSR standards
- Write meaningful commit messages
- Add comments for complex logic
- Test your changes thoroughly
- Update documentation as needed

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgements

- **Open Source Libraries**: PHPMailer, Leaflet.js, Tailwind CSS
- **APIs**: Weather API integration for real-time data
- **Design Inspiration**: Modern disaster management systems and emergency response best practices
- **Testing**: Community feedback and beta testing support

## 📞 Contact & Support

**Developer**: Ritik Jain  
📧 **Email**: [ritikjain4560@gmail.com](mailto:ritikjain4560@gmail.com)  
🔗 **GitHub**: [ritikjain07](https://github.com/ritikjain07)  
🌐 **Project Repository**: [Brahma-Disaster-Management-System](https://github.com/ritikjain07/Brahma-Disaster-Management-System)

---

## 🚀 Future Enhancements

- **Mobile Application**: Native iOS and Android apps
- **Real-time Notifications**: Push notifications for emergencies
- **AI Integration**: Machine learning for disaster prediction
- **IoT Integration**: Sensor data integration for real-time monitoring
- **Drone Integration**: Autonomous drone deployment for rescue operations
- **API Development**: RESTful API for third-party integrations
- **Multi-language Support**: Localization for global use
- **Advanced Analytics**: Data visualization and reporting dashboard

---

*Last updated: July 2025*


