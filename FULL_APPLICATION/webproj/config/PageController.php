<?php
class PageController {

    public function serveHomePage(string $requestMethod) {
        if ($requestMethod == "GET") {
            header('Location: /webproj/home.php');
            exit;
        }
    }
    
}

?>