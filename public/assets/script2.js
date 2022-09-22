// Pilih Barang
$(document).ready(function() {
    $("#list-request").on('click', '.btn-pilih-request', function() {
        var currentRow = $(this).closest("tr");
        var kode_request = currentRow.find("td:eq(1)").html(); // get current row 1st table cell TD value
        var item = currentRow.find("td:eq(2)").html(); // get current row 1st table cell TD value
        var satuan_request = currentRow.find("td:eq(3)").html(); // get current row 1st table cell TD value
        var qty_request = currentRow.find(".qty_request").val();
        var kategori_request = currentRow.find("td:eq(5)").html(); // get current row 1st table cell TD value
        // var subtotal_pembelian = harga_pembelian * qty_pembelian;

        var tabel = document.getElementById("table-request");
        var row = tabel.insertRow(0);

        var kode = row.insertCell(0);
        var nama = row.insertCell(1);
        var satuan = row.insertCell(2);
        var qty = row.insertCell(3);
        var kategori = row.insertCell(4);
        var keterangan = row.insertCell(5);
        var action = row.insertCell(6);

        kode.innerHTML = kode_request;
        nama.innerHTML = item;
        satuan.innerHTML = satuan_request;
        qty.innerHTML = qty_request;
        kategori.innerHTML = kategori_request;
        keterangan.innerHTML = "Request"
        action.innerHTML = "<button type='button' class='btn btn-sm btn-danger' onclick='deleteRow(this)'><i class='fa fa-trash'></i></button>";
        summary_total_request()
    });
});

function summary_total_request() {
    var table = document.getElementById("table-request"),
        sumVal = 0;
    for (var i = 0; i < table.rows.length; i++) {
        sumVal = sumVal + parseInt(table.rows[i].cells[3].innerHTML);
    }
    document.getElementById('qty_request').innerHTML = sumVal;
}

$(document).ready(function() {
    $("#autocomplete_item").autocomplete({
        source: "/op/gd/autocomplete"
    });
});

function Requestcari() {
    var name_item = $('#autocomplete_item').val();
    var qty_item = $('#request_qty').val();

    $.ajax({
        url: "/op/gd/entry_by_item",
        data: {
            name_item: name_item,
            qty: qty_item,
        },
        type: 'GET',
        dataType: "json",
        success: function(data) {
            var tabel = document.getElementById("table-request");
            // $("#list-belanja").find('tbody').append(data);
            var row = tabel.insertRow(0);
            var kode = row.insertCell(0);
            var nama = row.insertCell(1);
            var satuan = row.insertCell(2);
            var qty = row.insertCell(3);
            var kategori = row.insertCell(4);
            var keterangan = row.insertCell(5);
            var action = row.insertCell(6);

            kode.innerHTML = data[0];
            nama.innerHTML = data[1];
            satuan.innerHTML = data[2];
            qty.innerHTML = data[3];
            kategori.innerHTML = data[4];
            keterangan.innerHTML = "Request";
            action.innerHTML = "<button type='button' class='btn btn-sm btn-danger' onclick='deleteRow(this)'><i class='fa fa-trash'></i></butto>";
            summary_total_request();
        },
        error: function() {
            swal.fire({
                icon: 'warning',
                title: 'Mohon Maaf !',
                text: 'Code Barang ' + name_item + ' Tidak Terdaftar !',
            })
        }
    });
}

function id_change_request(e) {
    var date = e.target.value;
    $.ajax({
        url: "/op/gd/id_change_request",
        method: 'GET',
        data: {
            date: date,
        },
        async: true,
        dataType: 'json',
        success: function(data) {
            document.getElementById('request_id').innerHTML = data;
        }
    });
}

function Eksekusi_Simpan_Request() {
    var Qty_All = $('#qty_request').text();
    var date_request = $('#date_request').val();
    var id_request = $('#request_id').text();

    if (Qty_All === '0') {
        swal.fire({
            icon: 'warning',
            title: 'Mohon Maaf !',
            text: 'List Barang Anda Masih Kosong !',
        })
    } else if (date_request === '') {
        swal.fire({
            icon: 'warning',
            title: 'Mohon Maaf !',
            text: 'Jangan Lupa Tanggal Request Anda !',
        })
    } else {

        Swal.fire({
            title: 'Apakah Anda Yakin Ingin Menyimpan Data ini ?',
            text: "Data yang Telah Diproses Tidak Bisa Direcovery !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#32B54D',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Save it!'
        }).then((result) => {
            if (result.value) {
                var tabel1 = document.getElementById('table-request');

                for (var i = 0; i < tabel1.rows.length; i++) {
                    var kode = tabel1.rows[i].cells[0].innerHTML;
                    var item = tabel1.rows[i].cells[1].innerHTML;
                    var satuan = tabel1.rows[i].cells[2].innerHTML;
                    var qty = tabel1.rows[i].cells[3].innerHTML;
                    var kategori = tabel1.rows[i].cells[4].innerHTML;
                    var keterangan = tabel1.rows[i].cells[5].innerHTML;
                    $.ajax({
                        url: '/op/gd/request/add_detail',
                        method: "GET",
                        async: true,
                        dataType: 'json',
                        data: {
                            id_request: id_request,
                            date_request: date_request,
                            kode: kode,
                            item: item,
                            satuan: satuan,
                            qty: qty,
                            kategori: kategori,
                            keterangan: keterangan,
                        },
                        success: function(data) {}
                    });
                }

                $.ajax({
                    url: '/op/gd/request/add',
                    method: "GET",
                    async: true,
                    data: {
                        id_request: id_request,
                        date_request: date_request,
                    },
                    success: function(data) {
                        swal.fire({
                            icon: 'success',
                            title: 'Transaksi Berhasil',
                            text: 'Transaksi Anda Berhasil',
                        });
                        window.location.href = "/op/gd/request";
                    }
                });
            }
        })

    }
}

function sdm_simpan() {
    var name = $('#anme').val();
    var tempat = $('#tempat').val();
    var tgl_lahir = $('#tgl_lahir').val();

    if (name === '') {
        swal.fire({
            icon: 'success',
            title: 'Transaksi Berhasil',
            text: 'Transaksi Anda Berhasil',
        });
    }
}


function sdm_import() {
    const form = document.getElementById('sdm-import');
    form.submit();
    $('#process').css('display', 'block');
}

function sdm_delete(id, nama) {
    Swal.fire({
        title: 'Apakah Anda Yakin Menghapus Data Karyawan Atas Nama : ' + nama + ' ?',
        text: "Data Yang Telah Terhapus Tidak Bisa Dikembalikan !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            const act = '/sdm/master/delete/' + id;
            document.location.href = act;
        }
    })
}

function sdm_show_update(id) {
    $.ajax({
        url: "/sdm/update_show",
        data: {
            id: id
        },
        type: 'GET',
        dataType: "json",
        success: function(data) {
            $('.modal-body #id_update').val(id);
            $('.modal-body #name_update').val(data[0]);
            $('.modal-body #tempat_update').val(data[1]);
            $('.modal-body #tgl_lahir_update').val(data[2]);
            if (data[3] === "L") {
                $(".modal-body #jk_update_laki").prop("checked", true);
            } else if (data[3] === "P") {
                $(".modal-body #jk_update_perempuan").prop("checked", true);
            } else {
                $(".modal-body #jk_update_laki").prop("checked", false);
                $(".modal-body #jk_update_perempuan").prop("checked", false);
            }
            $('.modal-body #pendidikan_update').val(data[4]);
            $('.modal-body #tmk_update').val(data[5]);
            $('.modal-body #bagian_update').val(data[6]);
            $('.modal-body #jabatan_update').val(data[7]);
            $('.modal-body #departemen_update').val(data[8]);
            $('.modal-body #unit_teknis_update').val(data[9]);
            $('.modal-body #alamat_update').val(data[10]);
            $('.modal-body #status_kawin_update').val(data[11]);
            $('.modal-body #telepon_update').val(data[12]);
            $('.modal-body #ibu_kandung_update').val(data[13]);
            $('.modal-body #status_karyawan_update').val(data[14]);
        }
    });
}

function sdm_update() {
    const form = document.getElementById('sdm-update');
    form.submit();
}

function sdm_show_tambah_resign(id) {
    $.ajax({
        url: "/sdm/show_add_resign",
        data: {
            id: id
        },
        type: 'GET',
        dataType: "json",
        success: function(data) {
            $('.modal-body #id_karyawan').val(id);
            $('.modal-body #nama').val(data[0]);
            $('.modal-body #bagian').val(data[1]);
            $('.modal-body #jabatan').val(data[2]);
            $('.modal-body #departemen').val(data[3]);
            $('.modal-body #unit_teknis').val(data[4]);
            $('.modal-body #tmk').val(data[5]);
            $('.modal-body #jk').val(data[6]);
        }
    });

}

function sdm_add_resgin() {
    var tgl_resgin = $('#tgl_resign').val();
    var keterangan = $('#keterangan').val();
    if (tgl_resgin === '') {
        swal.fire({
            icon: 'warning',
            title: 'Mohon Maaf !',
            text: 'Anda Wajib Mengisi Tanggal Resign !',
        })
    } else if (keterangan === '') {
        swal.fire({
            icon: 'warning',
            title: 'Mohon Maaf !',
            text: 'Jangan Lupa Anda harus memberikan Keterangan Tambahan !',
        })
    } else {
        const form = document.getElementById('sdm-add_resign');
        form.submit();
    }
}

function export_sales() {
    var mulai = $('#mulai_date').val();
    var sampai = $('#sampai_date').val();

    if (mulai == '' || sampai == '') {
        swal.fire({
            icon: 'warning',
            title: 'Mohon Maaf !',
            text: 'Anda Wajib Mengisi Tanggal Export !',
        })
    } else {
        var start = changeDateFormat(mulai);
        var end = changeDateFormat(sampai);
        document.location = "/op/export_sales/" + start + "/" + end;
    }

}

function export_order_sales() {
    var mulai = $('#mulai_date').val();
    var sampai = $('#sampai_date').val();
    if (mulai == '' || sampai == '') {
        swal.fire({
            icon: 'warning',
            title: 'Mohon Maaf !',
            text: 'Anda Wajib Mengisi Tanggal Export !',
        })
    } else {
        var start = changeDateFormat(mulai);
        var end = changeDateFormat(sampai);
        document.location = "/op/export_order_sales/" + start + "/" + end;
    }
}

function export_cashbon() {
    var mulai = $('#mulai_date').val();
    var sampai = $('#sampai_date').val();
    if (mulai == '' || sampai == '') {
        swal.fire({
            icon: 'warning',
            title: 'Mohon Maaf !',
            text: 'Anda Wajib Mengisi Tanggal Export !',
        })
    } else {
        var start = changeDateFormat(mulai);
        var end = changeDateFormat(sampai);
        document.location = "/op/cashbon/" + start + "/" + end;
    }

}

function changeDateFormat(inputDate) { // expects Y-m-d
    var splitDate = inputDate.split('/');
    if (splitDate.count == 0) {
        return null;
    }
    var year = splitDate[2];
    var month = splitDate[0];
    var day = splitDate[1];

    return year + '-' + month + '-' + day;
}


function filter_audit_sales() {
    var start = $('#mulai_audit_filter').val();
    var end = $('#sampai_audit_filter').val();
    var load = document.getElementById('load');
    if (start == '' || end == '') {
        swal.fire({
            icon: 'warning',
            title: 'Mohon Maaf !',
            text: 'Anda Wajib Mengisi Tanggal Export !',
        })
    } else {
        var start = changeDateFormat(start);
        var end = changeDateFormat(end);
        load.style.display = 'block';
        $.ajax({
            url: "/audit/filter_audit_sales",
            data: {
                mulai: start,
                sampai: end,
            },
            type: 'GET',
            dataType: "json",
            success: function(data) {
                var delitua = data["subtotal"][0];
                var tikun = data["subtotal"][1];
                var patumbak = data["subtotal"][4];
                var jamin = data["subtotal"][2];
                var dolok = data["subtotal"][3];
                var samosir = data["subtotal"][5];
                var siantar = data["subtotal"][6];
                var parapat = data["subtotal"][7];
                var tarutung = data["subtotal"][8];
                var balige = data["subtotal"][9];
                document.getElementById('delitua_revenue').innerHTML = delitua;
                document.getElementById('tikun_revenue').innerHTML = tikun;
                document.getElementById('patumbak_revenue').innerHTML = patumbak;
                document.getElementById('jamin_revenue').innerHTML = jamin;
                document.getElementById('saribu_revenue').innerHTML = dolok;
                document.getElementById('siantar_revenue').innerHTML = samosir;
                document.getElementById('parapat_revenue').innerHTML = siantar;
                document.getElementById('tarutung_revenue').innerHTML = parapat;
                document.getElementById('balige_revenue').innerHTML = balige;
                document.getElementById('pangururan_revenue').innerHTML = samosir;
                load.style.display = 'none';
            }
        });
    }
}

function list_retail(id) {
    var start = $('#mulai_audit_filter').val();
    var end = $('#sampai_audit_filter').val();
    var mulai = changeDateFormat(start);
    var sampai = changeDateFormat(end);
    $("#list_retail").empty();
    $("#list_retail").html("");
    $.ajax({
        url: '/audit/list_retail',
        data: {
            unit_id: id,
            mulai: mulai,
            sampai: sampai,
        },
        success: function(data) {
            document.getElementById('date_1').innerHTML = mulai;
            document.getElementById('date_2').innerHTML = sampai;
            $("#list_retail").html("");
            $('#list_retail').html(data);
        },
    });
}