<?=$this->extend('layout/template')?>
<?=$this->section('content')?>

<div class="page-header">
    <h3 class="page-title">
        Dashboard
    </h3>
</div>
<div class="row">
    <div class="col-12 col-md-3">
        <div class="form-group">
            <!-- <label for="">Mulai Dari</label> -->
            <div id="mulai" class="input-group date datepicker mulai">
                <input type="text" class="form-control" placeholder="Mulai Dari Tanggal" id="mulai_date">
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
                <input type="text" class="form-control" placeholder="Sampai Dengan Tanggal" id="sampai_date">
                <span class="input-group-addon input-group-append border-right">
                    <span class="far fa-calendar input-group-text"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group pt-1">
            <label for=""></label>
            <button type="button" class="btn btn-outline-primary btn-icon-text btn-md" onclick="filter_date()">
                <i class="fa fa-filter btn-icon-prepend"></i>
                Filter
            </button>
        </div>
    </div>
</div>
<div class="row grid-margin">
    <div class="col-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fa fa-user mr-2"></i>
                            Informasi Total Barang
                        </p>
                        <h2 class="users">0</h2>
                    </div>
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fas fa-hourglass-half mr-2"></i>
                            Informasi Barang Masuk
                        </p>
                        <h4 class="kasbon" id="kasbon">0</h4>
                    </div>
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fas fa-cloud-download-alt mr-2"></i>
                            Informasi Barang Keluar
                        </p>
                        <h4 class="pesanan" id="pesanan">0</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->endsection();?>