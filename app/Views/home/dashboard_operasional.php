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
    <div class="col-12 col-md-5">
        <div class="form-group pt-1">
            <div class="input-group">
                <button type="button" class="btn btn-info btn-icon-text btn-md" onclick="filter_date()">
                    <i class="fa fa-filter btn-icon-prepend"></i>
                    Filter
                </button>
                <div class="btn-group">
                    <button type="button" class="btn btn-dark">Export Excel</button>
                    <button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split"
                        id="dropdownMenuSplitButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton6">
                        <h6 class="dropdown-header">Pilih Data :</h6>
                        <a class="dropdown-item" onclick="export_sales()" href="#">Sales</a>
                        <a class="dropdown-item" onclick="export_order_sales()" href="#">Order Sales</a>
                        <a class="dropdown-item" onclick="export_cashbon()" href="#">Cashbon</a>
                        <!-- <div class="dropdown-divider"></div> -->
                        <a class="dropdown-item" href="#">Free Product</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Info dashboard -->
<div class="row grid-margin">
    <div class="col-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fa fa-user mr-2"></i>
                            Jumlah Pegawai
                        </p>
                        <h2 class="users"><?=$pegawai;?></h2>
                    </div>
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fas fa-hourglass-half mr-2"></i>
                            Kasbon
                        </p>
                        <h4 class="kasbon" id="kasbon">0</h4>
                    </div>
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fas fa-cloud-download-alt mr-2"></i>
                            Pesanan
                        </p>
                        <h4 class="pesanan" id="pesanan">0</h4>
                    </div>
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fas fa-check-circle mr-2"></i>
                            Jumlah Produk
                        </p>
                        <h2 class="jlh_produk"><?=$jlh_produk;?></h2>
                    </div>
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fas fa-chart-line mr-2"></i>
                            Pendapatan Penjualan
                        </p>
                        <h4 class="pendapatan" id="pendapatan">0</h4>
                    </div>
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fas fa-circle-notch mr-2"></i>
                            Jumlah Keluar
                        </p>
                        <h2 class="jlh_keluar" id="qty">0</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="qty_entitas" style="display: block;">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail List Information</h4>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home-1" role="tab"
                            aria-controls="home-1" aria-selected="true">Sales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile-1" role="tab"
                            aria-controls="profile-1" aria-selected="false">Order Sales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact-1" role="tab"
                            aria-controls="contact-1" aria-selected="false">Cashbon</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#channel-1" role="tab"
                            aria-controls="channel-1" aria-selected="false">free Product</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                        <!-- <div class="row">
                            <div class="col-md-12">
                                <div class="text-right">
                                    <button type="button" class="btn btn-md btn-dark" >
                                        Export
                                    </button>
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table" id="order-listing">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Code Product</th>
                                                <th>Name Product</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody id="informasi_list">
                                            <tr>
                                                <td colspan="3" class="text-center"> Data Not Found</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table" id="order-listing2">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Code Product</th>
                                                <th>Name Product</th>
                                                <th>Qty</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody id="informasi_order_sales">
                                            <tr>
                                                <td colspan="3" class="text-center"> Data Not Found</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact-1" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table" id="order-listing3">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Code Transaction</th>
                                            <th>Employe</th>
                                            <th>Code Product</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th>Potongan</th>
                                            <th>Cretaed At</th>
                                        </tr>
                                    </thead>
                                    <tbody id="informasi_cashbon_income">
                                        <tr>
                                            <td colspan="10" class="text-center"> Data Not Found</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="channel-1" role="tabpanel" aria-labelledby="channel-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table" id="order-listing4">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Code Product</th>
                                                <th>Name Product</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody id="informasi_list_free">
                                            <tr>
                                                <td colspan="3" class="text-center"> Data Not Found</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fas fa-gift"></i>
                    Orders
                </h4>
                <canvas id="orders-chart"></canvas>
                <div id="orders-chart-legend" class="orders-chart-legend"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fas fa-chart-line"></i>
                    Sales
                </h4>
                <h2 class="mb-5">56000 <span class="text-muted h4 font-weight-normal">Sales</span></h2>
                <canvas id="sales-chart"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body d-flex flex-column">
                <h4 class="card-title">
                    <i class="fas fa-chart-pie"></i>
                    Sales status
                </h4>
                <div class="flex-grow-1 d-flex flex-column justify-content-between">
                    <canvas id="sales-status-chart" class="mt-3"></canvas>
                    <div class="pt-4">
                        <div id="sales-status-chart-legend" class="sales-status-chart-legend"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body d-flex flex-column">
                <h4 class="card-title">
                    <i class="fas fa-tachometer-alt"></i>
                    Daily Sales
                </h4>
                <p class="card-description">Daily sales for the past one month</p>
                <div class="flex-grow-1 d-flex flex-column justify-content-between">
                    <canvas id="daily-sales-chart" class="mt-3 mb-3 mb-md-0"></canvas>
                    <div id="daily-sales-chart-legend" class="daily-sales-chart-legend pt-4 border-top"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-md-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                        <button class="btn btn-social-icon btn-facebook btn-rounded">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <div class="ml-4">
                            <h5 class="mb-0">Facebook</h5>
                            <p class="mb-0">813 friends</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                        <button class="btn btn-social-icon btn-twitter btn-rounded">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <div class="ml-4">
                            <h5 class="mb-0">Twitter</h5>
                            <p class="mb-0">9000 followers</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                        <button class="btn btn-social-icon btn-google btn-rounded">
                            <i class="fab fa-google-plus-g"></i>
                        </button>
                        <div class="ml-4">
                            <h5 class="mb-0">Google plus</h5>p
                            <p class="mb-0">780 friends</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-social-icon btn-linkedin btn-rounded">
                            <i class="fab fa-linkedin-in"></i>
                        </button>
                        <div class="ml-4">
                            <h5 class="mb-0">Linkedin</h5>
                            <p class="mb-0">1090 connections</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<?=$this->endsection()?>