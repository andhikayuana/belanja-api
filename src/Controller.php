<?php

namespace App;

/**
 * @author Yuana 
 * @since May, 20 2018
 */
class Controller {

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function tes()
    {
        //todo
        echo 'this is from test';
        foreach ($this->db->products() as $row) {
            var_dump($row);
        }
    }
}