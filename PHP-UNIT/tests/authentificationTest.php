<?php
use PHPUnit\Framework\TestCase;

class authentificationTest  extends TestCase {
    public function testUserAuthentication() {
        // Simulate a POST request with valid credentials
        $_POST['button_con'] = true;
        $_POST['email'] = 'test@example.com';
        $_POST['mdp1'] = 'password123';

        // Include your index.php code here
        include '../../../index.php';

        // Add assertions based on your expected behavior
        // For example, check if the user is redirected to chat.php
        // ...

        // Assert Redirection
        $this->assertStringContainsString('Location: chat.php', xdebug_get_headers());

        //Assert Session State
        $this->assertArrayHasKey('user', $_SESSION);

        //Assert Error Message
        $this->assertStringContainsString('Email ou Mot de passe incorrect(s) !', $error);
    
    }
}