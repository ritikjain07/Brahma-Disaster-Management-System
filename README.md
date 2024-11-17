# Brahma Disaster Management System

![Brahma Banner](images/Screenshot%20(960).png)


**Brahma** is an advanced disaster management system designed to assist individuals and organizations in responding effectively during emergencies. The system leverages cutting-edge technology, such as drones and quadrupedal robots, to support disaster relief efforts, ensuring faster and more efficient operations.

## Features

- **Disaster Reporting**: Allows users to report disasters and upload relevant details, helping authorities assess the situation quickly.
- **Weather Forecasts**: Displays real-time weather updates to assist with disaster preparedness.
- **Medical Aid**: Helps users find the nearest hospitals, book appointments with doctors, and view essential medical contacts.
- **Missing Person Reporting**: Users can report missing persons and upload images for rescue teams to act swiftly.
- **Evacuation Requests**: Offers users an easy way to request evacuation assistance during emergencies.
- **Points of Interest**: Displays essential points of interest such as hospitals, shelters, and rescue stations on an interactive map.

## Technology Stack

- **Frontend**: HTML, CSS, JavaScript, Tailwind CSS, Leaflet.js (for mapping)
- **Backend**: PHP, MySQL (for data storage), and XAMPP
- **APIs**: Weather API for real-time weather data, Google Maps API for location-based services
- **Robotics**: Drones and quadrupedal robots for disaster management operations

## Installation

To set up the Brahma Disaster Management System locally, follow these steps:

### Prerequisites

- Install [XAMPP](https://www.apachefriends.org/index.html) (includes Apache, PHP, MySQL)
- Install [Composer](https://getcomposer.org/)
- Have a GitHub account for repository access

### Steps

1. Clone the repository:
   ```bash
   git clone https://github.com/ritikjain07/Brahma-Disaster-Management-System.git
   cd Brahma-Disaster-Management-System
   ```

2. Place the project folder into your XAMPP `htdocs` directory.

3. Start the XAMPP server (Apache & MySQL).

4. Create a database in MySQL named `brahma_db`:
   ```sql
   CREATE DATABASE brahma_db;
   ```

5. Configure database connection settings in `config.php` (if necessary).

6. Open the project in a web browser:
   ```
   http://localhost/brahma
   ```

## Usage

1. **Sign Up/Login**: Create an account to report disasters, track weather forecasts, or request medical assistance.
2. **Report a Disaster**: Fill out a disaster form with the relevant details and send it to the response teams.
3. **View Medical Aid**: Access the nearest hospitals and book appointments with doctors.
4. **Find Missing Persons**: Report missing individuals by uploading images and descriptions.
5. **Request Evacuation**: Request help with evacuation by submitting your location.

## Screenshots

Here are some screenshots of the Brahma Disaster Management System in action:

1. **Disaster Reporting Page**

   ![Disaster Reporting Page](images/Screenshot%20(961).png)

2. **Medical Aid and Hospitals Nearby**

   ![Medical Aid and Hospitals Nearby](images/Screenshot%20(963).png)

3. **Donation Page Using Razorpay**

   ![Donation Page Using Razorpay](images/Screenshot%20(968).png)

## Contributing

We welcome contributions to improve Brahma! If you would like to help out:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature-name`)
3. Commit your changes (`git commit -am 'Add new feature'`)
4. Push to the branch (`git push origin feature-name`)
5. Create a pull request

## Acknowledgements

- Special thanks to the contributors of this project.
- Thanks to the open-source libraries and APIs used to enhance the functionality of Brahma.
- The design and layout were inspired by modern disaster management systems and web design principles.

---

