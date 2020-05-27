<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Users;
use CodeIgniter\API\ResponseTrait;

class Auth extends Controller{

    use ResponseTrait;
    
    public function __construct()
    {
        $this->user = new Users();
        // load helper authorization_helper.php
        helper('authorization');
    }

    public function index(){
        return $this->respond([
            'status' => 200,
            'message' => 'Welcome!'
        ], 200);
    }

    public function check_login(){
        $validation =  \Config\Services::validation();
        
        $request = $this->request->getPost();
        // 'login_rules' adalah aturan untuk proses login yang dbuat pada validasi
        if($validation->run($request, 'login_rules') == FALSE){
            return $this->respond([
                'status' => 400,
                'error' => 400,
                'data' => $validation->getErrors()
            ], 400);
        }
        else{
            $user = $this->user->get_user($request['user']);
            
            if(password_verify($request['pass'], $user['password'])){
                $encode = encode($user);
                $jwt = json_decode($encode);
                return $this->respond([
                    'status' => 200,
                    'message' => 'Login success',
                    'data' => [
                        'email' => $user['email'],
                        'token' => $jwt->token,
                        'expired_at' => $jwt->expired_at
                    ]
                ], 200);
            }
            else{
                return $this->respond([
                    'status' => 401,
                    'error' => 401,
                    'message' => 'Login failed'
                ], 401);
            }
        }
    }

}