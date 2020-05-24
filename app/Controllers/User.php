<?php 
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class User extends ResourceController{
    protected $modelName  = 'App\Models\Users';
    //tipe data keluaran berupa json
    protected $format     = 'json';

    // menangani GET Request untuk endpoint (users)
    public function index()
    {
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
    }
}