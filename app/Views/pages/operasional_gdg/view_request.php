<?=$this->extend('layout/template');?>

<?=$this->section('content')?>

<div class="page-header">
    <h3 class="page-title">
        Request Permintaan
    </h3>
</div>

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
                            aria-controls="profile-1" aria-selected="false"> <i
                                class="fas fa-pencil-alt btn-icon-append"></i> Inputan</a>
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
                                                <th>ID Request</th>
                                                <th>Tanggal Request</th>
                                                <th>Keterangan Status</th>
                                                <th>#Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-list-request">
                                            <?php if (count($request) > 0) {
    $no = 1;
    foreach ($request as $row): ?>
                                            <tr>
                                                <td><?=$no++;?></td>
                                                <td><?=$row->code;?></td>
                                                <td><?=$row->event_date;?></td>
                                                <td>
                                                    <?php if ($row->keterangan === 'Request'): ?>
                                                    <div class="badge badge-warning badge-pill"><?=$row->keterangan;?>
                                                    </div>
                                                    <?php elseif ($row->keterangan === 'Process'): ?>
                                                    <div class="badge badge-info badge-pill"><?=$row->keterangan;?>
                                                    </div>
                                                    <?php elseif ($row->keterangan === 'Success'): ?>
                                                    <div class="badge badge-success badge-pill"><?=$row->keterangan;?>
                                                    </div>
                                                    <?php endif;?>
                                                </td>
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
                            <div class="col-md-3">
                                <div class="input-group date datepicker mulai">
                                    <input type="text" class="form-control" id="date_request"
                                        onchange="id_change_request(event);" placeholder="Pilih Tanggal Request">
                                    <span class="input-group-addon input-group-append border-right">
                                        <span class="far fa-calendar input-group-text"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">No.ID Request.</label>
                                <h5 id="request_id"><?=$request_id;?></h5>
                            </div>
                            <div class="col-md-2">
                                <label for="">Qty All.</label>
                                <h4 id="qty_request">0</h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <button class="btn btn-md btn-primary" onclick="Eksekusi_Simpan_Request()"><i
                                        class="fa fa-plus"></i> Simpan</button>
                                <button class="btn btn-md btn-dark"><i class="fa fa-minus-circle"></i>
                                    Cancel</button>
                            </div>
                        </div>

                        <div class="row pt-5">
                            <div class="col-md-12">
                                <div class="form-group input-group">
                                    <input type="text" id="autocomplete_item" class="form-control"
                                        placeholder="Ketik Nama Item" style="width: 55%;">
                                    <input type="number" id="request_qty" name="request_qty" class="form-control"
                                        value="1" style="width: 10%;">
                                    <button class="btn btn-md btn-info" onclick="Requestcari()"><i
                                            class="fa fa-plus"></i></button>
                                    <button class="btn btn-md btn-warning" data-toggle="modal"
                                        data-target="#modalList"><i class="fa fa-th-list"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-1">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead class="bg-dark text-white">
                                                    <tr>
                                                        <th>#Code</th>
                                                        <th>Name Items</th>
                                                        <th>Satuan</th>
                                                        <th>Qty</th>
                                                        <th>Kategori</th>
                                                        <th>Keterangan</th>
                                                        <th>#Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-request">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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

<!-- Modal List Barang-->
<div class="modal fade" id="modalList" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Informasi Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="table-list1">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode</th>
                                        <th>Items</th>
                                        <th>Satuan</th>
                                        <th>Qty</th>
                                        <th>Kategori</th>
                                        <th>#Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="list-request">
                                    <?php if (count($product) > 0) {
    $no = 1;
    foreach ($product as $row): ?>
                                    <tr>
                                        <td><?=$no++;?></td>
                                        <td><?=$row->kode;?></td>
                                        <td><?=$row->item;?></td>
                                        <td><?=$row->satuan;?></td>
                                        <td><input type="text" class="form-control qty_request"></td>
                                        <td><?=$row->kategori;?></td>
                                        <td>
                                            <button class="btn btn-md btn-success btn-success btn-pilih-request">
                                                Pilih</button>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?=$this->endsection()?>