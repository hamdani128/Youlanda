<?=$this->extend('layout/template');?>

<?=$this->Section('content')?>

<div class="page-header">
    <h3 class="page-title">
        Dashboard
    </h3>
</div>

<div class="row grid-margin">
    <div class="col-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fa fa-user mr-2"></i>
                            Total Karyawan
                        </p>
                        <h2><?=$total_karyawan;?></h2>
                        <label
                            class="badge badge-outline-success badge-pill"><?=($total_karyawan / $total_karyawan) * 100?>
                            %
                            increase</label>
                    </div>
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fas fa-hourglass-half mr-2"></i>
                            Karyawan Masuk
                        </p>
                        <h2><?=$total_masuk;?></h2>
                        <label
                            class="badge badge-outline-danger badge-pill"><?=number_format((($total_masuk / $total_karyawan) * 100), 2)?>
                            % decrease</label>
                    </div>
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fas fa-cloud-download-alt mr-2"></i>
                            Karyawan Resign
                        </p>
                        <h2>0</h2>
                        <label class="badge badge-outline-success badge-pill">% 0
                            increase</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->endSection();?>