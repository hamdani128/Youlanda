<?php
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Config\Database;

class ApiProduct extends ResourceController{
    
    use ResponseTrait;
    
    public function display_product($id_unit)
    {   

        $db = Database::connect();
        if ($id_unit == NUll || $id_unit == '' || $id_unit == 0) {
            $SQL = "SELECT kode,item,harga,qty,subtotal FROM op_master_product GROUP BY 1,2,3,4,5";
        }else{
            $SQL = "SELECT kode,item,harga,qty,subtotal FROM op_master_product WHERE id_unit='" . $id_unit . "' GROUP BY 1,2,3,4,5";
        }
        $query = $db->query($SQL);
        $data = $query->getResult();
        return $this->respond($data);
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        $db = Database::connect();
        $unit_id = $this->request->getVar('unit_id');
        $date = $this->request->getVar('date');
        $code_transaction = $this->request->getVar('code_transaction');
        $code_product = $this->request->getVar('code_product');
        $item = $this->request->getVar('item');
        $harga = $this->request->getVar('harga');
        $qty = $this->request->getVar('qty');
        $subtotal = $this->request->getVar('subtotal');
        $potongan = $this->request->getVar('potongan');
        $sales = $this->request->getVar('sales');
        $station = $this->request->getVar('station');
        $created_at =  $this->request->getVar('created_at');
        $update_at = $this->request->getVar('created_at_sales');
        $data = [
            'unit_id' => $unit_id,
            'date' => $date,
            'code_transaction' => $code_transaction,
            'code_product' => $code_product,
            'item' => $item,
            'harga' => $harga,
            'qty' => $qty,
            'subtotal' => $subtotal,
            'potongan' => $potongan,
            'sales' => $sales,
            'station' => $station,
            'created_at' => $created_at,
            'created_at_sales' => $update_at
        ];
        $query = $db->table('op_sales_income')->insert($data);
        if($query){
            $response = [
                'status' => 201,
                'error' => null,
                'message' => [
                    'success' => 'Data berhasil ditambahkan'
                ]
            ];
        }else{
            $response = [
                'status' => 500,
                'error' => null,
                'message' => [
                    'error' => 'Data gagal ditambahkan'
                ]
            ];
        }
        return $this->respondCreated($response);
    }


    public function create_order_pesanan()
    {
        date_default_timezone_set('Asia/Jakarta');
        $db = Database::connect();
        $unit_id = $this->request->getVar('unit_id');
        $date = $this->request->getVar('date');
        $code_transaction = $this->request->getVar('code_transaction');
        $code_product = $this->request->getVar('code_product');
        $item = $this->request->getVar('item');
        $harga = $this->request->getVar('harga');
        $qty = $this->request->getVar('qty');
        $subtotal = $this->request->getVar('subtotal');
        $potongan = $this->request->getVar('potongan');
        $konsumen = $this->request->getVar('konsumen');
        $hp = $this->request->getVar('hp');
        $created_at =  $this->request->getVar('created_at');
        $update_at = $this->request->getVar('created_at_sales');

        $data = [
            'unit_id' => $unit_id,
            'date' => $date,
            'code_transaction' => $code_transaction,
            'code_product' => $code_product,
            'item' => $item,
            'harga' => $harga,
            'qty' => $qty,
            'subtotal' => $subtotal,
            'potongan' => $potongan,
            'konsumen' => $konsumen,
            'hp' => $hp,
            'created_at' => $created_at,
            'created_at_sales' => $update_at
        ];
        $query = $db->table('op_order_income')->insert($data);
        if($query){
            $response = [
                'status' => 201,
                'error' => null,
                'message' => [
                    'success' => 'Data berhasil ditambahkan'
                ]
            ];
        }else{
            $response = [
                'status' => 500,
                'error' => null,
                'message' => [
                    'error' => 'Data gagal ditambahkan'
                ]
            ];
        }
        return $this->respondCreated($response);
    }

    public function get_karyawan($karyawan){
        $db = Database::connect();
        $SQL = "SELECT id,nama, bagian, jabatan, departemen, unit FROM sdm_master WHERE nama LIKE '%" . $karyawan . "%'";
        $query = $db->query($SQL)->getResult();
        $data = $query;
        return $this->respond($data);
    }

}