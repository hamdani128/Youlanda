<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratjalanModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'op_delivery';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [];

    // Dates
    protected $useTimestamps = true;
    // protected $dateFormat = 'datetime';
    // protected $createdField = 'created_at';
    // protected $updatedField = 'updated_at';
    // protected $deletedField = 'deleted_at';

    // // Validation
    // protected $validationRules = [];
    // protected $validationMessages = [];
    // protected $skipValidation = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert = [];
    // protected $afterInsert = [];
    // protected $beforeUpdate = [];
    // protected $afterUpdate = [];
    // protected $beforeFind = [];
    // protected $afterFind = [];
    // protected $beforeDelete = [];
    // protected $afterDelete = [];

    public function ID_SuratJalan($id_unit)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        $sql = "SELECT MAX(RIGHT(code,4)) as kd_max FROM op_delivery WHERE date_deliver ='" . $date . "' AND unit_id='" . $id_unit . "'";
        $query = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            $n = ((int) $row->kd_max) + 1;
            $no = sprintf("%04s", $n);
        } else {
            $no = "0001";
        }
        $kode = 'OPD' . date('ymd') . "-" . $id_unit . $no;
        return $kode;

    }

}
