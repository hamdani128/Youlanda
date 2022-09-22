<?php

namespace App\Controllers\Audit;

use App\Controllers\BaseController;

class AuditController extends BaseController
{
    public function index()
    {
        //
    }

    public function filter_sales()
    {
        $mulai = $_GET['mulai'];
        $sampai = $_GET['sampai'];
        $db = \Config\Database::connect();
        $start = date('Y-m-d', strtotime($mulai));
        $end = date('Y-m-d', strtotime($sampai));
        $Sales = $db->query("SELECT b.nama_unit,SUM(a.subtotal) as Total_Belanja, SUM(a.potongan) as Total_Potongan FROM op_sales_income a LEFT JOIN au_unit b ON a.unit_id = b.kode_unit WHERE a.date BETWEEN '" . $start . "' AND '" . $end . "' GROUP BY a.unit_id ORDER BY unit_id ASC");
        $data['sales'] = $Sales->getResultObject();
        echo json_encode($data);
    }

    public function filter_audit_sales()
    {
        $mulai = $_GET['mulai'];
        $sampai = $_GET['sampai'];
        $db = \Config\Database::connect();
        $start = date('Y-m-d', strtotime($mulai));
        $end = date('Y-m-d', strtotime($sampai));
        $sql = "SELECT
                b.kode_unit as kode,
                b.nama_unit as unit_nama,
                SUM(a.subtotal) as subtotal
                FROM op_sales_income a
                LEFT JOIN au_unit b ON a.unit_id = b.kode_unit
                WHERE a.date BETWEEN '" . $start . "' AND '" . $end . "'
                GROUP BY 2
                ORDER BY 1 ASC";
        $query = $db->query($sql)->getResultObject();
        foreach ($query as $key => $value) {
            $data['unit'][] = $value->unit_nama;
            $data['subtotal'][] = "Rp." . number_format($value->subtotal, 0);
        }
        return json_encode($data);
    }

    public function list_retail()
    {
        $unit_id = $_GET['unit_id'];
        $mulai = $_GET['mulai'];
        $sampai = $_GET['sampai'];
        $db = \Config\Database::connect();
        $start = date('Y-m-d', strtotime($mulai));
        $end = date('Y-m-d', strtotime($sampai));

        $sql = "SELECT
        a.code_product,
        a.item,
        a.harga,
        SUM(a.qty) as jumlah,
        SUM(a.subtotal) as subs,
        SUM(a.potongan) as potongan
        FROM op_sales_income a
        WHERE a.unit_id='" . $unit_id . "' 
        AND a.date BETWEEN '" . $start . "' AND '" . $end . "'
        GROUP BY 1,2 ORDER BY 1 ASC";

        $query = $db->query($sql)->getResultObject();
        if (!empty($query)) {
            $no = 1;foreach ($query as $row): ?>
<tr>
    <td><?=$row->code_product;?></td>
    <td><?=$row->item;?></td>
    <td><?=$row->harga;?></td>
    <td><?=$row->jumlah;?></td>
    <td><?=$row->subs;?></td>
    <td><?=$row->potongan;?></td>
</tr>
<?php endforeach?> <?php
        } else {
            ?>
<tr>
    <td colspan="6" class="text-center">Tidak Ada Data</td>
</tr>
<?php
        }
    }

}