<?php 
namespace App\Database\Seeds;
use CodeIgniter\I18n\Time;

class UserSeeder extends \CodeIgniter\Database\Seeder{
    public function run(){
        $data = [
            'email'         => 'rum.haidar@hotmail.com',
            'password'      => password_hash('rahasia', PASSWORD_BCRYPT),
            'name'          => 'Rum Haidar Fauzan',
            'gender'        => 'L',
            'address'       => 'Jalan Sesama',
            'created_at'    => new Time('now')
        ];

        $this->db->table('users')->insert($data);
    }
}