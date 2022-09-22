<?php

namespace App\Controllers\OP;

use App\Controllers\BaseController;
use App\Models\SuratjalanModel;
use App\Models\UserModel;
use Config\Database;
use Mpdf\Mpdf;
use Picqer\Barcode\BarcodeGeneratorPNG;

class OpersionalController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit = $UserInfo['unit'];
        $unit_id = $UserInfo['unit_id'];
        $db = \Config\Database::connect();
        $product = $db->table('op_master_product')->where('id_unit', $unit_id)->orderBy('kode', 'ASC');
        // $data['sdm'] = $db->table('sdm_master')->get()->getResultObject();
        $data = [
            // 'sdm' => $db->table('sdm_master')->get()->getResultObject(),
            'title' => 'Youlanda | ' . $unit . ' | Master Product',
            'userinfo' => $UserInfo,
            'product' => $product->get()->getResultObject(),
        ];
        return view('pages/operasional/view_op_master_product', $data);
    }

    public function update_master_product()
    {
        $db = \Config\Database::connect();
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $user_id = $UserInfo['id'];
        $id = $this->request->getPost('id_update');
        $data = [
            'kode' => $this->request->getPost('kode_update'),
            'item' => $this->request->getPost('nama_update'),
            'harga' => $this->request->getPost('harga_update'),
            'qty' => $this->request->getPost('qty_update'),
            'subtotal' => $this->request->getPost('subtotal_update'),
            'id_user' => $user_id,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        $query = $db->table('op_master_product')->update($data, ['id' => $id]);
        if ($query) {
            session()->setFlashData('message', 'Data Berhasil Dirubah !');
            return redirect()->to('/op/master_product');
        }
    }

    public function insert_master_product()
    {
        $db = \Config\Database::connect();
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $user_id = $UserInfo['id'];
        $unit_id = $UserInfo['unit_id'];
        $data = [
            'kode' => $this->request->getPost('kode'),
            'item' => $this->request->getPost('item'),
            'harga' => $this->request->getPost('harga'),
            'qty' => $this->request->getPost('qty'),
            'subtotal' => $this->request->getPost('subtotal'),
            'id_user' => $user_id,
            'id_unit' => $unit_id,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        $query = $db->table('op_master_product')->insert($data);
        if ($query) {
            session()->setFlashData('message', 'Data Berhasil Dirubah !');
            return redirect()->to('/op/master_product');
        }
    }

    public function delete_master_product($id)
    {
        $db = \Config\Database::connect();
        $query = $db->table('op_master_product')->delete(['id' => $id]);
        if ($query) {
            session()->setFlashData('message', 'Data Berhasil Dihapus !');
            return redirect()->to('/op/master_product');
        }
    }

    public function filter_income()
    {
        $mulai = $_GET['mulai'];
        $sampai = $_GET['sampai'];
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];
        $db = \Config\Database::connect();

        if (!empty($mulai && $sampai)) {
            // $income_sales = $db->query('SELECT SUM(subtotal) as SUBS FROM op_sales_income WHERE unit_id="' . $unit_id . '" AND date BETWEEN "' . date('Y-m-d', strtotime($mulai)) . '" AND "' . date('Y-m-d', strtotime($sampai)) . '"');
            $where = "date BETWEEN '" . date('Y-m-d', strtotime($mulai)) . "' AND '" . date('Y-m-d', strtotime($sampai)) . "' AND unit_id ='" . $unit_id . "'";
            $income_sales = $db->table('op_sales_income')->selectSum('subtotal', 'SUBS')->where($where);
        }
        $nominal = $income_sales->get()->getRow()->SUBS;
        $data = "Rp " . number_format($nominal, 0, ',', '.');
        return $data;
    }

    public function filter_qty()
    {
        $mulai = $_GET['mulai'];
        $sampai = $_GET['sampai'];
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];
        $db = \Config\Database::connect();

        if (!empty($mulai && $sampai)) {
            // $income_sales = $db->query('SELECT SUM(subtotal) as SUBS FROM op_sales_income WHERE unit_id="' . $unit_id . '" AND date BETWEEN "' . date('Y-m-d', strtotime($mulai)) . '" AND "' . date('Y-m-d', strtotime($sampai)) . '"');
            $where = "date BETWEEN '" . date('Y-m-d', strtotime($mulai)) . "' AND '" . date('Y-m-d', strtotime($sampai)) . "' AND unit_id ='" . $unit_id . "'";
            $qty_all = $db->table('op_sales_income')->selectSum('qty', 'qty_all')->where($where);
        }
        $nominal = $qty_all->get()->getRow()->qty_all;
        $data = number_format($nominal, 0, ',', '.');
        return $data;
    }

    public function filter_pesanan()
    {
        $mulai = $_GET['mulai'];
        $sampai = $_GET['sampai'];
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];
        $db = \Config\Database::connect();

        if (!empty($mulai && $sampai)) {
            // $income_sales = $db->query('SELECT SUM(subtotal) as SUBS FROM op_sales_income WHERE unit_id="' . $unit_id . '" AND date BETWEEN "' . date('Y-m-d', strtotime($mulai)) . '" AND "' . date('Y-m-d', strtotime($sampai)) . '"');
            $where = "date BETWEEN '" . date('Y-m-d', strtotime($mulai)) . "' AND '" . date('Y-m-d', strtotime($sampai)) . "' AND unit_id ='" . $unit_id . "'";
            $order = $db->table('op_order_income')->selectSum('subtotal', 'order')->where($where);
        }
        $nominal = $order->get()->getRow()->order;
        $data = "Rp " . number_format($nominal, 0, ',', '.');
        return $data;
    }

    public function filter_kasbon()
    {
        $mulai = $_GET['mulai'];
        $sampai = $_GET['sampai'];
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];
        $db = \Config\Database::connect();

        if (!empty($mulai && $sampai)) {
            $where = "date BETWEEN '" . date('Y-m-d', strtotime($mulai)) . "' AND '" . date('Y-m-d', strtotime($sampai)) . "' AND unit_id ='" . $unit_id . "'";
            $kasbon = $db->table('op_cashbon_income')->selectSum('subtotal', 'kasbon')->where($where);
        }
        $nominal = $kasbon->get()->getRow()->kasbon;
        $data = "Rp " . number_format($nominal, 0, ',', '.');
        return $data;
    }

    public function filter_barang()
    {
        $mulai = $_GET['mulai'];
        $sampai = $_GET['sampai'];
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];
        $db = \Config\Database::connect();

        if (!empty($mulai && $sampai)) {
            $data = $db->query('SELECT code_product,item,sum(qty) as qty_all FROM op_sales_income WHERE unit_id="' . $unit_id . '" AND date BETWEEN "' . date('Y-m-d', strtotime($mulai)) . '" AND "' . date('Y-m-d', strtotime($sampai)) . '" GROUP BY 1 ');
        }

        if (!empty($data)) {
            $no = 1;foreach ($data->getResultArray() as $row): ?>

<tr>
    <td><?=$no++;?></td>
    <td><?=$row['code_product'];?></td>
    <td><?=$row['item'];?></td>
    <td><?=$row['qty_all'];?></td>
</tr>
<?php endforeach?> <?php
} else {
            ?>
<tr>
    <td colspan="3" class="text-center">Tidak Ada Data</td>
</tr>
<?php
}
    }

    public function filter_order()
    {
        $mulai = $_GET['mulai'];
        $sampai = $_GET['sampai'];
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];
        $db = \Config\Database::connect();

        if (!empty($mulai && $sampai)) {
            $data = $db->query('SELECT code_product,item,sum(qty) as qty_all,sum(subtotal) as subtotal FROM op_order_income WHERE unit_id="' . $unit_id . '" AND date BETWEEN "' . date('Y-m-d', strtotime($mulai)) . '" AND "' . date('Y-m-d', strtotime($sampai)) . '" GROUP BY 1 ');
            // $where = "date BETWEEN '" . date('Y-m-d', strtotime($mulai)) . "' AND '" . date('Y-m-d', strtotime($sampai)) . "' AND unit_id ='" . $unit_id . "'";
            // $kasbon = $db->table('op_cashbon_income')->select('code_product', 'item', 'qty')->where($where);
        }

        if (!empty($data)) {
            $no = 1;foreach ($data->getResultArray() as $row): ?>

<tr>
    <td><?=$no++;?></td>
    <td><?=$row['code_product'];?></td>
    <td><?=$row['item'];?></td>
    <td><?=$row['qty_all'];?></td>
    <td><?=$row['subtotal'];?></td>
</tr>
<?php endforeach?> <?php
} else {
            ?>
<tr>
    <td colspan="3" class="text-center">Tidak Ada Data</td>
</tr>
<?php
}
    }

    public function filter_income_cashbon()
    {
        $mulai = $_GET['mulai'];
        $sampai = $_GET['sampai'];
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];
        $db = \Config\Database::connect();

        if (!empty($mulai && $sampai)) {
            $data = $db->query('SELECT code_transaction,employe,code_product,item,price,qty,subtotal,potongan,created_at FROM op_cashbon_income WHERE unit_id="' . $unit_id . '" AND date BETWEEN "' . date('Y-m-d', strtotime($mulai)) . '" AND "' . date('Y-m-d', strtotime($sampai)) . '" GROUP BY 1 ');
            // $where = "date BETWEEN '" . date('Y-m-d', strtotime($mulai)) . "' AND '" . date('Y-m-d', strtotime($sampai)) . "' AND unit_id ='" . $unit_id . "'";
            // $kasbon = $db->table('op_cashbon_income')->select('code_product', 'item', 'qty')->where($where);
        }

        if (!empty($data)) {
            $no = 1;foreach ($data->getResultArray() as $row): ?>

<tr>
    <td><?=$no++;?></td>
    <td><?=$row['code_transaction'];?></td>
    <td><?=$row['employe'];?></td>
    <td><?=$row['code_product'];?></td>
    <td><?=$row['item'];?></td>
    <td><?=$row['price'];?></td>
    <td><?=$row['qty'];?></td>
    <td><?=$row['subtotal'];?></td>
    <td><?=$row['potongan'];?></td>
    <td><?=$row['created_at'];?></td>
</tr>
<?php endforeach?> <?php
} else {
            ?>
<tr>
    <td colspan="10" class="text-center">Tidak Ada Data</td>
</tr>
<?php
}
    }

    public function filter_list_free()
    {
        $mulai = $_GET['mulai'];
        $sampai = $_GET['sampai'];
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];
        $db = \Config\Database::connect();

        if (!empty($mulai && $sampai)) {
            $data = $db->query('SELECT code_product,item,sum(qty) as qty_all FROM op_sales_free_income WHERE unit_id="' . $unit_id . '" AND date BETWEEN "' . date('Y-m-d', strtotime($mulai)) . '" AND "' . date('Y-m-d', strtotime($sampai)) . '" GROUP BY 1 ');
        }

        if (!empty($data)) {
            $no = 1;foreach ($data->getResultArray() as $row): ?>

<tr>
    <td><?=$no++;?></td>
    <td><?=$row['code_product'];?></td>
    <td><?=$row['item'];?></td>
    <td><?=$row['qty_all'];?></td>
</tr>
<?php endforeach?> <?php
} else {
            ?>
<tr>
    <td colspan="3" class="text-center">Tidak Ada Data</td>
</tr>
<?php
}
    }

    public function surat_jalan()
    {
        date_default_timezone_set('Asia/jakarta');

        $userModel = new UserModel();
        $ModelSuratJalan = new SuratjalanModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit = $UserInfo['unit'];

        $unit_id = $UserInfo['unit_id'];
        $db = \Config\Database::connect();
        $date = date('Y-m-d');
        $product = $db->table('op_master_product')->where('id_unit', $unit_id)->orderBy('kode', 'ASC');
        $listunit = $db->table('au_unit')->get()->getResultObject();
        $suratjalan = $db->table('op_delivery')->where('unit_id', $unit_id)->where('date_deliver', $date)->get()->getResultObject();
        $data = [
            'title' => 'Youlanda | ' . $unit . ' | Surat Jalan',
            'userinfo' => $UserInfo,
            'product' => $product->get()->getResultObject(),
            'unit' => $listunit,
            'id_suratjalan' => $ModelSuratJalan->ID_SuratJalan($unit_id),
            'suratjalan' => $suratjalan,
        ];
        return view('pages/operasional/view_surat_jalan', $data);
    }

    public function surat_jalan_add()
    {
        date_default_timezone_set('Asia/jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');
        $date = date('Y-m-d');
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];

        $db = Database::connect();

        $id_transaksi = $_GET['id_transaksi'];
        $delivery_to = $_GET['delivery_to'];
        $delivery_id = $_GET['delivery_id'];
        $driver = $_GET['driver'];
        $no_dirver = $_GET['no_driver'];

        $data = [
            'code' => $id_transaksi,
            'date_deliver' => $date,
            'delivery_to' => $delivery_to,
            'delivery_id' => $delivery_id,
            'driver' => $driver,
            'no_driver' => $no_dirver,
            'user_id' => $loggedUserID,
            'unit_id' => $unit_id,
            'created_at' => $now,
            'updated_at' => $now,
        ];
        $query = $db->table('op_delivery')->insert($data);
    }

    public function surat_jalan_add_detail()
    {
        date_default_timezone_set('Asia/jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');
        $date = date('Y-m-d');
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $db = Database::connect();

        $id_transaksi = $_GET['id_transaksi'];
        $kode = $_GET['kode'];
        $item = $_GET['item'];
        $harga = $_GET['harga'];
        $qty = $_GET['qty'];
        $subtotal_item = $_GET['subtotal_item'];

        $data = [
            'code' => $id_transaksi,
            'date_deliver' => $date,
            'code_product' => $kode,
            'item' => $item,
            'price' => $harga,
            'qty' => $qty,
            'subtotal' => $subtotal_item,
            'user_id' => $loggedUserID,
            'created_at' => $now,
            'updated_at' => $now,
        ];
        $query = $db->table('op_delivery_detail')->insert($data);
    }

    public function surat_jalan_delete($id)
    {
        $db = Database::connect();
        $query1 = $db->table('op_delivery')->where('id', $id)->get()->getRowObject()->code;
        $query2 = $db->table('op_delivery_detail')->where('code', $query1)->delete();
        $query3 = $db->table('op_delivery')->where('code', $query1)->delete();
        if ($query3) {
            session()->setFlashData('message', 'Data Berhasil Dihapus !');
            return redirect()->to('/op/delivery_order');
        }

    }

    public function surat_jalan_faktur($id)
    {
        $db = Database::connect();
        $suratjalan = $db->table('op_delivery')->where('id', $id)->get()->getRowObject();
        $logo = ROOTPATH . 'uploads/img/youlanda.png';
        $generator = new BarcodeGeneratorPNG();
        $barcode = '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($suratjalan->code, $generator::TYPE_CODE_128)) . '">';
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $from = $UserInfo['unit'];
        $suratjalandetail = $db->table('op_delivery_detail')->where('code', $suratjalan->code)->get()->getResultObject();
        $total = $db->table('op_delivery_detail')->selectSum('qty')->where('code', $suratjalan->code)->get()->getRowObject();
        $data = [
            'title' => 'Faktur Invoice : ' . $suratjalan->code,
            'logo' => $logo,
            'invoice' => $suratjalan->code,
            'tujuan' => $suratjalan->delivery_to,
            'supir' => $suratjalan->driver,
            'no_driver' => $suratjalan->no_driver,
            'created_at' => $suratjalan->created_at,
            'barcodebatang' => $barcode,
            'from' => $from,
            'suratjalandetail' => $suratjalandetail,
            'total' => $total->qty,
            // 'report' => $report,
        ];
        $mpdf = new Mpdf(['mode' => 'utf8']);
        $mpdf->WriteHTML(view('pages/operasional/invoice_surat_jalan', $data));
        return redirect()->to($mpdf->Output('Report_SPK_Waspas', 'I'));
    }

    public function surat_jalan_filter()
    {
        $db = Database::connect();
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];

        $mulai = $_GET['mulai'];
        $sampai = $_GET['sampai'];
        // $where = "date BETWEEN '" . date('Y-m-d', strtotime($mulai)) . "' AND '" . date('Y-m-d', strtotime($sampai)) . "' AND unit_id ='" . $unit_id . "'";
        $data = $db->query('SELECT * FROM op_delivery WHERE unit_id="' . $unit_id . '" AND date_deliver BETWEEN "' . date('Y-m-d', strtotime($mulai)) . '" AND "' . date('Y-m-d', strtotime($sampai)) . '"');

        //
        if (!empty($data)) {
            $no = 1;foreach ($data->getResultArray() as $row): ?>
<tr>
    <td><?=$no++;?></td>
    <td><?=$row['code'];?></td>
    <td><?=$row['date_deliver'];?></td>
    <td><?=$row['delivery_to'];?></td>
    <td><?=$row['driver'];?></td>
    <td><?=$row['no_driver'];?></td>
    <td>
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuIconButton1"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-list-alt"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                <!-- <div class="dropdown-divider"></div> -->
                <a class="dropdown-item" href="#" onclick="cetak_surat_jalan('<?=$row['id'];?>')"><i
                        class="fa fa-print"></i> Cetak
                    Faktur</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"
                    onclick="surat_jalan_delete('<?=$row['id'];?>', '<?=$row['code'];?>')"><i class="fa fa-trash"></i>
                    Delete</a>
            </div>
        </div>
    </td>
</tr>
<?php endforeach?> <?php
        } else {
            ?>
<tr>
    <td colspan="7" class="text-center">Tidak Ada Data</td>
</tr>
<?php
        }

    }

}