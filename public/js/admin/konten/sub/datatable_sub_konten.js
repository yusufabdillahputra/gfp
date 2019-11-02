$(document).ready(function () {
    'use strict';
    var search_input = $('#dt_sub_konten_search');
    var lenght_select = $('#dt_sub_konten_length');
    var btn_submit = $('#dt_sub_konten_submit');
    var table = $('#dt_sub_konten');
    var id_konten = $('#dt_id_konten_val').val();
    var csrf = $('#dt_csrf').val();

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
            url: "dtSubKonten",
            type: "POST",
            data : {
                '_token' : csrf,
                'id_konten' : id_konten
            }
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
                name: 'id_subk',
                data: 'id_subk'
            },
            /**
             * Target sesuai dengan tata letak di html (table <thead>)
             */
            {
                title: 'Judul Sub Konten',
                searchable: true,
                orderable: true,
                name: 'judul_subk',
                data: 'judul_subk'
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
