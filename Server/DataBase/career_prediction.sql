CREATE DATABASE IF NOT EXISTS career_prediction;
USE career_prediction;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100),
  phone VARCHAR(20),
  dob DATE,
  gender VARCHAR(10),
  location VARCHAR(100),
  education VARCHAR(50),
  field VARCHAR(100),
  institution VARCHAR(100),
  year INT,
  skills TEXT,
  softskills TEXT,
  hobbies TEXT,
  industry VARCHAR(100),
  workmode VARCHAR(50),
  goal TEXT,
  link TEXT,
  message TEXT,
  resume VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
