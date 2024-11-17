<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Service Page</title>
  <style>
    /* General styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Roboto', sans-serif;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      background: #f8f8f8;
      color: #333;
    }

    /* Header styles */
    header {
      background: #4A90E2;
      color: #fff;
      padding: 20px 0;
    }

    .header-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .logo h1 {
      margin: 0;
      font-size: 24px;
    }

    nav ul {
      display: flex;
      list-style: none;
    }

    nav ul li {
      margin-left: 20px;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
      font-weight: 500;
    }

    nav ul li a:hover {
      text-decoration: underline;
    }

    /* Main content styles */
    main {
      flex: 1;
      padding: 40px 20px;
    }

    .service-container {
      max-width: 1200px;
      margin: 0 auto;
      text-align: center;
    }

    .service-container h1 {
      font-size: 36px;
      margin-bottom: 20px;
      color: #4A90E2;
    }

    .service-content {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      margin-bottom: 40px;
    }

    .service-text, .service-image {
      flex: 1;
      padding: 20px;
    }

    .service-text h2 {
      font-size: 28px;
      margin-bottom: 15px;
    }

    .service-text p {
      font-size: 16px;
      line-height: 1.6;
    }

    .service-image img {
      max-width: 100%;
      height: auto;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .learn-more {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background: #4A90E2;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
    }

    .learn-more:hover {
      background: #357ABD;
    }

    /* Footer styles */
    footer {
      background: #333;
      color: #fff;
      padding: 20px 0;
      text-align: center;
    }

    .footer-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .footer-links a {
      color: #4A90E2;
      text-decoration: none;
      margin-left: 15px;
    }

    .footer-links a:hover {
      text-decoration: underline;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
      .header-container {
        flex-direction: column;
        text-align: center;
      }

      nav ul {
        flex-direction: column;
        margin-top: 10px;
      }

      nav ul li {
        margin: 10px 0;
      }

      .service-content {
        flex-direction: column;
      }

      .service-text, .service-image {
        padding: 10px;
      }

      .service-container h1 {
        font-size: 28px;
      }

      .service-container p {
        font-size: 16px;
      }
    }

    @media (max-width: 480px) {
      .header-container {
        padding: 0 10px;
      }

      .service-container {
        padding: 0 10px;
      }

      .service-container h1 {
        font-size: 24px;
      }

      .service-container p {
        font-size: 14px;
      }

      .service-text h2 {
        font-size: 24px;
      }

      .service-text p {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="header-container">
      <div class="logo">
        <h1>Brahma</h1>
      </div>
      <nav>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="about.html">About Us</a></li>
          <li><a href="services.html">Services</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <main>
    <div class="service-container">
      <h1>Enhancing Disaster Management with Quadbots and Drones</h1>
      <div class="service-content">
        <div class="service-text">
          <h2>Streamlining Disaster Response and Recovery</h2>
          <p>Our advanced quadbots and drones work together to improve disaster management processes, from preparedness to mitigation.</p>
        </div>
        <div class="service-image">
          <img src="bot.jpg" alt="Quadbot">
        </div>
      </div>
      <div class="service-content">
        <div class="service-image">
          <img src="drone.jpg" alt="Drone">
        </div>
        <div class="service-text">
          <h2>Efficient Search and Rescue Operations</h2>
          <p>Our quadbots and drones enable faster and more accurate search and rescue missions during disasters.</p>
        </div>
      </div>
      <div class="service-content">
        <div class="service-text">
          <h2>Effective Damage Assessment and Recovery</h2>
          <p>With our advanced technologies, we can quickly assess damage and facilitate efficient recovery efforts.</p>
          <a href="#" class="learn-more">Learn More ></a>
        </div>
        <div class="service-image">
          <img src="assessment.jpg" alt="Damage Assessment">
        </div>
      </div>
    </div>
  </main>
  <footer>
    <div class="footer-container">
      <p>&copy; 2024 Brahma. All rights reserved.</p>
      <div class="footer-links">
        <a href="#">Terms of Service</a>
        <a href="#">Privacy Policy</a>
      </div>
    </div>
  </footer>
</body>
</html>