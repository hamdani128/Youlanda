<?php

namespace App\Controllers\OP;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Config\Database;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Opersional2Controller extends BaseController
{
    public function index()
    {
        //
    }
    public function export_sales($mulai, $sampai)
    {
        $db = Database::connect();
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];
        $unit_name = $UserInfo['unit'];

        $start = date('Y-m-d', strtotime($mulai));
        $end = date('Y-m-d', strtotime($sampai));
        $filename = 'Sales_Report_' . $unit_name . '_' . $start . '_' . $end . ' .xlsx';

        $sql = "SELECT
        b.nama_unit as nama_unit,
        a.date as date,
        a.code_product as code_product,
        a.item  as product,
        a.harga as harga,
        SUM(a.qty) as qty,
        SUM(a.subtotal) as subtotal,
        SUM(a.potongan) as potongan
        FROM op_sales_income a
        LEFT JOIN au_unit b ON a.unit_id = b.kode_unit
        WHERE a.date BETWEEN '" . $start . "' AND '" . $end . "' AND unit_id='" . $unit_id . "'
        GROUP BY a.code_product ORDER BY a.code_product ASC";

        $query = $db->query($sql)->getResultArray();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Nama Unit');
        $sheet->setCellValue('B1', 'Tanggal');
        $sheet->setCellValue('C1', 'Kode Produk');
        $sheet->setCellValue('D1', 'Produk');
        $sheet->setCellValue('E1', 'Harga');
        $sheet->setCellValue('F1', 'Qty');
        $sheet->setCellValue('G1', 'Subtotal');
        $sheet->setCellValue('H1', 'Potongan');
        $row = 2;
        foreach ($query as $key => $value) {
            $sheet->setCellValue('A' . $row, $value['nama_unit']);
            $sheet->setCellValue('B' . $row, $value['date']);
            $sheet->setCellValue('C' . $row, $value['code_product']);
            $sheet->setCellValue('D' . $row, $value['product']);
            $sheet->setCellValue('E' . $row, $value['harga']);
            $sheet->setCellValue('F' . $row, $value['qty']);
            $sheet->setCellValue('G' . $row, $value['subtotal']);
            $sheet->setCellValue('H' . $row, $value['potongan']);
            $row++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length:' . filesize($filename));
        flush();
        readfile($filename);
        exit;

    }

    public function export_order_sales($mulai, $sampai)
    {
        $db = Database::connect();
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];
        $unit_name = $UserInfo['unit'];

        $start = date('Y-m-d', strtotime($mulai));
        $end = date('Y-m-d', strtotime($sampai));
        $filename = 'Order_Income_' . $unit_name . '_' . $start . '_' . $end . ' .xlsx';

        $sql = "SELECT
                b.nama_unit as nama_unit,
                a.unit_id as unit_id,
                a.date as date,
                a.code_transaction as no_transaksi,
                a.code_product as kode_produk,
                a.item as item,
                a.harga as harga,
                a.qty as qty,
                a.subtotal as subtotal,
                a.potongan as potongan,
                a.konsumen as konsumen,
                a.hp as hp,
                a.created_at_sales as time_sales
                FROM op_order_income a
                LEFT JOIN au_unit b ON a.unit_id = b.kode_unit
                WHERE
                a.unit_id='" . $unit_id . "'
                AND
                a.date BETWEEN '" . $start . "' AND '" . $end . "'";

        $query = $db->query($sql)->getResultArray();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Nama Unit');
        $sheet->setCellValue('B1', 'Unit ID');
        $sheet->setCellValue('C1', 'Tanggal');
        $sheet->setCellValue('D1', 'No Transaksi');
        $sheet->setCellValue('E1', 'Kode Produk');
        $sheet->setCellValue('F1', 'Item');
        $sheet->setCellValue('G1', 'Harga');
        $sheet->setCellValue('H1', 'Qty');
        $sheet->setCellValue('I1', 'Subtotal');
        $sheet->setCellValue('J1', 'Potongan');
        $sheet->setCellValue('K1', 'Konsumen');
        $sheet->setCellValue('L1', 'HP');
        $sheet->setCellValue('M1', 'Time Sales');
        $row = 2;
        foreach ($query as $key => $value) {
            $sheet->setCellValue('A' . $row, $value['nama_unit']);
            $sheet->setCellValue('B' . $row, $value['unit_id']);
            $sheet->setCellValue('C' . $row, $value['date']);
            $sheet->setCellValue('D' . $row, $value['no_transaksi']);
            $sheet->setCellValue('E' . $row, $value['kode_produk']);
            $sheet->setCellValue('F' . $row, $value['item']);
            $sheet->setCellValue('G' . $row, $value['harga']);
            $sheet->setCellValue('H' . $row, $value['qty']);
            $sheet->setCellValue('I' . $row, $value['subtotal']);
            $sheet->setCellValue('J' . $row, $value['potongan']);
            $sheet->setCellValue('K' . $row, $value['konsumen']);
            $sheet->setCellValue('L' . $row, $value['hp']);
            $sheet->setCellValue('M' . $row, $value['time_sales']);
            $row++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length:' . filesize($filename));
        flush();
        readfile($filename);
        exit;
    }

    public function export_cashbon($mulai, $sampai)
    {
        $db = Database::connect();
        $userModel = new UserModel();
        $loggedUserID = session()->get('loggedUser');
        $UserInfo = $userModel->find($loggedUserID);
        $unit_id = $UserInfo['unit_id'];
        $unit_name = $UserInfo['unit'];

        $start = date('Y-m-d', strtotime($mulai));
        $end = date('Y-m-d', strtotime($sampai));
        $filename = 'Cashbon_Unit_' . $unit_name . '_' . $start . '_' . $end . ' .xlsx';

        $sql = "SELECT
                b.nama_unit as nama_unit,
                a.unit_id as unit_id,
                a.employe as karyawan,
                a.employe_id as id_karyawan,
                a.date as date,
                a.code_transaction as no_transaksi,
                a.code_product as kode_produk,
                a.item as item,
                a.price as harga,
                a.qty as qty,
                a.subtotal as subtotal,
                a.potongan as potongan,
                a.created_sales as time_sales
                FROM op_cashbon_income a
                LEFT JOIN au_unit b ON a.unit_id = b.kode_unit
                WHERE
                a.unit_id='" . $unit_id . "'
                AND
                a.date BETWEEN '" . $start . "' AND '" . $end . "'";

        $query = $db->query($sql)->getResultArray();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Nama Unit');
        $sheet->setCellValue('B1', 'Unit ID');
        $sheet->setCellValue('C1', 'Karyawan');
        $sheet->setCellValue('D1', 'ID Karyawan');
        $sheet->setCellValue('E1', 'Date');
        $sheet->setCellValue('F1', 'No Transaksi');
        $sheet->setCellValue('G1', 'Kode Produk');
        $sheet->setCellValue('H1', 'Item');
        $sheet->setCellValue('I1', 'Harga');
        $sheet->setCellValue('J1', 'Qty');
        $sheet->setCellValue('K1', 'Subtotal');
        $sheet->setCellValue('L1', 'Potongan');
        $sheet->setCellValue('M1', 'Time Sales');
        $row = 2;
        foreach ($query as $key => $value) {
            $sheet->setCellValue('A' . $row, $value['nama_unit']);
            $sheet->setCellValue('B' . $row, $value['unit_id']);
            $sheet->setCellValue('C' . $row, $value['karyawan']);
            $sheet->setCellValue('D' . $row, $value['id_karyawan']);
            $sheet->setCellValue('E' . $row, $value['date']);
            $sheet->setCellValue('F' . $row, $value['no_transaksi']);
            $sheet->setCellValue('G' . $row, $value['kode_produk']);
            $sheet->setCellValue('H' . $row, $value['item']);
            $sheet->setCellValue('I' . $row, $value['harga']);
            $sheet->setCellValue('J' . $row, $value['qty']);
            $sheet->setCellValue('K' . $row, $value['subtotal']);
            $sheet->setCellValue('L' . $row, $value['potongan']);
            $sheet->setCellValue('M' . $row, $value['time_sales']);
            $row++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length:' . filesize($filename));
        flush();
        readfile($filename);
        exit;
    }

}