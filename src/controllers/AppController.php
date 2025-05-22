<?php

class AppController {
    private $request;
    public function __construct() {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet():bool {
        return $this->request === 'GET';
    }

    protected function isPost():bool {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = []) {
        $templatePath = 'public/views/'.$template.'.php';

        if (file_exists($templatePath)) {
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
            print $output;
        } else {
            http_response_code(404);

            if ($template !== '404') {
                $errorController = new DefaultController();
                $errorController->error404();
            } else {
                print "404 - Page not found."; // Even the 404.php is missing
            }
        }
    }
}