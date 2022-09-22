<?=$this->extend('layout/template');?>

<?=$this->section('content')?>

<div class="page-header">
    <h3 class="page-title">
        Informasi Barang Items
    </h3>
</div>

<div class="row">
    <div class="col-md-12 grid-margin">
        <button type="button" class="btn btn-inverse-primary btn-fw" data-toggle="modal" data-target="#op_tambah">
            <i class="far fa-plus-square"></i>
            Tambah Product
        </button>

        <button type="button" class="btn btn-inverse-success btn-fw" data-toggle="modal" data-target="#op_tambah">
            <i class="far fa-plus-square"></i>
            Import Xlxs
        </button>
        <button type="button" class="btn btn-inverse-dark btn-fw" data-toggle="modal" data-target="#op_tambah">
            <i class="far fa-plus-square"></i>
            Opanme Data
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>#Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Qty</th>
                                    <th>Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($product) > 0) {
    $no = 1;
    foreach ($product as $row): ?>
                                <tr>
                                    <td><?=$no++;?></td>
                                    <td><?=$row->kode;?></td>
                                    <td><?=$row->item;?></td>
                                    <td><?=$row->satuan;?></td>
                                    <td><?=$row->qty;?></td>
                                    <td><?=$row->kategori;?></td>
                                </tr>
                                <?php endforeach;?>
                                <?php } else {?>
                                <tr>
                                    <td colspan="6" class="text-center">Tidak Ada Data
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->endsection();?>