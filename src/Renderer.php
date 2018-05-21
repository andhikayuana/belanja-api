<?php

namespace App;

/**
 * @author Yuana 
 * @since May, 21 2018
 */
class Renderer {

    private $viewDir;

    public function __construct($viewDir)
    {
        $this->viewDir = $viewDir;
    }

    public function render($routeInfo, $response)
    {
        if (count($routeInfo) > 1 && Util::startsWith($routeInfo[1], 'html')) {
            $this->renderHtml($response);
        } else {
            $this->renderJson($response);
        }
    }

    private function renderJson($response)
    {
        header('content-type: application/json');
        header("HTTP/1.1 {$response['code']} {$response['msg']}"); 
        echo json_encode($response, JSON_NUMERIC_CHECK);
    }

    private function renderHtml($response)
    {
        header('content-type: text/html; charset=UTF-8');

        $viewFile = $this->viewDir . DIRECTORY_SEPARATOR . $response[0] . '.php';
        $viewData = $response[1];

        if (file_exists($viewFile)) {
            extract($viewData);
            require_once $viewFile;
        } else {
            throw new \Exception("View {$viewFile} not found!");
        }
    }
}