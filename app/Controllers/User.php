<?php 
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Response;

class User extends ResourceController{
    protected $modelName  = 'App\Models\Users';
    //tipe data keluaran berupa json
    protected $format     = 'json';

    
    public function __construct()
    {
        helper('authorization');
    }
    

    // menangani GET Request untuk endpoint (users)
    public function index()
    {        
        $auth_header = $this->request->getServer('HTTP_AUTHORIZATION');
        
        // jika terdapat header Authorization
        if($auth_header){
            try {
                $decoded = decode($auth_header);
                if($decoded){

                    // mulai Controller
                    $data = $this->model->findAll();
                    if($data){
                        // respon untuk data rekaman jika ada
                        return $this->respond([
                            'status'	=> 200,
                            'data'		=> $data
                        ]);
                    }
                    else{
                        // respon untuk data rekaman jika kosong
                        return $this->failNotFound('No records found.');
                    }
                    // akhir Controller

                }
            } 
            // tangkap galat
            catch (\Exception $e){
                 return $this->respond([
                    'status' => 401,
                    'error' => 401,
                    "message" => $e->getMessage()
                ], 401);
            }
        }
        // jika tidak ada header Authorization
        else{
            return $this->respond([
                'status' => 401,
                'error' => 401,
                "message" => 'Unauthorized'
            ], 401);
        }
    }

}