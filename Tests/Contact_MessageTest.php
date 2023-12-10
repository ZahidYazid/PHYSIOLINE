<?php

// Include your login script
include 'login.php'; // Assuming the code you provided is in 'login_script.php'

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase {

    public function testLoginPageAccess() {
        // Simulate HTTP request to the login page (replace 'login.php' with your actual login page URL)
        $loginPage = file_get_contents('http://localhost/PHYSIOLINE/login.php');

        // Check if the login page loads successfully (HTTP status code 200)
        $this->assertNotFalse($loginPage, 'Login page accessed successfully.');
    }

    public function testInvalidLoginCredentials() {
        // Simulate form submission with invalid credentials
        $_POST['email'] = 'invalid@example.com';
        $_POST['pass'] = 'invalid_password';
        $_POST['submit'] = 'login now'; // Simulate the form submission button

        

        // Check if the login message indicates incorrect credentials
        global $message; // Add this line to access the $message variable

        $this->assertContains('incorrect username or password!', $message, 'Incorrect credentials message displayed.');
    }

    // Add more test cases for valid login credentials, session handling, etc.
}
?>
