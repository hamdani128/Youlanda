<?=$this->Extend('layout/template');?>
<?=$this->Section('content')?>

<div class="page-header">
    <h3 class="page-title">
        Informasi Surat Jalan
    </h3>
</div>

<!-- Alert Message -->
<div class="swal_pesan" id="swal_pesan" data-swal="<?=session()->get('message');?>"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home-1" role="tab"
                            aria-controls="home-1" aria-selected="true"><i class="fa fa-calendar"></i> Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile-1" role="tab"
                            aria-controls="profile-1" aria-selected="false"><i
                                class="fas fa-pencil-alt btn-icon-append"></i> Inputan </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact-1" role="tab"
                            aria-controls="contact-1" aria-selected="false">Contact</a>
                    </li> -->
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <!-- <label for="">Mulai Dari</label> -->
                                    <div id="mulai" class="input-group date datepicker mulai">
                                        <input type="text" class="form-control" placeholder="Mulai Dari Tanggal"
                                            id="mulai_date_surat">
                                        <span class="input-group-addon input-group-append border-left">
                                            <span class="far fa-calendar input-group-text"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <!-- <label for="">Sampai Dengan</label> -->
                                    <div id="sampai" class="input-group date datepicker mulai">
                                        <input type="text" class="form-control" placeholder="Sampai Dengan Tanggal"
                                            id="sampai_date_surat">
                                        <span class="input-group-addon input-group-append border-right">
                                            <span class="far fa-calendar input-group-text"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group pt-1">
                                    <label for=""></label>
                                    <button type="button" class="btn btn-outline-primary btn-icon-text btn-md"
                                        onclick="suratjalanfilter()">
                                        <i class="fa fa-filter btn-icon-prepend"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-2">
                            <div class="col-12 col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered" id="table-list2">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Surat Jalan</th>
                                                <th>tanggal Surat Jalan</th>
                                                <th> Tujuan</th>
                                                <th>Driver</th>
                                                <th>No Kendaraan</th>
                                                <th>#Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-list3">
                                            <?php if (count($suratjalan) > 0) {
    $no = 1;
    foreach ($suratjalan as $row): ?>
                                            <tr>
                                                <td><?=$no++;?></td>
                                                <td><?=$row->code;?></td>
                                                <td><?=$row->date_deliver;?></td>
                                                <td><?=$row->delivery_to;?></td>
                                                <td><?=$row->driver;?></td>
                                                <td><?=$row->no_driver;?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-dark dropdown-toggle" type="button"
                                                            id="dropdownMenuIconButton1" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-list-alt"></i>
                                                        </button>
                                                        <div class="dropdown-menu"
                                                            aria-labelledby="dropdownMenuIconButton1">
                                                            <!-- <div class="dropdown-divider"></div> -->
                                                            <a class="dropdown-item" href="#"
                                                                onclick="cetak_surat_jalan('<?=$row->id;?>')"><i
                                                                    class="fa fa-print"></i> Cetak
                                                                Faktur</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#"
                                                                onclick="surat_jalan_delete('<?=$row->id;?>', '<?=$row->code;?>')"><i
                                                                    class="fa fa-trash"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach;?>
                                            <?php } else {?>
                                            <tr>
                                                <td colspan="7" class="text-center">Tidak Ada Data
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-md btn-dark" data-toggle="modal" data-target="#modelId"><i
                                        class="fa fa-list"></i> Pilih Product</button>
                            </div>
                            <div class="col-md-4">
                                <p>No.Surat Jalan. </p>
                                <h5 id="id_surat_jalan"><?=$id_suratjalan;?></h5>
                            </div>
                            <div class="col-md-4 text-right">
                                <p>Total Qty:</p>
                                <h4 id="qty_total">0</h4>
                            </div>
                        </div>
                        <div class="row pt-2">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Unit Tujuan</label>
                                    <select name="unit_tujuan" id="unit_tujuan" class="form-control">
                                        <option value="">Pilih Unit Tujuan</option>
                                        <?php foreach ($unit as $row): ?>
                                        <option value="<?=$row->kode_unit;?>"><?=$row->nama_unit;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Supir</label>
                                    <input type="text" class="form-control" name="supir" id="supir" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">No. Kendaraan</label>
                                    <input type="text" class="form-control" name="no_kendaraan" id="no_kendaraan"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row pt-1">
                            <div class="col-md-12">
                                <div class="form-group input-group">
                                    <input type="text" id="autocomplete_item" class="form-control"
                                        placeholder="Ketik Nama Produk" style="width: 55%;">
                                    <input type="number" id="request_qty" name="request_qty" class="form-control"
                                        value="1" style="width: 10%;">
                                    <button class="btn btn-md btn-info" onclick="EntryProduct()"><i
                                            class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead class="bg-dark text-white">
                                                    <tr>
                                                        <th>#Kode</th>
                                                        <th>Nama Product</th>
                                                        <th>Harga</th>
                                                        <th>Qty</th>
                                                        <th>Subtotal</th>
                                                        <th>#Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-suratjalan">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-12 text-right">
                                <strong>Catatan Tambahan</strong>
                                <hr>
                                <textarea class="form-control" name="" id="" cols="10" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-12">
                                <button class="btn btn-md btn-primary" onclick="simpan_surat_jalan()"><i
                                        class="fa fa-shopping-cart"></i>
                                    Simpan</button>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="contact-1" role="tabpanel" aria-labelledby="contact-tab">
                        <h4>Contact us </h4>
                        <p>
                            Feel free to contact us if you have any questions!
                        </p>
                        <p>
                            <i class="fa fa-phone text-info"></i>
                            +123456789
                        </p>
                        <p>
                            <i class="far fa-envelope-open text-success"></i>
                            contactus@example.com
                        </p>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white">Info Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="table-list1">
                                <thead>
                                    <tr>
                                        <th>#No</th>
                                        <th>Kode</th>
                                        <th>Produt</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="info_brg">
                                    <?php if (count($product) > 0) {
    $no = 1;
    foreach ($product as $row): ?>
                                    <tr>
                                        <td><?=$no++;?></td>
                                        <td><?=$row->kode;?></td>
                                        <td><?=$row->item;?></td>
                                        <td><?=$row->harga;?></td>
                                        <td><input type="Number" class="form-control qty_surat" name="qty_surat"
                                                id="qty_surat">
                                        </td>
                                        <td><button class="btn btn-md btn-success btn-pilih"> Pilih</button></td>
                                    </tr>
                                    <?php endforeach;?>
                                    <?php } else {?>
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak Ada Data
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection();?>