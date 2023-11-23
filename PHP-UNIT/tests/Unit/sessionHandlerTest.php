<?php
use PHPUnit\Framework\TestCase;

class sessionHandlerTest  extends TestCase {
    public function testSessionHandlingAndRedirection() {
        // Simulate the session not being set
        $_SESSION = [];

        // Include your chat.php code here
        include '../../../chat.php';

        // // Assert that the user is redirected to index.php
        // $this->assertStringContainsString('Location: index.php', xdebug_get_headers());

           // Assert that the user is redirected to index.php
           $headers = xdebug_get_headers();
           $this->assertContains('Location: index.php', $headers);
    }
}