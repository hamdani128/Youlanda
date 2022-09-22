<?=$this->extend('layout/template');?>

<?=$this->section('content')?>
<div class="page-header">
    <h3 class="page-title">
        Informasi Product
    </h3>
</div>

<!-- Alert Message -->
<div class="swal_pesan" id="swal_pesan" data-swal="<?=session()->get('message');?>"></div>

<div class="row">
    <div class="col-md-12 grid-margin">
        <button type="button" class="btn btn-inverse-primary btn-fw" data-toggle="modal" data-target="#op_tambah">
            <i class="far fa-plus-square"></i>
            Tambah Product
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
                                    <th>Nama Product</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>#Action</th>
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
                                    <td><?=$row->harga;?></td>
                                    <td><?=$row->qty;?></td>
                                    <td><?=$row->subtotal;?></td>
                                    <td>
                                        <a href="#" class="btn btn-warning" data-toggle="modal"
                                            data-target="#exampleModal-2"
                                            onclick="update_op_master_product('<?=$row->id;?>','<?=$row->kode;?>',
                                            '<?=$row->item;?>', '<?=$row->harga;?>', '<?=$row->qty;?>', '<?=$row->subtotal;?>')">
                                            <i class="fas fa-pencil-alt btn-icon-append"></i>
                                        </a>
                                        <a href="#" type="button" class="btn btn-danger"
                                            onclick="delete_update_op_master_product('<?=$row->id;?>')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach;?>

                                <?php } else {?>
                                <tr>
                                    <td colspan=" 17" class="text-center">Tidak Ada Data
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

<!-- Tmbah Data  -->
<div class="modal fade" id="op_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel-2">Tambah Data Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="forms-sample" action="/op/master_product/insert" method="POST"
                            id="insert_op_master_product">

                            <?=csrf_field()?>

                            <div class="form-group">
                                <label for="exampleInputUsername1">Kode Product</label>
                                <input type="text" class="form-control" name="kode" id="kode" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Nama Product</label>
                                <input type="text" class="form-control" name="item" id="item" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Harga</label>
                                <input type="number" class="form-control" name="harga" id="harga" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Qty</label>
                                <input type="text" class="form-control" name="qty" id="qty" placeholder=""
                                    onkeyup="ArithAuto()">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Subtotal</label>
                                <input type="text" class="form-control" name="subtotal" id="subtotal" placeholder="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success"
                    onclick="insert_update_op_master_product()">Submit</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Update Modal Data -->
<div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-white" id="exampleModalLabel-2">Update Data Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="forms-sample" action="/op/master_product/update" method="POST"
                            id="update_data_produk">

                            <?=csrf_field()?>

                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id_update" id="id_update"
                                    placeholder="kode_update">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Kode Product</label>
                                <input type="text" class="form-control" name="kode_update" id="kode_update"
                                    placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Nama Product</label>
                                <input type="text" class="form-control" name="nama_update" id="nama_update"
                                    placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Harga</label>
                                <input type="number" class="form-control" name="harga_update" id="harga_update"
                                    placeholder="" onkeyup="ArithAuto_Upade()">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Qty</label>
                                <input type="text" class="form-control" name="qty_update" id="qty_update" placeholder=""
                                    onkeyup="ArithAuto_Upade()">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Subtotal</label>
                                <input type="text" class="form-control" name="subtotal_update" id="subtotal_update"
                                    placeholder="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning btn_edit_product">Update</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<?=$this->endsection();?>