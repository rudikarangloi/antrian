<?php namespace App\Controllers;

// Panggil JWT
use \Firebase\JWT\JWT;
// panggil class Auht
use App\Controllers\Auth;

use App\Models\Antrian_model;
// panggil restful api codeigniter 4
use CodeIgniter\RESTful\ResourceController;

header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

class getRekapAntrean extends ResourceController
{

	public function __construct()
	{
        // inisialisasi class Auth dengan $this->protect
        $this->protect = new Auth();
        $this->antrian = new Antrian_model();
	}

	public function index()
	{
        // ambil dari controller auth function public private key
        $secret_key = $this->protect->privateKey();

		$token = null;

		$authHeader = $this->request->getServer('HTTP_AUTHORIZATION');
	
		$arr = explode(" ", $authHeader);

		$token = $arr[1];

		if($token){

			try {
		
				$decoded = JWT::decode($token, $secret_key, array('HS256'));
		
				// Access is granted. Add code of the operation here 
                if($decoded){
                    // response true

                    $kodepoli   = $this->request->getPost('kodepoli');
                    $jenispoli   = $this->request->getPost('jenispoli');                    
                    $waktu   = $this->request->getPost('tanggalperiksa');

                    $datas = $this->antrian->getRekapHarian_Antrians($kodepoli,$jenispoli,$waktu );

                    if($datas['totalantrean'] == '0'){
                        $output = ['response' => 'Data Kosong','metadata' => ['message' => 'Not Ok', 'code'=>401]];
                    }else{
                        $output = ['response' => $datas,'metadata' => ['message' => 'Ok', 'code'=>200]];
                    }
                   

                    return $this->respond($output, 200);
                }
				
		
			} catch (\Exception $e){

				$output = [
					'message' => 'Access denied',
					"error" => $e->getMessage()
				];
		
				return $this->respond($output, 401);
			}
		}
	}

}
