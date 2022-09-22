$('#mulai').datepicker({
    enableOnReadonly: true,
    todayHighlight: true,
});
$('#sampai').datepicker({
    enableOnReadonly: true,
    todayHighlight: true,
});
$('#date_request').datepicker({
    enableOnReadonly: true,
    todayHighlight: true,
});
$('#tgl_lahir_update').datepicker({
    enableOnReadonly: true,
    todayHighlight: true,
});
$('#tgl_tmk').datepicker({
    enableOnReadonly: true,
    todayHighlight: true,
});
$('#tmk-add').datepicker({
    enableOnReadonly: true,
    todayHighlight: true,
});
$('#mulai_audit_filter').datepicker({
    enableOnReadonly: true,
    todayHighlight: true,
});
$('#sampai_filter_audit').datepicker({
    enableOnReadonly: true,
    todayHighlight: true,
});



$(document).ready(function () {
    $('#table-list1').DataTable();
    $('#table-list2').DataTable();
    $('#list_table').DataTable();
});

// $(document).ready(function () {
//     $('#list_table').DataTable();
// });


function update_op_master_product($id, $kode, $nama, $harga, $qty, $subtotal) {
    $('.modal-body #id_update').val($id);
    $('.modal-body #kode_update').val($kode);
    $('.modal-body #nama_update').val($nama);
    $('.modal-body #harga_update').val($harga);
    $('.modal-body #qty_update').val($qty);
    $('.modal-body #subtotal_update').val($subtotal);
}

$('.btn_edit_product').click(function () {
    const form = document.getElementById('update_data_produk');
    form.submit();
});

function insert_update_op_master_product() {
    const form = document.getElementById('insert_op_master_product');
    form.submit();
}

function delete_update_op_master_product($id) {
    Swal.fire({
        title: 'Apakah Anda Yakin Data Akan dihapus ?',
        text: "Data Yang Telah Terhapus Tidak Bisa Dikembalikan !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            var id = $id;
            const act = '/op/master_product/delete/' + id;
            document.location.href = act;
        }
    })
}

function ArithAuto() {
    var a = $("#harga").val();
    var b = $("#qty").val();
    var c = a * b;
    $("#subtotal").val(c);
}

function ArithAuto_Upade() {
    var a = $("#harga_update").val();
    var b = $("#qty_update").val();
    var c = a * b;
    $("#subtotal_update").val(c);
}

const swal_info = $('.swal_pesan').data('swal');
if (swal_info) {
    $.toast({
        heading: 'Success',
        text: 'Confirm Notification : ' + swal_info,
        showHideTransition: 'slide',
        icon: 'success',
        loaderBg: '#f96868',
        position: 'top-right'
    })
}

function filter_date() {
    var mulai = $("#mulai_date").val();
    var sampai = $("#sampai_date").val();
    var x = document.getElementById('qty_entitas');

    // var dt = $('#table1').DataTable();
    if (mulai != '' && sampai != '') {
        x.style.display = "block";
        informasi_data_income(mulai, sampai);
        informasi_data_qty(mulai, sampai);
        informasi_data_pesanan(mulai, sampai);
        informasi_data_kasbon(mulai, sampai);
        informasi_data_list_barang(mulai, sampai);
        informasi_order_sales(mulai, sampai);
        informasi_cashbon_employe(mulai, sampai);
        informasi_list_free(mulai, sampai);
    } else {
        swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'jangn lupa Filter Tanggal Dahulu!',
        })
    }
}

function informasi_data_income(mulai = '', sampai = '') {
    $.ajax({
        url: "/op/filter_income",
        data: {
            mulai: mulai,
            sampai: sampai,
        },
        success: function (data) {
            document.getElementById('pendapatan').innerHTML = data;
        }
    });
}

function informasi_data_qty(mulai = '', sampai = '') {
    $.ajax({
        url: "/op/filter_qty",
        data: {
            mulai: mulai,
            sampai: sampai,
        },
        success: function (data) {
            document.getElementById('qty').innerHTML = data;
        }
    });
}

function informasi_data_pesanan(mulai = '', sampai = '') {
    $.ajax({
        url: "/op/filter_pesanan",
        data: {
            mulai: mulai,
            sampai: sampai,
        },
        success: function (data) {
            document.getElementById('pesanan').innerHTML = data;
        }
    });
}

function informasi_data_kasbon(mulai = '', sampai = '') {
    $.ajax({
        url: "/op/filter_kasbon",
        data: {
            mulai: mulai,
            sampai: sampai,
        },
        success: function (data) {

            document.getElementById('kasbon').innerHTML = data;
        }
    });
}

function informasi_data_list_barang(mulai = '', sampai = '') {
    $.ajax({
        url: "/op/filter_barang",
        data: {
            mulai: mulai,
            sampai: sampai,
        },
        success: function (data) {
            $("#informasi_list").html(data);
        }
    });
}

function informasi_order_sales(mulai = '', sampai = '') {
    $.ajax({
        url: "/op/filter_order",
        data: {
            mulai: mulai,
            sampai: sampai,
        },
        success: function (data) {
            $("#informasi_order_sales").html(data);
        }
    });
}

function informasi_cashbon_employe(mulai = '', sampai = '') {
    $.ajax({
        url: "/op/filter_cashbon_employe",
        data: {
            mulai: mulai,
            sampai: sampai,
        },
        success: function (data) {
            $("#informasi_cashbon_income").html(data);
        }
    });
}

function informasi_list_free(mulai = '', sampai = '') {
    $.ajax({
        url: "/op/filter_free_item",
        data: {
            mulai: mulai,
            sampai: sampai,
        },
        success: function (data) {
            $("#informasi_list_free").html(data);
        }
    });
}

function addRowRequest(tableID) {

    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    var colCount = table.rows[0].cells.length;
    for (var i = 0; i < colCount; i++) {
        var newcell = row.insertCell(i);
        newcell.innerHTML = table.rows[0].cells[i].innerHTML;
        //alert(newcell.childNodes);
        switch (newcell.childNodes[0].type) {
            case "text":
                newcell.childNodes[0].value = "";
                break;
            case "checkbox":
                newcell.childNodes[0].checked = false;
                break;
            case "select-one":
                newcell.childNodes[0].selectedIndex = 0;
                break;
        }
    }

}

function deleteRowRequest(tableID) {
    try {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        for (var i = 0; i < rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
            if (null != chkbox && true == chkbox.checked) {
                table.deleteRow(i);
                rowCount--;
                i--;
            }
        }
    } catch (e) {
        alert(e);
    }
}

// Autocomplete

// Pilih Barang
$(document).ready(function () {
    $("#info_brg").on('click', '.btn-pilih', function () {
        var currentRow = $(this).closest("tr");
        var kode_pembelian = currentRow.find("td:eq(1)").html(); // get current row 1st table cell TD value
        var item = currentRow.find("td:eq(2)").html(); // get current row 1st table cell TD value
        var harga_pembelian = currentRow.find("td:eq(3)").html(); // get current row 1st table cell TD value
        var qty_pembelian = currentRow.find(".qty_surat").val(); // get current row 1st table cell TD value
        var subtotal_pembelian = harga_pembelian * qty_pembelian;

        var tabel = document.getElementById("table-suratjalan");
        var row = tabel.insertRow(0);

        var kode = row.insertCell(0);
        var nama = row.insertCell(1);
        var harga = row.insertCell(2);
        var qty = row.insertCell(3);
        var subtotal = row.insertCell(4);
        var action = row.insertCell(5);

        kode.innerHTML = kode_pembelian;
        nama.innerHTML = item;
        harga.innerHTML = harga_pembelian;
        qty.innerHTML = qty_pembelian;
        subtotal.innerHTML = subtotal_pembelian;
        action.innerHTML = "<button type='button' class='btn btn-sm btn-danger' onclick='deleteRow(this)'><i class='fa fa-trash'></i></button>";
        summary_total_surat_jalan()
    });
});

function summary_total_surat_jalan() {
    var table = document.getElementById("table-suratjalan"),
        sumVal = 0;
    for (var i = 0; i < table.rows.length; i++) {
        sumVal = sumVal + parseInt(table.rows[i].cells[3].innerHTML);
    }
    document.getElementById('qty_total').innerHTML = sumVal;
}

function deleteRow(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    summary_total_surat_jalan();
    // document.getElementById("potongan").innerHTML = 0;
    // document.getElementById('kembalian_belanja').innerHTML = 0;
}

function simpan_surat_jalan() {
    var e = document.getElementById("unit_tujuan");
    var value = e.options[e.selectedIndex].value;
    var text = e.options[e.selectedIndex].text;
    var supir = $('#supir').val();
    var kendaraan = $('#no_kendaraan').val();
    var nominal = $('#qty_total').text();
    var id_transaksi = $('#id_surat_jalan').text();

    if (text === 'Pilih Unit Tujuan') {
        swal.fire({
            icon: 'warning',
            title: 'Mohon Maaf !',
            text: 'Jangan Lupa Pilih Unit Tujuan !',
        })
    } else if (supir === '') {
        swal.fire({
            icon: 'warning',
            title: 'Mohon Maaf !',
            text: 'Jangan Lupa Nama Supir Wajib Diisi !',
        })
    } else if (kendaraan === '') {
        swal.fire({
            icon: 'warning',
            title: 'Mohon Maaf !',
            text: 'Jangan Lupa No.Kendaraan Wajib Diisi !',
        })
    } else if (nominal === '0') {
        swal.fire({
            icon: 'warning',
            title: 'Mohon Maaf !',
            text: 'Anda Belom Memasukkan List Item Anda !',
        })
    } else {

        Swal.fire({
            title: 'Apakah Anda Yakin Menyimpan Data ?',
            text: "Data yang Telah Diproses Tidak Bisa Direcovery !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#32B54D',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Save it!'
        }).then((result) => {
            if (result.value) {
                var tabel1 = document.getElementById('table-suratjalan');
                // detail
                for (var i = 0; i < tabel1.rows.length; i++) {
                    kode = tabel1.rows[i].cells[0].innerHTML;
                    item = tabel1.rows[i].cells[1].innerHTML;
                    harga = tabel1.rows[i].cells[2].innerHTML;
                    qty = tabel1.rows[i].cells[3].innerHTML;
                    subtotal_item = tabel1.rows[i].cells[4].innerHTML;
                    $.ajax({
                        url: '/op/master_product/delivery_order/add_detail',
                        method: "GET",
                        async: true,
                        dataType: 'json',
                        data: {
                            id_transaksi: id_transaksi,
                            kode: kode,
                            item: item,
                            harga: harga,
                            qty: qty,
                            subtotal_item: subtotal_item,
                        },
                        success: function (data) { }
                    });
                }

                $.ajax({
                    type: 'GET',
                    url: '/op/master_product/delivery_order/add',
                    data: {
                        id_transaksi: id_transaksi,
                        delivery_to: text,
                        delivery_id: value,
                        driver: supir,
                        no_driver: kendaraan,
                    },
                    success: function (data) {
                        swal.fire({
                            icon: 'success',
                            title: 'Good Luck !',
                            text: 'Invoice Berhasil',
                        });
                        window.location.href = "/op/delivery_order";
                    }
                });

            }
        })
    }
}


function cetak_surat_jalan(id) {
    window.open("/op/delivery_order/invoice/" + id);
}

function surat_jalan_delete(id, code) {
    Swal.fire({
        title: 'Apakah Anda Yakin Menghapus Data Surat Jalan ' + code + ' ?',
        text: "Data yang Telah Diproses Tidak Bisa Direcovery !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#32B54D',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            const act = '/op/delivery_order/delete/' + id;
            document.location.href = act;
        }
    })
}

function suratjalanfilter() {
    var mulai = $('#mulai_date_surat').val();
    var sampai = $('#sampai_date_surat').val();

    if (mulai != '' && sampai != '') {
        $.ajax({
            url: "/op/delivery_order/filter",
            data: {
                mulai: mulai,
                sampai: sampai,
            },
            success: function (data) {
                $("#table-list3").html(data);
            }
        });
    } else {
        swal.fire({
            icon: 'warning',
            title: 'Mohon Maaf !',
            text: 'Jangan Lupa Pilih Filter Tanggal!',
        })
    }
}