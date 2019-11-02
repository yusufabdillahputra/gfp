$(document).ready(function () {
    'use strict';
    var search_input = $('#dt_donasi_search');
    var lenght_select = $('#dt_donasi_length');
    var btn_submit = $('#dt_donasi_submit');
    var table = $('#dt_donasi');

    /**
     * Datatable server side
     */
    var data_table = table.DataTable({
        processing: true,
        serverSide: true,
        /**
         * Ajax diatur di route web
         */
        ajax: {
            url: "donasi/dtDonasi"
        },
        dom: "<'table-responsive't><'row'<p i>>",
        paginationType: "bootstrap",
        destroy: true,
        scrollCollapse: true,
        displayLength: 5,
        language: {
            lengthMenu: "_MENU_",
            info: "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
        },
        columns: [
            /**
             * Data pada column 0 hanya bersifat dummy
             * nantinya data akan di ubah oleh counter_columns
             * Bertujuan menghilangkan warning alert dari Datatable
             * Karena data berasal dari server side
             */
            {
                title: 'No',
                searchable: false,
                orderable: false,
                name: 'id_transaksi',
                data: 'id_transaksi'
            },
            /**
             * Target sesuai dengan tata letak di html (table <thead>)
             */
            {
                title: 'Nama Donatur',
                searchable: true,
                orderable: true,
                name: 'nama_users',
                data: 'nama_users'
            },
            {
                title: 'Transaksi Saldo',
                searchable: true,
                orderable: true,
                name: 'saldo_transaksi',
                data: function (row, type, val, meta) {
                    return 'Rp. '+(Number(row.saldo_transaksi)/1000).toFixed(3);
                }
            },
            {
                title: 'Status',
                searchable: true,
                orderable: true,
                name: 'status_transaksi',
                data: function (row, type, val, meta) {
                    if (row.status_transaksi == 0) {
                        return '<span class="label label-warning">Proses</span>';
                    } if (row.status_transaksi == 1) {
                        return '<span class="label label-success">Sukses</span>';
                    } if (row.status_transaksi == 2) {
                        return '<span class="label label-danger">Cancel</span>';
                    } if (row.status_transaksi == 3) {
                        return '<span class="label">Expired</span>';
                    }
                }
            },
            {
                title: 'Dibuat',
                searchable: true,
                orderable: true,
                name: 'created_at',
                data: function (row, type, val, meta) {
                    return DateFormat.format.prettyDate(row.created_at);
                }
            }
        ],
        order: [
            [1, 'asc']
        ],
        initComplete: function (config, json) {
            /**
             * Masih menggunakan konsep general search
             */
            btn_submit.on('click', function () {
                table.DataTable()
                    .search(search_input.val())
                    .draw()
            });
            /**
             * Mengubah data lenght dari datatable
             */
            lenght_select.on('change', function () {
                table.DataTable().page.len(lenght_select.val()).draw();
            });
        }
    });

    /**
     * Pembuatan counter_columns
     * Sumber : https://datatables.net/examples/api/counter_columns.html
     *          Buka tabs comment dari sumber
     */
    data_table.on('draw.dt', function () {
        var PageInfo = table.DataTable().page.info();
        data_table.column(0, {
            page: 'current'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
});
