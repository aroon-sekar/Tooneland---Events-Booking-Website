
# Entertainment Events Booking System

Welcome to the **Entertainment Events Booking System**! This project is a dynamic web solution developed as part of the [KF7013 - Website Development and Deployment](https://w22062575.nuwebspace.co.uk/KF7013/content/) module.

## Table of Contents
- [Project Overview](#project-overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Setup and Installation](#setup-and-installation)
- [Database Schema](#database-schema)
- [Security Measures](#security-measures)
- [Screenshots](#screenshots)
- [Future Enhancements](#future-enhancements)
- [References](#references)

## Project Overview

This project is a fictional **Entertainment Events Booking System** for a venue located in [City Name], [Country Name]. Users can view available events and make bookings through a secure and user-friendly interface. The project demonstrates proficiency in building standards-compliant, database-driven web applications using **HTML5**, **CSS**, **PHP**, and **SQL**, with a focus on **security**, **accessibility**, and **user experience**.

## Features

- **Event Listing:** View upcoming events and detailed descriptions.
- **User Registration:** Register a new account to book events.
- **Secure Login:** User authentication with session management.
- **Event Booking:** Book events for a specific date and number of people.
- **Responsive Design:** Fully responsive and accessible design across devices.
- **Security Measures:** SQL injection prevention, cross-site scripting protection, and session management.

## Tech Stack

- **Frontend:**
  - HTML5
  - CSS3 (external stylesheet)
- **Backend:**
  - PHP (server-side scripting)
  - MySQL (database management)
- **Database:**
  - Events Table
  - Customers Table
  - Bookings Table

## Setup and Installation

1. **Clone the repository:**
    ```bash
    git clone https://github.com/YOUR_GITHUB_USERNAME/entertainment-booking-system.git
    ```

2. **Deploy on nuwebspace:**
   Upload the project to your **nuwebspace** folder: `/KF7013/content/`.

3. **Database setup:**
   - Import the SQL script provided to create the database tables.
   - Enter the details of 12 sample events in the `events` table.
   - Run the PHP scripts to manage the customer registration and event booking functionalities.

4. **Access the website:**
    ```
    https://YOURUSERID.nuwebspace.co.uk/KF7013/content/index.php
    ```

## Database Schema

- **Events Table:** Stores details of events including event name, date, venue, and availability.
- **Customers Table:** Stores registered user details.
- **Bookings Table:** Stores booking records made by logged-in users.

## Security Measures

- **SQL Injection Prevention:** Parameterized queries are used in all database interactions.
- **Cross-Site Scripting (XSS):** User input is sanitized to prevent malicious scripts.
- **Session Management:** Sessions are implemented to secure user login and restrict access to authenticated users only.

## Screenshots

### Homepage
![alt text](https://github.com/aroon-sekar/Tooneland---Events-Booking-Website/blob/main/image.jpg?raw=true)

### Event Booking Page
![Booking Page](path_to_screenshot)

## Future Enhancements

- **User Profile:** Implement a user dashboard for viewing past bookings and managing user information.
- **Admin Panel:** Develop an admin panel to manage events and view bookings.
- **Email Notifications:** Add email confirmations for successful bookings.
  
## References

- [HTML5 Validator](https://validator.w3.org/)
- [CSS Validator](http://jigsaw.w3.org/css-validator/)
- [PHP Sessions Documentation](https://www.php.net/manual/en/book.session.php)
- [SQL Injection Prevention](https://owasp.org/www-community/attacks/SQL_Injection)

