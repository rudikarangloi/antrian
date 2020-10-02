<?php

namespace App\Models;

use CodeIgniter\Model;

class Antrian_model extends Model{

    protected $table = "data_antrian";

    public function register($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query ? true : false;
    }

   
    public function getAnyData_Antrians($nomorkartubpjs,$nik,$nomortelp,$nomorreferensi,$jenisreferensi,$jenisantrian,$jenispoli,$kdpoli,$waktu)
    {                 
        $conditions = array(
                            'nomorkartubpjs' => $nomorkartubpjs, 'nik' => $nik, 'nomortelp' => $nomortelp,
                            'nomorreferensi' => $nomorreferensi, 'jenisreferensi' => $jenisreferensi, 'jenisantrian' => $jenisantrian, 
                            'jenispoli' => $jenispoli, 'kdpoli' => $kdpoli
                            );
       
        

       
            $hasil = $this->table('data_antrian')
                ->select('nomor AS nomorantrean,kodebooking,jenisantrian,
                                CAST(TIMEDIFF(CONVERT(waktu, TIME),CONVERT(waktudilayani, TIME)) AS UNSIGNED)  AS estimasidilayani,
                                (SELECT description FROM client_antrian WHERE client=data_antrian.counter) AS nampoli,
                                , namadokter'
                                )
                ->join('client_antrian', 'data_antrian.counter = client_antrian.client')
                ->where($conditions)           
                ->like('waktu', $waktu, 'after')
                ->get()
                ->getRowArray();            
       

       
        return $hasil;
    }

    public function getRekapHarian_Antrians($kdpoli,$jenispoli,$waktu) {	    
                    
        $conditions = array('kdpoli' => $kdpoli, 'jenispoli' => $jenispoli );

        $hasil = $this->table('data_antrian')
           ->select('(SELECT description FROM client_antrian WHERE client=data_antrian.counter) AS nampoli,  COUNT(*) AS totalantrean,  SUM(terlayani) AS terlayani,    waktu AS lastupdate')
           ->join('client_antrian', 'data_antrian.counter = client_antrian.client')
            ->where($conditions)           
            ->like('waktu', $waktu, 'after')
            ->get()
            ->getRowArray();

        return $hasil;
							
        
    }
    
}