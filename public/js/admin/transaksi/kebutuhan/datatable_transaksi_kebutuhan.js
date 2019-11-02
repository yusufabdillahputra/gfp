$(document).ready(function () {
    'use strict';
    var search_input = $('#dt_kebutuhan_search');
    var lenght_select = $('#dt_kebutuhan_length');
    var btn_submit = $('#dt_kebutuhan_submit');
    var table = $('#dt_kebutuhan');

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
            url: "kebutuhan/dtKebutuhan"
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
                name: 'id_feed_donasi',
                data: 'id_feed_donasi'
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
                title: 'Jumlah',
                searchable: true,
                orderable: true,
                name: 'jumlah_feed_satuan',
                data: 'jumlah_feed_satuan'
            },
            {
                title: 'Satuan',
                searchable: true,
                orderable: true,
                name: 'nama_satuan',
                data: 'nama_satuan'
            },
            {
                title: 'Status',
                searchable: true,
                orderable: true,
                name: 'status_feed_donasi',
                data: function (row, type, val, meta) {
                    if (row.status_feed_donasi == 0) {
                        return '<span class="label label-danger">403 | Forbidden</span>';
                    } if (row.status_feed_donasi == 1) {
                        return '<span class="label label-warning">Proses</span>';
                    } if (row.status_feed_donasi == 2) {
                        return '<span class="label label-success">Diterima</span>';
                    } if (row.status_feed_donasi == 3) {
                        return '<span class="label label-danger">Cancel</span>';
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
            },
            {
                title: 'Aksi',
                searchable: false,
                orderable: false,
                name: 'action',
                data: 'action'
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
