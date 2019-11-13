$(document).ready(function () {
    'use strict';
    var search_input = $('#dt_login_search');
    var lenght_select = $('#dt_login_length');
    var btn_submit = $('#dt_login_submit');
    var table = $('#dt_login');

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
            url: "login/dtQueryLogin"
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
                name: 'id_users',
                data: 'id_users'
            },
            /**
             * Target sesuai dengan tata letak di html (table <thead>)
             */
            {
                title: 'Nama Pengguna',
                searchable: true,
                orderable: true,
                name: 'nama_users',
                data: 'nama_users'
            },
            {
                title: 'Akses',
                searchable: true,
                orderable: true,
                name: 'akses_users',
                data: function (row, type, val, meta) {
                    if (row.akses_users == 1) {
                        return '<span class="label label-info">Super Admin</span>';
                    }
                    if (row.akses_users == 2) {
                        return '<span class="label label-warning">Administrator</span>';
                    }
                    if (row.akses_users == 3) {
                        return '<span class="label label-success">Donatur</span>';
                    } else {
                        return row.akses_users;
                    }
                }
            },
            {
                title: 'Logout',
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
