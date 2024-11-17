<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
  <!-- <link rel="stylesheet" href="style.css"> -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
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
      background: url('bgidn.jpg') no-repeat center center fixed;
      background-size: cover;
      color: #333;
    }

    header {
      background: rgba(74, 144, 226, 0.8);
      color: #fff;
      padding: 20px 0;
    }

    .header-container {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .header-content {
      display: flex;
      justify-content: center;
      align-items: center;
      max-width: 1200px;
      width: 100%;
      padding: 0 20px;
    }

    .logo img {
      height: 50px;
    }

    nav ul {
      display: flex;
      list-style: none;
      margin-left: 20px;
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

    main {
      flex: 1;
      padding: 40px 20px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 10px;
    }

    .about-container {
      max-width: 1200px;
      margin: 0 auto;
      text-align: center;
    }

    .about-container h1 {
      font-size: 36px;
      margin-bottom: 20px;
      color: #4A90E2;
    }

    .about-container p {
      font-size: 18px;
      margin-bottom: 20px;
    }

    .about-content {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      margin-bottom: 40px;
    }

    .about-text,
    .about-image {
      flex: 1;
      padding: 20px;
    }

    .about-text h2 {
      font-size: 28px;
      margin-bottom: 15px;
    }

    .about-text p {
      font-size: 16px;
      line-height: 1.6;
    }

    .about-image img {
      max-width: 100%;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

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

    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
      padding-top: 60px;
    }

    .modal-content {
      background-color: #fefefe;
      margin: 5% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 600px;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
      .header-content {
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

      .about-content {
        flex-direction: column;
      }

      .about-text,
      .about-image {
        padding: 10px;
      }

      .about-container h1 {
        font-size: 28px;
      }

      .about-container p {
        font-size: 16px;
      }
    }

    @media (max-width: 480px) {
      .header-container {
        padding: 0 10px;
      }

      .about-container {
        padding: 0 10px;
      }

      .about-container h1 {
        font-size: 24px;
      }

      .about-container p {
        font-size: 14px;
      }

      .about-text h2 {
        font-size: 24px;
      }

      .about-text p {
        font-size: 14px;
      }
    }
  </style>
</head>

<body>
  <header>
    <div class="header-container">
      <div class="header-content">
        <div class="logo">
          <img src="logo_brahma.png" alt="Brahma Logo">
        </div>
        <nav>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about-page.php">About</a></li>
            <li><a href="services-page.php">Services</a></li>
            <li><a href="contact-page.php">Contact</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </header>

  <main>
    <div class="about-container">
      <h1>About Us</h1>
      <p>Enhancing Disaster Management Efficiency with Quadbots and Drones</p>
      <p>Discover how the integration of advanced quadbots and drones revolutionizes disaster management systems, improving preparedness, response, recovery, and mitigation.</p>
      <div class="about-content">
        <div class="about-text">
          <h2>Our Mission</h2>
          <p>Our mission is to leverage cutting-edge technology to enhance the efficiency and effectiveness of disaster management. By integrating quadbots and drones, we aim to provide rapid and reliable solutions for disaster preparedness, response, recovery, and mitigation.</p>
        </div>
        <div class="about-image">
          <img src="drone.jpg" alt="Drone in action">
        </div>
      </div>
      <div class="about-content">
        <div class="about-image">
          <img src="bot.jpg" alt="Quadbot in action">
        </div>
        <div class="about-text">
          <h2>Our Technology</h2>
          <p>Our advanced quadbots and drones are equipped with state-of-the-art sensors and AI capabilities. These technologies allow for real-time data collection, analysis, and decision-making, ensuring a swift and effective response to any disaster scenario.</p>
        </div>
      </div>
    </div>
  </main>

  <footer>
    <div class="footer-container">
      <p>&copy; 2024 Disaster Management. All rights reserved.</p>
      <div class="footer-links">
        <a href="#" id="privacy-policy">Privacy Policy</a>
        <a href="#" id="terms-of-service">Terms of Service</a>
      </div>
    </div>
  </footer>

  <!-- Privacy Policy Modal -->
  <div id="privacy-policy-modal" class="modal">
    <div class="modal-content">
      <span class="close" id="privacy-policy-close">&times;</span>
      <h2>Privacy Policy</h2>
      <p>Your privacy is important to us. This Privacy Policy explains how we collect, use, and protect your personal information when you visit our website and use our services.</p>

      <h3>Information We Collect</h3>
      <p>We may collect the following types of information:</p>
      <ul>
        <li><strong>Personal Information:</strong> This includes your name, email address, phone number, and other contact details when you register for an account or contact us.</li>
        <li><strong>Usage Data:</strong> We collect information about how you use our website, including your IP address, browser type, and pages visited.</li>
        <li><strong>Cookies:</strong> We use cookies to improve your experience on our website. Cookies are small data files stored on your device. You can control the use of cookies through your browser settings.</li>
      </ul>

      <h3>How We Use Your Information</h3>
      <p>We use your information for the following purposes:</p>
      <ul>
        <li>To provide and maintain our services.</li>
        <li>To communicate with you, including responding to your inquiries and sending updates.</li>
        <li>To improve our website and services based on your feedback and usage patterns.</li>
        <li>To comply with legal obligations and enforce our terms and policies.</li>
      </ul>

      <h3>Data Security</h3>
      <p>We implement appropriate technical and organizational measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet or electronic storage is completely secure, so we cannot guarantee absolute security.</p>

      <h3>Third-Party Services</h3>
      <p>Our website may contain links to third-party sites. We are not responsible for the privacy practices or content of these third-party sites. Please review their privacy policies before providing any information.</p>

      <h3>Your Rights</h3>
      <p>You have the right to access, correct, or delete your personal information. If you wish to exercise these rights or have any concerns about our use of your information, please contact us at [Your Contact Information].</p>

      <h3>Changes to This Policy</h3>
      <p>We may update this Privacy Policy from time to time. Any changes will be posted on this page with an updated effective date. Please review this policy periodically for any changes.</p>

      <h3>Contact Us</h3>
      <p>If you have any questions or concerns about this Privacy Policy, please contact us at +91 8217793682.</p>

    </div>
  </div>

  <!-- Terms of Service Modal -->
  <div id="terms-of-service-modal" class="modal">
    <div class="modal-content">
      <span class="close" id="terms-of-service-close">&times;</span>
      <h2>Terms of Service</h2>
      <p>Welcome to Brahma. By using our website and services, you agree to the following terms and conditions. Please read them carefully.</p>

      <h3>1. Acceptance of Terms</h3>
      <p>By accessing or using our website and services, you agree to be bound by these Terms of Service and our Privacy Policy. If you do not agree with these terms, please do not use our services.</p>

      <h3>2. Use of Services</h3>
      <p>You agree to use our services in compliance with all applicable laws and regulations. You are responsible for any content you submit or transmit through our website and for ensuring it does not violate any laws or third-party rights.</p>

      <h3>3. Account Responsibilities</h3>
      <p>If you create an account with us, you are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account. You agree to notify us immediately of any unauthorized use of your account.</p>

      <h3>4. Intellectual Property</h3>
      <p>All content and materials on our website, including text, graphics, logos, and software, are the property of [Your Company Name] or its licensors and are protected by intellectual property laws. You may not use, copy, or distribute any content without our prior written consent.</p>

      <h3>5. Limitation of Liability</h3>
      <p>To the maximum extent permitted by law, [Your Company Name] shall not be liable for any indirect, incidental, special, or consequential damages arising from or related to your use of our services. Our total liability for any claim arising out of these Terms of Service shall be limited to the amount you paid for the services, if any.</p>

      <h3>6. Termination</h3>
      <p>We reserve the right to terminate or suspend your access to our services at any time, with or without cause, if we believe you have violated these Terms of Service or for any other reason.</p>

      <h3>7. Changes to Terms</h3>
      <p>We may update these Terms of Service from time to time. Any changes will be posted on this page with an updated effective date. Your continued use of our services after any changes constitutes your acceptance of the new terms.</p>

      <h3>8. Governing Law</h3>
      <p>These Terms of Service shall be governed by and construed in accordance with the laws of 2024. Any disputes arising from these terms shall be subject to the exclusive jurisdiction of the courts in [Your Jurisdiction].</p>

      <h3>9. Contact Us</h3>
      <p>If you have any questions or concerns about these Terms of Service, please contact us at +91 8217793682.</p>

    </div>
  </div>

  <script>
    // Modal handling
    document.getElementById('privacy-policy').onclick = function() {
      document.getElementById('privacy-policy-modal').style.display = 'block';
    }
    document.getElementById('privacy-policy-close').onclick = function() {
      document.getElementById('privacy-policy-modal').style.display = 'none';
    }
    document.getElementById('terms-of-service').onclick = function() {
      document.getElementById('terms-of-service-modal').style.display = 'block';
    }
    document.getElementById('terms-of-service-close').onclick = function() {
      document.getElementById('terms-of-service-modal').style.display = 'none';
    }
    window.onclick = function(event) {
      if (event.target == document.getElementById('privacy-policy-modal')) {
        document.getElementById('privacy-policy-modal').style.display = 'none';
      }
      if (event.target == document.getElementById('terms-of-service-modal')) {
        document.getElementById('terms-of-service-modal').style.display = 'none';
      }
    }
  </script>
</body>

</html>