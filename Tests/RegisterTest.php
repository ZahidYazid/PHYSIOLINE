<?php

use PHPUnit\Framework\TestCase;

class RegisterTest extends TestCase {

    public function testValidRegistration() {
        // Simulate form submission with valid registration data
        $_POST['name'] = 'John Doe';
        $_POST['email'] = 'john@example.com';
        $_POST['pass'] = 'password123';
        $_POST['cpass'] = 'password123';
        $_POST['submit'] = 'register'; // Simulate the form submission button

        ob_start(); // Start output buffering to capture the echoed messages

        // Include your register script
        include 'register.php'; // Assuming the code you provided is in 'register.php'

        ob_end_clean(); // Clear the output buffer without displaying anything

        // Check if the registration message indicates successful registration
        global $message; // Add this line to access the $message variable

        if (isset($message) && is_array($message) && count($message) > 0) {
            $lastMessage = end($message);
            $this->assertContains('Registered successfully, login now please!', $lastMessage, 'Registration message displayed.');
        } else {
            $this->fail('No message received after registration attempt.');
        }
    }

    public function testExistingUserRegistration() {
        // Simulate form submission with existing user data
        $_POST['name'] = 'John Doe';
        $_POST['email'] = 'john@example.com';
        $_POST['pass'] = 'password123';
        $_POST['cpass'] = 'password123';
        $_POST['submit'] = 'register'; // Simulate the form submission button

        ob_start(); // Start output buffering to capture the echoed messages

        // Include your register script
        include 'register.php'; // Assuming the code you provided is in 'register.php'

        ob_end_clean(); // Clear the output buffer without displaying anything

        // Check if the registration message indicates user already exists
        global $message; // Add this line to access the $message variable

        if (isset($message) && is_array($message) && count($message) > 0) {
            $lastMessage = end($message);
            $this->assertContains('user already exist!', $lastMessage, 'User already exists message displayed.');
        } else {
            $this->fail('No message received after registration attempt.');
        }
    }
}
?>
