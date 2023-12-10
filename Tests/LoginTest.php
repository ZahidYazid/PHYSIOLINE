<?php



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
        $postData = [
            'email' => 'invalid@example.com',
            'pass' => 'invalid_password',
            'submit' => 'login now'
        ];

        $ch = curl_init('http://localhost/PHYSIOLINE/login.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        // Execute the request and capture the output
        $loginPage = curl_exec($ch);

        // Check if the captured content contains the incorrect credentials message
        if (strpos($loginPage, 'incorrect username or password!') !== false) {
            $this->assertTrue(true, 'Incorrect credentials message displayed.');
        } else {
            $this->fail('No message received after login attempt.');
        }

        // Close curl resource
        curl_close($ch);
    }

    // Add more test cases for valid login credentials, session handling, etc.
}
?>
