<?=$this->extend('layout/template');?>

<?=$this->section('content')?>

<div class="page-header">
    <h3 class="page-title">
        Employe Information Resign
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Resign</a></li>
            <li class="breadcrumb-item active" aria-current="page">SDM Management</li>
        </ol>
    </nav>
</div>
<!-- <div class="row">
    <div class="col-md-12 grid-margin">
        <button type="button" class="btn btn-info btn-fw" data-toggle="modal" data-target="#exampleModal-2">
            <i class="far fa-plus-square"></i>
            Tambah
        </button>
        <button type="button" class="btn btn-success btn-fw" data-toggle="modal" data-target="#modelImport"><i
                class="far fa-file-excel"></i>
            Import</button>
    </div>
</div> -->

<!-- Alert Message -->
<div class="swal_pesan" id="swal_pesan" data-swal="<?=session()->get('message');?>"></div>


<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal Resign</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>TMK</th>
                                <th>Bagian</th>
                                <th>Jabatan</th>
                                <th>Departemen</th>
                                <th>Keterangan</th>
                                <th>#Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($sdm) > 0) {
    $no = 1;
    foreach ($sdm as $row): ?>
                            <tr>
                                <td><?=$no++;?></td>
                                <td><?=$row->date_resign;?></td>
                                <td><?=$row->nama;?></td>
                                <td><?=$row->jk;?></td>
                                <td><?=$row->tmk;?></td>
                                <td><?=$row->bagian;?></td>
                                <td><?=$row->jabatan;?></td>
                                <td><?=$row->departemen;?></td>
                                <td><?=$row->keterangan;?></td>
                                <td>
                                    <div class="dropdown bg-info">
                                        <button type="button" class="btn btn-info dropdown-toggle"
                                            id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fa fa-list"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7">
                                            <a class="dropdown-item" href="#"><i class="fa fa-plus-circle"></i>
                                                Restore</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-trash"></i> Print</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            <?php } else {?>
                            <tr>
                                <td colspan="10" class="text-center">Tidak Ada Data</td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->endsection();?>