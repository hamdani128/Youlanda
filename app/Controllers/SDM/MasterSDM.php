<?php

namespace App\Controllers\SDM;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Database\Config;
use Config\Database;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class MasterSDM extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);

        $db = \Config\Database::connect();
        // $data['sdm'] = $db->table('sdm_master')->get()->getResultObject();
        $data = [
            'title' => 'SDM | Auditor',
            'sdm' => $db->table('sdm_master')->where('status_karyawan', 'Increase')->get()->getResultObject(),
            'userinfo' => $UserInfo,
        ];
        return view('pages/sdm/mastersdm', $data);
    }

    public function import()
    {
        $db = Database::connect();

        $file = $this->request->getFile('file');
        $ext = $file->getClientExtension();

        if ($ext === 'Xls') {
            $render = new Xls();
        } else {
            $render = new Xlsx();
        }
        $kosongkan = $db->table('sdm_master')->truncate();
        $spreadsheet = $render->load($file);
        $data = $spreadsheet->getActiveSheet()->toArray();

        foreach ($data as $x => $row) {
            if ($x == 0) {
                continue;
            }
            $nama = $row[0];
            $tempat_lahir = $row[1];
            $tanggal_lahir = date('Y-m-d', strtotime($row[2]));
            $jk = $row[3];
            $pendidikan = $row[4];
            $tmk = date('Y-m-d', strtotime($row[5]));
            $bagian = $row[6];
            $Jabatan = $row[7];
            $Departement = $row[8];
            $UnitTeknis = $row[9];
            $Alamat = $row[10];
            $StatusKawin = $row[11];
            $Telepon = $row[12];
            $IbuKandung = $row[13];
            $StatusKaryawan = $row[14];

            $data = [
                'nama' => $nama,
                'tempat_lahir' => $tempat_lahir,
                'tgl_lahir' => $tanggal_lahir,
                'jk' => $jk,
                'pendidikan' => $pendidikan,
                'tmk' => $tmk,
                'bagian' => $bagian,
                'jabatan' => $Jabatan,
                'departemen' => $Departement,
                'unit' => $UnitTeknis,
                'alamat' => $Alamat,
                'status' => $StatusKawin,
                'telepon' => $Telepon,
                'ibu_kandung' => $IbuKandung,
                'status_karyawan' => $StatusKaryawan,
            ];

            $query = $db->table('sdm_master')->insert($data);
        }
        if ($query) {
            session()->setFlashData('message', 'Import Data SDM Berhasil !');
            return redirect()->to('/sdm/master');
        }
    }

    public function add()
    {
        date_default_timezone_set('Asia/jakarta');
        $now = date("Y-m-d H:i:s");
        $db = Database::connect();

        $nama = $this->request->getPost('name');
        $tempat = $this->request->getPost('tempat');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $jk = $this->request->getPost('jk');
        $pendidikan = $this->request->getPost('pendidikan');
        $tmk = $this->request->getPost('tmk');
        $bagian = $this->request->getPost('bagian');
        $Jabatan = $this->request->getPost('jabatan');
        $Departement = $this->request->getPost('departemen');
        $unit = $this->request->getPost('unit_teknis');
        $alamat = $this->request->getPost('alamat');
        $status_kawin = $this->request->getPost('status_kawin');
        $telepon = $this->request->getPost('telepon');
        $ibu_kandung = $this->request->getPost('ibu_kandung');
        $status_karyawan = $this->request->getPost('status_karyawan');

        $data = [
            'nama' => $nama,
            'tempat_lahir' => $tempat,
            'tgl_lahir' => $tgl_lahir,
            'jk' => $jk,
            'pendidikan' => $pendidikan,
            'tmk' => $tmk,
            'bagian' => $bagian,
            'jabatan' => $Jabatan,
            'departemen' => $Departement,
            'unit' => $unit,
            'alamat' => $alamat,
            'status' => $status_kawin,
            'telepon' => $telepon,
            'ibu_kandung' => $ibu_kandung,
            'status_karyawan' => $status_karyawan,
        ];

        $query = $db->table('sdm_master')->insert($data);
        if ($query) {
            session()->setFlashData('message', 'Data SDM Berhasil Disimpan !');
            return redirect()->to('/sdm/master');
        }

    }

    public function delete_sdm($id)
    {
        $db = Database::connect();
        $query = $db->table('sdm_master')->where('id', $id)->delete();
        if ($query) {
            session()->setFlashData('message', 'Data SDM Berhasil Terhapus !');
            return redirect()->to('/sdm/master');
        }
    }

    public function show_update()
    {
        $id = $_GET['id'];
        $db = Database::connect();
        $query = $db->table('sdm_master')->where('id', $id)->get()->getRowObject();
        $data[0] = $query->nama;
        $data[1] = $query->tempat_lahir;
        $data[2] = $query->tgl_lahir;
        $data[3] = $query->jk;
        $data[4] = $query->pendidikan;
        $data[5] = $query->tmk;
        $data[6] = $query->bagian;
        $data[7] = $query->jabatan;
        $data[8] = $query->departemen;
        $data[9] = $query->unit;
        $data[10] = $query->alamat;
        $data[11] = $query->status;
        $data[12] = $query->telepon;
        $data[13] = $query->ibu_kandung;
        $data[14] = $query->status_karyawan;
        return json_encode($data);
    }

    public function update()
    {
        $id = $this->request->getPost('id_update');
        $nama = $this->request->getPost('name_update');
        $tempat = $this->request->getPost('tempat_update');
        $tgl_lahir = $this->request->getPost('tgl_lahir_update');
        $jk = $this->request->getPost('jk_update');
        $pendidikan = $this->request->getPost('pendidikan_update');
        $tmk = $this->request->getPost('tmk_update');
        $bagian = $this->request->getPost('bagian_update');
        $jabatan = $this->request->getPost('jabatan_update');
        $departemen = $this->request->getPost('departemen_update');
        $unit = $this->request->getPost('unit_teknis_update');
        $alamat = $this->request->getPost('alamat_update');
        $status_kawain = $this->request->getPost('status_kawin_update');
        $telepon = $this->request->getPost('telepon_update');
        $ibu_kandung = $this->request->getPost('ibu_kandung_update');
        $status_karyawan = $this->request->getPost('status_karyawan_update');

        date_default_timezone_set('Asia/jakarta');
        $now = date("Y-m-d H:i:s");
        $db = Database::connect();

        $data = [
            'nama' => $nama,
            'tempat_lahir' => $tempat,
            'tgl_lahir' => $tgl_lahir,
            'jk' => $jk,
            'pendidikan' => $pendidikan,
            'tmk' => $tmk,
            'bagian' => $bagian,
            'jabatan' => $jabatan,
            'departemen' => $departemen,
            'unit' => $unit,
            'alamat' => $alamat,
            'status' => $status_kawain,
            'telepon' => $telepon,
            'ibu_kandung' => $ibu_kandung,
            'status_karyawan' => $status_karyawan,
        ];

        $query = $db->table('sdm_master')->where('id', $id)->update($data);
        if ($query) {
            session()->setFlashData('message', 'Data SDM Berhasil Terupdate !');
            return redirect()->to('/sdm/master');
        }

    }

    public function show_add_resign()
    {
        $id = $_GET['id'];
        $db = Config::connect();
        $query = $db->table('sdm_master')->where('id', $id)->get()->getRowObject();
        $data[0] = $query->nama;
        $data[1] = $query->bagian;
        $data[2] = $query->jabatan;
        $data[3] = $query->departemen;
        $data[4] = $query->unit;
        $data[5] = $query->tmk;
        $data[6] = $query->jk;
        return json_encode($data);
    }

    public function add_resign()
    {
        date_default_timezone_set('Asia/jakarta');
        $now = date("Y-m-d H:i:s");
        $db = Database::connect();
        $loggedUserID = session()->get('loggedUser');

        $tgl_resign = $this->request->getPost('tgl_resign');
        $id_karyawan = $this->request->getPost('id_karyawan');
        $nama = $this->request->getPost('nama');
        $bagian = $this->request->getPost('bagian');
        $jabatan = $this->request->getPost('jabatan');
        $departemen = $this->request->getPost('departemen');
        $unit_teknis = $this->request->getPost('departemen');
        $tmk = $this->request->getPost('tmk');
        $jk = $this->request->getPost('jk');
        $keterangan = $this->request->getPost('keterangan');

        $data = [
            'date_resign' => $tgl_resign,
            'nama' => $nama,
            'bagian' => $bagian,
            'jabatan' => $jabatan,
            'departemen' => $departemen,
            'tmk' => $tmk,
            'jk' => $jk,
            'keterangan' => $keterangan,
            'karyawan_id' => $id_karyawan,
            'user_id' => $loggedUserID,
            'created_at' => $now,
            'updated_at' => $now,
        ];
        $query = $db->table('sdm_resign')->insert($data);
    }

    public function resign()
    {
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);

        $db = \Config\Database::connect();
// $data['sdm'] = $db->table('sdm_master')->get()->getResultObject();
        $data = [
            'title' => 'SDM | Auditor',
            'sdm' => $db->table('sdm_resign')->get()->getResultObject(),
            'userinfo' => $UserInfo,
        ];
        return view('pages/sdm/resign', $data);

    }

}