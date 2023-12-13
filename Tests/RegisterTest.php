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

        // Mock the database interaction (PDO statement)
        $pdoMock = $this->createMock(PDO::class);
        $statementMock = $this->createMock(PDOStatement::class);

        $pdoMock->expects($this->any())
                ->method('prepare')
                ->willReturn($statementMock);

        // Assuming that your PDO statement always returns zero rows for a new user
        $statementMock->expects($this->any())
                      ->method('rowCount')
                      ->willReturn(0);

        // Include your register script, passing the mocked PDO
        include 'register.php'; // Adjust the path if necessary

        // Check if the $message array contains the expected message
        $this->assertContains('Registered successfully, login now please!', $message);
    }

    public function testExistingUserRegistration() {
        // Simulate form submission with existing user data
        $_POST['name'] = 'John Doe';
        $_POST['email'] = 'john@example.com';
        $_POST['pass'] = 'password123';
        $_POST['cpass'] = 'password123';
        $_POST['submit'] = 'register'; // Simulate the form submission button

        // Mock the database interaction (PDO statement)
        $pdoMock = $this->createMock(PDO::class);
        $statementMock = $this->createMock(PDOStatement::class);

        $pdoMock->expects($this->any())
                ->method('prepare')
                ->willReturn($statementMock);

        // Assuming that your PDO statement returns some rows for an existing user
        $statementMock->expects($this->any())
                      ->method('rowCount')
                      ->willReturn(1);

        // Include your register script, passing the mocked PDO
        include 'register.php'; // Adjust the path if necessary

        // Check if the $message array contains the expected message
        $this->assertContains('user already exist!', $message);
    }
}
?>

