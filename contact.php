<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "gym");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetching form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Message sent successfully!'); window.location.href='contact.php';</script>";
    } else {
        echo "<script>alert('Failed to send message. Please try again.'); window.location.href='contact.php';</script>";
    }

    $stmt->close();
    $conn->close();
    exit;  // Exit to prevent further code execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us - FitNest GYM</title>
  <!-- CSS -->
  <link rel="stylesheet" href="contact.css" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <!-- Menu -->
  <div class="menu">
    <div class="container flex">
      <div class="logo">
        <h2>FitNest GYM</h2>
      </div>
      <ul class="nav">
        <li class="nav-item"><a href="index.html">Home</a></li>
        <li class="nav-item"><a href="index.html#about">About Us</a></li>
        <li class="nav-item"><a href="shop.html">Shop</a></li>
        <li class="nav-item"><a href="index.html#trainers">Trainers</a></li>
        <li class="nav-item"><a href="membership.html">Book Membership</a></li>
      </ul>
      <a href="login_index.html" class="btn">Register</a>
    </div>
  </div>
  <!-- End Menu -->

  <!-- Contact Us -->
  <section id="contact" class="section">
    <div class="container flex">
      <div class="text">
        <h2 class="primary mb">Contact Us</h2>
        <p class="tertiary mb">We'd love to hear from you! Whether you have questions about our services, need support, or want to provide feedback, feel free to reach out.</p>
        <h3 class="tertiary">Get in Touch</h3>
        <p class="tertiary">Phone: <a href="tel:+1234567890">+1 (234) 567-890</a></p>
        <p class="tertiary">Email: <a href="mailto:info@fitnestgym.com">info@fitnestgym.com</a></p>
      </div>
      <div class="form">
        <form id="contactForm" action="contact.php" method="POST">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" required />
          
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required />
          
          <label for="message">Message</label>
          <textarea id="message" name="message" rows="4" required></textarea>
          
          <button type="submit" class="btn">Send Message</button>
        </form>
      </div>
    </div>
  </section>
  <!-- End Contact Us -->

  <!-- Footer -->
  <div class="footer">
    <div class="links">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="membership.html">Get Membership</a></li>
        <li><a href="payment.html">Get Coupon</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="features.html">About</a></li>
      </ul>
    </div>
    <div class="links">
      <h3>Fashion in Area</h3>
      <ul>
        <li><a href="shop.html">Gym Accessories</a></li>
        <li><a href="diet.html">Health tips</a></li>
        <li><a href="exercise.html">Exercise tutorials</a></li>
        <li><a href="attendance_records.html">Check your attendance</a></li>
      </ul>
    </div>
    <div class="links">
      <h3>Support</h3>
      <ul>
        <li>Frequently Asked Questions</li>
        <li>Report a Payment Issue</li>
        <li>Terms & Conditions</li>
        <li>Privacy Policy</li>
      </ul>
    </div>
  </div>
  <footer>
    <div class="container flex">
      <p class="tertiary">
        &copy; 2024 FitNest GYM. All Rights Reserved
      </p>
    </div>
  </footer>
  
  <script>
    document.getElementById('contactForm').addEventListener('submit', function (event) {
      event.preventDefault(); // Prevent the default form submission behavior

      let formData = new FormData(this); // Get form data

      fetch('contact.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        alert('Message sent successfully!');
        // Optionally clear the form or perform other actions
      })
      .catch(error => {
        alert('There was an error: ' + error);
      });
    });
  </script>
</body>
</html>
