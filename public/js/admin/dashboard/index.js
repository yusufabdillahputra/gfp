function chartTotalDonasi(values) {
    $("#chart_total_donasi").sparkline(values, {
        type: 'line',
        width: $("#chart_total_donasi").width(),
        height: '200',
        fillColor: $.Pages.getColor('primary', .3), // Get Pages contextual color
        lineColor: 'rgba(0,0,0,0)',
        highlightLineColor: 'rgba(0,0,0,.09)',
        highlightSpotColor: 'rgba(0,0,0,.21)',
        spotRadius: 3,
        tooltipFormat: '{{offset:offset}} (Rp. {{y:val}},-)',
        tooltipValueLookups: {
            'offset': {
                0: 'Januari',
                1: 'Februari',
                2: 'Maret',
                3: 'April',
                4: 'Mei',
                5: 'Juni',
                6: 'Juli',
                7: 'Agustus',
                8: 'September',
                9: 'Oktober',
                10: 'November',
                11: 'Desember'
            }
        },
    });
}
