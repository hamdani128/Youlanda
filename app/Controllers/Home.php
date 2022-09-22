<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit = $UserInfo['unit'];
        $id_unit = $UserInfo['unit_id'];
        $pegawai = $db->table('sdm_master')->where('unit', $unit)->countAllResults();
        $jlh_produk = $db->table('op_master_product')->where('id_unit', $id_unit)->countAllResults();
        if ($UserInfo['level'] == "Admin Operasional") {
            $data = [
                'title' => 'Youlanda | ' . $unit . ' ',
                'userinfo' => $UserInfo,
                'pegawai' => $pegawai,
                'jlh_produk' => $jlh_produk,
            ];
            return view('home/dashboard_operasional', $data);

        } elseif ($UserInfo['level'] == "Auditor") {
            $builder = $db->table('op_sales_income');
            $total = $builder->selectSum('subtotal', 'total')->get()->getRow();
            $qty_all = $builder->selectSum('qty', 'qty_all')->get()->getRow();
            $Sales = $db->query("SELECT b.nama_unit,SUM(a.subtotal) as Total_Belanja, SUM(a.potongan) as Total_Potongan FROM op_sales_income a LEFT JOIN au_unit b ON a.unit_id = b.kode_unit WHERE a.date='2022-02-18' GROUP BY a.unit_id ORDER BY unit_id ASC");
            $data['title'] = 'Youlanda | Auditor';
            // $data['income'] = $total;
            // $data['qty'] = $qty_all;
            $data['userinfo'] = $UserInfo;
            $data['sales'] = $Sales->getResultObject();
            return view('home/dashboard_audit', $data);

        } elseif ($UserInfo['level'] == "Admin Warehouse 2") {
            $data['title'] = 'Youlanda | Warehouse 2';
            $data['userinfo'] = $UserInfo;
            return view('home/dashboard_op_warehouse', $data);

        } elseif ($UserInfo['level'] == "SDM") {
            $builder = $db->table('sdm_master');
            $total_karyawan = $builder->countAll();
            $karyawan_masuk = $db->query("SELECT COUNT(*) as jumlah FROM sdm_master WHERE MONTH(tmk) = MONTH(CURRENT_DATE())")->getRowObject();
            $data['title'] = 'Youlanda | SDM';
            $data['total_karyawan'] = $total_karyawan;
            $data['total_masuk'] = $karyawan_masuk->jumlah;
            $data['userinfo'] = $UserInfo;
            return view('home/dashboard_sdm', $data);
        }
    }
}