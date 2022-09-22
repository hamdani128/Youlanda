<?php

namespace App\Controllers\OP;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Config\Database;

class OpersionalGudangController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];
        $unit = $UserInfo['unit'];

        $db = \Config\Database::connect();
        $product = $db->table('op_master_items a')
            ->join('mg_master_items b', 'a.kode = b.kode')
            ->select('a.kode as kode, b.item as item, b.satuan as satuan, a.qty as qty, b.kategori as kategori')
            ->where('a.id_unit', $unit_id)->orderBy('a.kode', 'ASC');
        $data = [
            'title' => 'OPGD | ' . $unit . ' | Dashboard',
            'userinfo' => $UserInfo,
            'product' => $product->get()->getResultObject(),
        ];
        return view('pages/operasional_gdg/view_items', $data);
    }

    // Create ID Request

    public function ID_Reqeust_Unit($unit_id, $date)
    {
        $db = Database::connect();
        $sql = "SELECT MAX(RIGHT(code,4)) as kd_max FROM op_request_gdg WHERE event_date ='" . $date . "' AND unit_id='" . $unit_id . "'";
        $query = $db->query($sql);
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            $n = ((int) $row->kd_max) + 1;
            $no = sprintf("%04s", $n);
        } else {
            $no = "0001";
        }
        $kode = 'OPGD-' . date('ymd') . "-" . $unit_id . $no;
        return $kode;
    }

    public function autocomplete()
    {
        helper(['form', 'url']);
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];

        $data = [];
        $db = \Config\Database::connect();
        $builder = $db->table('op_master_items a')
            ->join('mg_master_items b', 'a.kode = b.kode')
            ->select('a.kode as kode, b.item as item, b.satuan as satuan, a.qty as qty, b.kategori as kategori')
            ->where('a.id_unit', $unit_id)->like('item', $this->request->getVar('q'))->orderBy('a.kode', 'ASC')->get();
        // $query = $builder->like()
        //     ->select('id, name as text')
        //     ->limit(10)->get();
        $data = $builder->getResult();
        echo json_encode($data);

    }

    // index Request

    public function request()
    {
        date_default_timezone_set('Asia/jakarta');
        $date = date('Y-m-d');
        $db = Database::connect();
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];
        $unit = $UserInfo['unit'];
        $product = $db->table('op_master_items a')
            ->join('mg_master_items b', 'a.kode = b.kode')
            ->select('a.kode as kode, b.item as item, b.satuan as satuan, a.qty as qty, b.kategori as kategori')
            ->where('a.id_unit', $unit_id)->orderBy('a.kode', 'ASC')->get()->getResultObject();

        $request = $db->table('op_request_gdg')->where('unit_id', $unit_id)->where('event_date', $date)->get()->getResultObject();

        $data = [
            'userinfo' => $UserInfo,
            'title' => 'OPGD | ' . $unit . ' | Order Request',
            'product' => $product,
            'request_id' => $this->ID_Reqeust_Unit($unit_id, $date),
            'request' => $request,
        ];
        return view('pages/operasional_gdg/view_request', $data);
    }

    // End Index Request

    public function autocomplete_request()
    {
        // helper(['form', 'url']);
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];

        $data = [];
        $db = \Config\Database::connect();
        $builder = $db->table('op_master_items a')
            ->join('mg_master_items b', 'a.kode = b.kode')
            ->select('a.kode as kode, b.item as item, b.satuan as satuan, a.qty as qty, b.kategori as kategori')
            ->where('a.id_unit', $unit_id)->like('item', $_GET['term'])->orderBy('a.kode', 'ASC')->get()->getResult();
        if (count($builder) > 0) {
            foreach ($builder as $row) {
                $arr_result[] = $row->item;
            }
            echo json_encode($arr_result);
        }
    }

    public function add_entry_by_item()
    {
        $item = $_GET['name_item'];
        $qty = $_GET['qty'];

        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];

        $db = Database::connect();
        $builder = $db->table('op_master_items a')
            ->join('mg_master_items b', 'a.kode = b.kode')
            ->select('a.kode as kode, b.item as item, b.satuan as satuan, a.qty as qty, b.kategori as kategori')
            ->where('a.id_unit', $unit_id)->where('item', $item)->orderBy('a.kode', 'ASC')->get()->getRowObject();

        $data[0] = $builder->kode;
        $data[1] = $builder->item;
        $data[2] = $builder->satuan;
        $data[3] = $qty;
        $data[4] = $builder->kategori;
        return json_encode($data);
    }

    public function id_change_request()
    {
        $date = $_GET['date'];

        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];

        $db = Database::connect();
        $sql = "SELECT MAX(RIGHT(code,4)) as kd_max FROM op_request_gdg WHERE event_date ='" . date("Y-m-d", strtotime($date)) . "' AND unit_id='" . $unit_id . "'";
        $query = $db->query($sql);
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            $n = ((int) $row->kd_max) + 1;
            $no = sprintf("%04s", $n);
        } else {
            $no = "0001";
        }
        $kode = 'OPGD-' . date('ymd', strtotime($date)) . "-" . $unit_id . $no;
        return json_encode($kode);
    }

    public function add_detail()
    {
        $id_request = $_GET['id_request'];
        $kode = $_GET['kode'];
        $item = $_GET['item'];
        $satuan = $_GET['satuan'];
        $qty = $_GET['qty'];
        $kategori = $_GET['kategori'];
        $keterangan = $_GET['keterangan'];
        $date_request = $_GET['date_request'];

        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];
        date_default_timezone_set('Asia/jakarta');
        $datenow = date('Y-m-d H:m:s');

        $db = Database::connect();
        $data = [
            'event_date' => date('Y-m-d', strtotime($date_request)),
            'unit_id' => $unit_id,
            'code' => $id_request,
            'kode' => $kode,
            'qty' => $qty,
            'kategori' => $kategori,
            'keterangan' => $keterangan,
            'user_id' => $loggedUserID,
            'created_at' => $datenow,
            'updated_at' => $datenow,
        ];
        $query = $db->table('op_request_gdg_detail')->insert($data);
    }

    public function add_request()
    {
        $date_request = $_GET['date_request'];
        $id_request = $_GET['id_request'];

        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];
        $name_unit = $UserInfo['unit'];
        date_default_timezone_set('Asia/jakarta');
        $datenow = date('Y-m-d H:m:s');

        $db = Database::connect();
        $data = [
            'event_date' => date('Y-m-d', strtotime($date_request)),
            'unit_id' => $unit_id,
            'name' => $name_unit,
            'code' => $id_request,
            'keterangan' => 'Request',
            'created_at' => $datenow,
            'updated_at' => $datenow,
        ];
        $query = $db->table('op_request_gdg')->insert($data);
    }

}