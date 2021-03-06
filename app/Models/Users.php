<?php 
namespace App\Models;

use CodeIgniter\Model;

class Users extends Model{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    // field-field yang hanya boleh diisi
    protected $allowedFields = ['email', 'password', 'name', 'gender', 'address'];
    // nilai balik berupa array
    protected $returnType = 'array';
    // penghapusan data sementara atau tidak benar-benar terhapus
    protected $useSoftDeletes = true;
    
    // set waktu pembuatan, pembaruan dan penghapusan data
    protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
    public function get_user($user)
    {
        $record = $this->table($this->table)
                ->where('email', $user)
                ->countAll();
 
        if($record > 0){
            $result = $this->table($this->table)
                    ->where('email', $user)
                    ->limit(1)
                    ->get()
                    ->getRowArray();
        } 
        else{
            $result = []; 
        }
        return $result;
    }
}