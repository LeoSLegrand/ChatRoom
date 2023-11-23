<?php
use PHPUnit\Framework\TestCase;

class sendMessageTest  extends TestCase {
    public function testSendMessage() {
        // Simulate a POST request with a message
        $_POST['send'] = true;
        $_POST['message'] = 'Test message';

        $conMock = $this->createMock(\mysqli::class);
        $this->methodAllowsDatabaseInsertion($conMock);

        $this->expectsHeaderRedirect('location: chat.php');

        // Include your chat.php code here
        include '../../../chat.php';

        // Add assertions based on your expected behavior
        // For example, check if the message is inserted into the database
        // and if the page is redirected
        // ...

      // Add assertions based on your expected behavior
        // For example, check if the message is inserted into the database
        $this->assertMessageInsertedIntoDatabase($conMock, 'Test message');

    }
}