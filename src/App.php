<?php

namespace App;

use PDO;
use NotORM;
use FastRoute;
use FastRoute\Dispatcher;

/**
 * @author Yuana 
 * @since May, 20 2018
 */
class App {

    private $rootDir;
    private $viewDir;
    private $pdo;
    private $db;
    private $renderer;

    public function __construct($rootDir)
    {
        $this->rootDir = $rootDir;
        $this->viewDir = $rootDir . DIRECTORY_SEPARATOR . 'views';
    }

    public function setup()
    {
        $this->setupPdo();
        $this->setupNotOrm();
        $this->setupController();
        $this->setupRenderer();
    }

    private function setupPdo()
    {
        $pdo = new PDO('sqlite:' . $this->rootDir . DIRECTORY_SEPARATOR . 'db/data.db');
        $pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->pdo = $pdo;
    }

    private function setupNotOrm()
    {
        $db = new NotORM($this->pdo);
        $db->debug = true;

        $this->db = $db;
    }

    private function setupController()
    {
        $this->controller = new Controller($this->db);
    }

    private function setupRenderer()
    {
        $this->renderer = new Renderer($this->viewDir);
    }

    private function router()
    {
        return FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
            
            $r->addRoute('GET', '/', 'index');

            $r->addRoute('GET', '/products', 'findAll');
            $r->addRoute('GET', '/products/{id:\d+}', 'findById');
            $r->addRoute('POST', '/products', 'insert');
            $r->addRoute('PUT', '/products/{id:\d+}', 'update');
            $r->addRoute('DELETE','/products/{id:\d+}', 'delete');
            $r->addRoute('GET', '/products/qr-code', 'htmlQRCode');

        });
    }

    public function run()
    {
        $dispatcher = $this->router();
        $response = $this->controller->response();
        
        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        
        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);
        
        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                $response = $this->controller->notFound();
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                $response = $this->controller->methodNotAllowed();
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                $response = $this->controller->$handler($vars);
                break;
        }

        $this->renderer->render($routeInfo, $response);
    }
}