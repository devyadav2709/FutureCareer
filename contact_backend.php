<?php

$conn = new mysqli("localhost", "root", "", "career_prediction");

if ($conn->connect_error) {
   echo "error:Database connection failed";
   exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $name = htmlspecialchars(trim($_POST['name']));
   $email = htmlspecialchars(trim($_POST['email']));
   $subject = htmlspecialchars(trim($_POST['subject']));
   $message = htmlspecialchars(trim($_POST['message']));

   if (empty($name) || empty($email) || empty($message)) {
      echo "Please make sure to fill out your name, email, and message.";
      exit;
   }
   $stmt = $conn->prepare("INSERT INTO contact (name, email, subject, message) VALUES (?, ?, ?, ?)");
   $stmt->bind_param("ssss", $name, $email, $subject, $message);

   if ($stmt->execute()) {
      echo "Message sent successfully!!";
   } else {
      echo "Oops! Something went wrong while sending your message. Please try again later.";
   }
   $stmt->close();
} else {
   echo "Invalid form submission. Please use the form to send your message.";
}

$conn->close();
?>