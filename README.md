Motor Insurance Management System
This Motor Insurance Management System is a full-stack web application that handles vehicle insurance tasks such as obtaining new policies, filing claims, and renewing existing policies. The system leverages secure OTP-based authentication for user validation and uses Tesseract-OCR for vehicle number image comparison to ensure data integrity.

Features
OTP-based Authentication: Secure user login using email OTP verification.
Vehicle Number Image Comparison: Uses Tesseract-OCR for extracting and comparing vehicle numbers from images.
Policy Management: Obtain, claim, and renew insurance policies.
Responsive Design: Ensures a seamless experience across different devices.
Prerequisites
Before setting up the project, ensure you have the following installed:

XAMPP or any other web server with PHP support.
Composer for managing PHP dependencies.
Tesseract-OCR for vehicle number image processing.
PHPMailer for sending OTPs through email.
Setup Instructions
1. Clone the Repository
bash
Copy code
git clone https://github.com/yourusername/motor-insurance-management-system.git
cd motor-insurance-management-system
2. Install Tesseract-OCR
Download: tesseract-ocr-w64-setup-5.4.0.20240606.exe (64 bit)
Install: Run the installer and follow the on-screen instructions.
Path: Ensure Tesseract-OCR is installed at C:\Program Files\Tesseract-OCR (or the directory you chose).
3. Install Composer
Download: Composer Setup
Install: Follow the installation instructions on the Composer website.
4. Install Project Dependencies
Open a command prompt in the project directory and run:

bash
Copy code
composer install
This will install the required PHP dependencies, including PHPMailer, listed in the composer.json file.

5. Set Up Your Environment
Database: Create a MySQL database and import the provided SQL file located in the database folder.
Environment Variables: Configure your .env file with the necessary credentials and settings (e.g., database credentials, email server settings for OTP).
6. Configure Apache and PHP
Ensure that your XAMPP or web server is configured correctly:

Enable GD Library: Required for image processing.
PHP Version: Ensure you're using PHP 8.2.12 or later.
7. Run the Application
Start Apache and MySQL: Using the XAMPP control panel.
Access the Application: Open your browser and navigate to http://localhost/yourprojectfolder/.
8. Testing the System
OTP Functionality: Register a new user and test the OTP-based login process.
Image Comparison: Test the vehicle number comparison feature by uploading images during the policy application process.
9. Troubleshooting
Tesseract Path Issue: If Tesseract is not recognized, add the path C:\Program Files\Tesseract-OCR to your system's environment variables.
Composer Issues: Ensure composer is in your system's PATH and re-run composer install if dependencies fail to load.
