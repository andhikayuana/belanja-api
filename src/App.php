<?php
namespace App;

use PDO;
use NotORM;

/**
 * @author Yuana 
 * @since May, 20 2018
 */
class App {

    private $rootDir;
    private $pdo;
    private $db;

    public function __construct($rootDir)
    {
        $this->rootDir = $rootDir;
    }

    public function setup()
    {
        $this->setupPdo();
        $this->setupNotOrm();
        $this->setupController();
    }

    private function setupPdo()
    {
        $pdo = new PDO('sqlite:' . $this->rootDir . DIRECTORY_SEPARATOR . 'db/data.db');
        $pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

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

    public function run()
    {
        echo 'tes';
        //todo add routing here
        foreach ($this->db->products() as $row) {
            var_dump($row);
        }

        $this->controller->tes();
    }
}