<?php

namespace App;

/**
 * @author Yuana 
 * @since May, 20 2018
 */
class Controller {

    private $db;
    public static $msg = [
        200 => 'Success',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        500 => 'Internal Server Error'
    ];

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function index()
    {
        return $this->response(200, [
            'name' => 'Belanja API Demo',
            'version' => '1.0.0'
        ]);
    }

    public function findAll()
    {
        $products = [];

        foreach ($this->db->products() as $row) {
            $products[] = $row;
        }

        return $this->response(200, $products);
    }

    public function findById($id)
    {
        $product = $this->db->products[$id];

        return $this->response(200, $product);
    }

    public function insert()
    {
        $request = $this->jsonRequest();

        $data = $this->db->products()->insert($request);

        return $this->response(200, $data);
    }

    public function update($id)
    {
        $request = $this->jsonRequest();
        
        $this->db->products[$id]->update($request);

        $data = $this->db->products[$id];

        return $this->response(200, $data);
    }

    public function delete($id)
    {
        $this->db->products[$id]->delete();

        return $this->response(200);
    }

    public function qrCode()
    {
        return $this->response(200);
    }

    public function notFound()
    {
        return $this->response(404);
    }

    public function methodNotAllowed()
    {
        return $this->response(405);
    }

    public function response($code = 200, $data = [])
    {
        return [
            'code' => $code,
            'msg'  => $this->getMsg($code),
            'data' => $data
        ];
    }

    public function getMsg($code = 200)
    {
        return self::$msg[$code];
    }

    private function jsonRequest()
    {
        return json_decode(file_get_contents("php://input"), true);
    }
}