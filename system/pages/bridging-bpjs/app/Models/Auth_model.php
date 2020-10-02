<?php

namespace App\Models;

use CodeIgniter\Model;

class Auth_model extends Model{

    protected $table = "tbladmin";
    protected $tableAdmin = "tbladmin";

    public function register($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query ? true : false;
    }

    public function cek_login($email)
    {
        $query = $this->table($this->table)
                ->where('email', $email)
                ->countAll();

        if($query >  0){
            $hasil = $this->table($this->table)
                    ->where('email', $email)
                    ->limit(1)
                    ->get()
                    ->getRowArray();
        } else {
            $hasil = array(); 
        }
        return $hasil;
    }

    public function cek_admin($username)
    {
       
		$query = $this->table($this->tableAdmin)
                ->where('username', $username)
                ->countAll();

        if($query >  0){
            $hasil = $this->table($this->tableAdmin)
                    ->where('username', $username)
                    ->limit(1)
                    ->get()
                    ->getRowArray();
			//$hasil = $username; 
        } else {
			
            $hasil = array(); 
        }
        return $hasil;
    }
}