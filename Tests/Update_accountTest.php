<?php

namespace MyNamespace\Tests;

use PHPUnit\Framework\TestCase;

class UpdateAccountTest extends TestCase {
    protected $conn;

    protected function setUp(): void {
        $this->conn = new PDO('mysql:host=localhost;dbname=PHYSIO_DATA', 'root', '');
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function testUpdateProfile() {
        // Mock session data or set up session if required
        $_SESSION['user_id'] = 1; // Mocking the user ID for testing purposes

        $_POST['submit'] = true;
        $_POST['name'] = 'New Name';
        $_POST['email'] = 'newemail@example.com';
        // Populate other necessary $_POST data for the test

        // Get the user's initial data before the update
        $stmt = $this->conn->prepare("SELECT name, email FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $initialUserData = $stmt->fetch(PDO::FETCH_ASSOC);

        include 'update_account.php'; // Include the file to be tested

        // Get the user's data after the update
        $stmt = $this->conn->prepare("SELECT name, email FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $updatedUserData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Assert the expected outcome based on the changes in the database
        $this->assertEquals('New Name', $updatedUserData['name']);
        $this->assertEquals('newemail@example.com', $updatedUserData['email']);

        // Add more assertions based on the expected behavior
    }
}

?>
