# Portfolio Website Backend Integration

This project is a portfolio management system that allows users to manage and display their portfolio, skills, projects, blog posts, and more. The system includes a secure admin panel to manage all data and a front-end website to display it to visitors.

### Resources.
1. Frontend Tempalate - (Maha CV Resume Portfolio Template) - https://www.templateshub.net/template/maha-cv-resume-portfolio-template
2. dompdf v3.0.2 - https://github.com/dompdf/dompdf/releases

## Features

### Admin Panel
- Manage **Skills** (Add, Edit, Delete, View)
- Manage **Projects** (Add, Edit, Delete, View)
- Manage **Blog Posts** (Add, Edit, Delete, View)
- Manage **Messages** (View and Respond)
- Manage **About Me**, **Education**, and **Work Experience**
- Manage **Home Section** data including contact details and social links
- Generate and download a CV based on database content

### Front-End
- Display portfolio details such as:
  - Home Section (Name, Title, Contact Info, Social Links)
  - Skills
  - Projects
  - Blog Posts
- Contact form for visitors to send messages
- Responsive design for all devices

---

## Prerequisites

Before you start, ensure you have the following installed:
- PHP (7.x or higher)
- MySQL
- XAMPP, WAMP, or any web server with PHP and MySQL support
- A browser (Google Chrome, Firefox, etc.)

---

## Setup Instructions

### 1. Clone or Download the Project
Clone the repository or download it as a ZIP file and extract it to your web server's root directory:
- For XAMPP: Place the project folder in `C:/xampp/htdocs/`.
- For WAMP: Place the project folder in `C:/wamp/www/`.

### 2. Configure the Database
1. Open **phpMyAdmin** (http://localhost/phpmyadmin/).
2. Create a new database named `folio`.
3. Import the provided SQL file (`database.sql`) into the `folio` database.
   - This file contains the table structure and initial data.

### 3. Configure the System
1. Open the `config.php` file in the root directory.
2. Update the database connection details:
   ```php
   $servername = "localhost";
   $username = "root";
   $password = ""; // Add your MySQL password if applicable
   $dbname = "folio";
### 4. Start the Server
1. For XAMPP: Start Apache and MySQL from the XAMPP Control Panel.
2. For WAMP: Start the server.
### 5. Access the System
1. Open your browser and go to:
2. Admin Panel: http://localhost/Portfolio-Website_Backend-Integration/admin/
3. Front-End: http://localhost/Portfolio-Website_Backend-Integration/
### 6. Login to the Admin Panel
- Use the following default credentials:
```credential
Username: jack34
Password: 123
```
### Demo
- Hosting platform - https://www.infinityfree.com/
- Front-end - https://jacktoneokwembaweb.free.nf
- Back-end - https://jacktoneokwembaweb.free.nf/admin