<?=$this->extend('layout/template');?>

<?=$this->section('content')?>

<div class="page-header">
    <h3 class="page-title">
        Employe Information
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Employe</a></li>
            <li class="breadcrumb-item active" aria-current="page">SDM Management</li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-md-12 grid-margin">
        <button type="button" class="btn btn-info btn-fw" data-toggle="modal" data-target="#exampleModal-2">
            <i class="far fa-plus-square"></i>
            Tambah
        </button>
        <button type="button" class="btn btn-success btn-fw" data-toggle="modal" data-target="#modelImport"><i
                class="far fa-file-excel"></i>
            Import</button>
    </div>
</div>

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
                                <th>#Action</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>JK</th>
                                <th>Pendidikan</th>
                                <th>TMK</th>
                                <th>Bagian</th>
                                <th>Jabatan</th>
                                <th>Departemen</th>
                                <th>Unit Teknis</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Telepon</th>
                                <th>Ibu Kandung</th>
                                <th>Status Karyawan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($sdm) > 0) {
    $no = 1;
    foreach ($sdm as $row): ?>
                            <tr>
                                <td><?=$no++;?></td>
                                <td>
                                    <div class="dropdown bg-info">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fa fa-user"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#modelTambahResign"
                                                onclick="sdm_show_tambah_resign('<?=$row->id;?>')"><i
                                                    class="fa fa-plus-circle"></i>
                                                Tambah Data Resign</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-plus-circle"></i> Tambah
                                                Data PHK</a>
                                            <a class="dropdown-item"
                                                onclick="sdm_delete('<?=$row->id;?>','<?=$row->nama;?>')" href="#"><i
                                                    class="fa fa-trash"></i> Delete</a>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#modelUpdate"
                                                onclick="sdm_show_update('<?=$row->id;?>')" href="#"><i
                                                    class="fa fa-edit"></i> Update</a>
                                        </div>
                                    </div>
                                </td>
                                <td><?=$row->nama;?></td>
                                <td><?=$row->tempat_lahir;?></td>
                                <td><?=$row->tgl_lahir;?></td>
                                <td><?=$row->jk;?></td>
                                <td><?=$row->pendidikan;?></td>
                                <td><?=$row->tmk;?></td>
                                <td><?=$row->bagian;?></td>
                                <td><?=$row->jabatan;?></td>
                                <td><?=$row->departemen;?></td>
                                <td><?=$row->unit;?></td>
                                <td><?=$row->alamat;?></td>
                                <td><?=$row->status;?></td>
                                <td><?=$row->telepon;?></td>
                                <td><?=$row->ibu_kandung;?></td>
                                <td><?=$row->status_karyawan;?></td>
                            </tr>
                            <?php endforeach;?>
                            <?php } else {?>
                            <tr>
                                <td colspan="17" class="text-center">Tidak Ada Data</td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Tambah Karyawan -->
<div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel-2">Tambah Data Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="cmxform" id="sdm-add" method="POST" action="/sdm/add">
                    <?=csrf_field()?>
                    <fieldset>
                        <div class="form-group">
                            <label for="cname">Name Karyawan</label>
                            <input class="form-control" name="name" type="text" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="cemail">Tempat Lahir</label>
                            <input class="form-control" type="text" name="tempat" id="tempat" required>
                        </div>
                        <div class="form-group">
                            <label for="curl">Tanggal Lahir</label>
                            <div id="datepicker-popup" class="input-group date datepicker">
                                <input type="text" class="form-control" name="tgl_lahir" id="tgl_lahir">
                                <span class="input-group-addon input-group-append border-left">
                                    <span class="far fa-calendar input-group-text"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="curl">Jenis Kelamin</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jk" id="jk" value="L">
                                    Laki - Laki
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jk" id="jk" value="L">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ctext">Pendidikan</label>
                            <input class="form-control" type="text" name="pendidikan" id="pendidikan" required>
                        </div>

                        <div class="form-group">
                            <label for="curl">TMK</label>
                            <div id="tmk-add" class="input-group date datepicker">
                                <input type="text" class="form-control" name="tmk" id="tmk">
                                <span class="input-group-addon input-group-append border-left">
                                    <span class="far fa-calendar input-group-text"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ctext">Bagian</label>
                            <input class="form-control" type="text" name="bagian" id="bagian" required>
                        </div>
                        <div class="form-group">
                            <label for="ctext">Jabatan</label>
                            <input class="form-control" type="text" name="jabatan" id="jabatan" required>
                        </div>
                        <div class="form-group">
                            <label for="ctext">Departemen</label>
                            <input class="form-control" type="text" name="departemen" id="departemen" required>
                        </div>
                        <div class="form-group">
                            <label for="ctext">Unit</label>
                            <input class="form-control" type="text" name="unit_teknis" id="unit_teknis" required>
                        </div>
                        <div class="form-group">
                            <label for="">alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" cols="10" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="ctext">Status Kawin</label>
                            <input class="form-control" type="text" name="status_kawin" id="status_kawin" required>
                        </div>
                        <div class="form-group">
                            <label for="ctext">telepon</label>
                            <input class="form-control" type="text" name="telepon" id="telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="ctext">Ibu Kandung</label>
                            <input class="form-control" type="text" name="ibu_kandung" id="ibu_kandung" required>
                        </div>
                        <div class="form-group">
                            <label for="ctext">Status Karyawan</label>
                            <input class="form-control" type="text" name="status_karyawan" id="status_karyawan"
                                required>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" onclick="sdm_simpan()"><i class="fa fa-save"></i>
                    Simpan</button>
                <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fa fa-minus-circle"></i>
                    Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Data Karyawan -->

<!-- Add Import Data -->
<div class="modal fade" id="modelImport" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Import Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/sdm/master/import" method="POST" enctype="multipart/form-data" id="sdm-import">
                    <?=csrf_field()?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>File upload</label>
                                <input type="file" name="file" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled
                                        placeholder="Upload Image"
                                        accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-info" type="button"><i
                                                class="fa fa-folder"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" id="process" style="display:none;">
                            <img src="<?=base_url()?>/assets/images/Loading_spinner.gif" alt=""
                                style="height: 50px;width: 50px;">
                            Harap Tungguu ...
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-minus-circle"></i>
                    Close</button>
                <button type="button" class="btn btn-success" onclick="sdm_import()"><i class="fa fa-download"></i>
                    Save</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Update -->
<div class="modal fade" id="modelUpdate" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-white">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="sdm-update" method="POST" action="/sdm/update" enctype="multipart/form-data">
                    <?=csrf_field()?>
                    <fieldset>
                        <input class="form-control" name="id_update" type="hidden" id="id_update" required>
                        <div class="form-group">
                            <label for="cname">Name Karyawan</label>
                            <input class="form-control" name="name_update" type="text" id="name_update" required>
                        </div>
                        <div class="form-group">
                            <label for="cemail">Tempat Lahir</label>
                            <input class="form-control" type="text" name="tempat_update" id="tempat_update" required>
                        </div>
                        <div class="form-group">
                            <label for="curl">tanggal Lahir</label>
                            <div id="tgl_lahir_update" class="input-group date datepicker">
                                <input type="text" class="form-control" name="tgl_lahir_update" id="tgl_lahir_update">
                                <span class="input-group-addon input-group-append border-left">
                                    <span class="far fa-calendar input-group-text"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="curl">Jenis Kelamin</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jk_update" id="jk_update_laki"
                                        value="L">
                                    Laki - Laki
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="jk_update"
                                        id="jk_update_perempuan" value="P">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ctext">Pendidikan</label>
                            <input class="form-control" type="text" name="pendidikan_update" id="pendidikan_update"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="curl">TMK</label>
                            <div id="tgl_tmk" class="input-group date datepicker">
                                <input type="text" class="form-control" name="tmk_update" id="tmk_update">
                                <span class="input-group-addon input-group-append border-left">
                                    <span class="far fa-calendar input-group-text"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ctext">Bagian</label>
                            <input class="form-control" type="text" name="bagian_update" id="bagian_update" required>
                        </div>
                        <div class="form-group">
                            <label for="ctext">Jabatan</label>
                            <input class="form-control" type="text" name="jabatan_update" id="jabatan_update" required>
                        </div>
                        <div class="form-group">
                            <label for="ctext">Departemen</label>
                            <input class="form-control" type="text" name="departemen_update" id="departemen_update"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="ctext">Unit</label>
                            <input class="form-control" type="text" name="unit_teknis_update" id="unit_teknis_update"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="">alamat</label>
                            <textarea class="form-control" name="alamat_update" id="alamat_update" cols="10"
                                rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="ctext">Status Kawin</label>
                            <input class="form-control" type="text" name="status_kawin_update" id="status_kawin_update"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="ctext">telepon</label>
                            <input class="form-control" type="text" name="telepon_update" id="telepon_update" required>
                        </div>
                        <div class="form-group">
                            <label for="ctext">Ibu Kandung</label>
                            <input class="form-control" type="text" name="ibu_kandung_update" id="ibu_kandung_update"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="ctext">Status Karyawan</label>
                            <input class="form-control" type="text" name="status_karyawan_update"
                                id="status_karyawan_update" required>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" onclick="sdm_update()">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data Resign -->
<div class="modal fade" id="modelTambahResign" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white">Tambah Data Resign</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/sdm/add_resign" method="POST" enctype="multipart/form-data" id="sdm-add_resign">
                    <?=csrf_field()?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Tanggal Resign</label>
                                <input type="date" class="form-control" name="tgl_resign" id="tgl_resign">
                                <input type="hidden" class="form-control" name="id_karyawan" id="id_karyawan">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Karyawan</label>
                                <input type="text" class="form-control" name="nama" id="nama">
                            </div>
                            <div class="form-group">
                                <label for="">Bagian</label>
                                <input type="text" class="form-control" name="bagian" id="bagian">
                            </div>
                            <div class="form-group">
                                <label for="">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" id="jabatan">
                            </div>
                            <div class="form-group">
                                <label for="">Departemen</label>
                                <input type="text" class="form-control" name="departemen" id="departemen">
                            </div>
                            <div class="form-group">
                                <label for="">Unit Teknis</label>
                                <input type="text" class="form-control" name="unit_teknis" id="unit_teknis">
                            </div>
                            <div class="form-group">
                                <label for="">TMK</label>
                                <input type="date" class="form-control" name="tmk" id="tmk">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <input type="text" class="form-control" name="jk" id="jk">
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan Resign</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" cols="30"
                                    rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-minus-square"></i>
                    kembali </button>
                <button type="button" class="btn btn-info" onclick="sdm_add_resgin()"><i class="fa fa-save"></i>
                    Simpan</button>
            </div>
        </div>
    </div>
</div>
<?=$this->endsection();?>