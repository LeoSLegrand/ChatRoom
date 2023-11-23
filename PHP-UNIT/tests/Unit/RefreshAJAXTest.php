<?php
use PHPUnit\Framework\TestCase;

class RefreshAJAXTest  extends TestCase {
    public function testAjaxAutoRefresh() {
        // Simulate an XMLHttpRequest
        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';

        // Include your chat.php code here
        include '../../../chat.php';

        // Add assertions based on your expected behavior
        // For example, check if the response contains the expected content
        // ...

        // Assert that the XMLHttpRequest is handled correctly
        // ...
    }
}