<script>
    var ctx = $("#myChart");
    var ctxBis = $("#myChartLine");
    var ctxTer = $("#myChartLineBis");
    var data = {
        datasets: [{
            data: [<?php echo round($MuscupourcentageH, 1); ?>, <?php echo round($MuscupourcentageF, 1); ?>],
            backgroundColor: [
                '#069adc', '#E65263'
            ]
        }],
        labels: [
            'Homme',
            'Femme'
        ],

    };
    var dataBis = {
        datasets: [{
            label: "Âge des ahdérents",
            data: [
                <?php echo $Muscutranche1; ?>,
                <?php echo $Muscutranche2; ?>,
                <?php echo $Muscutranche3; ?>,
                <?php echo $Muscutranche4; ?>,
                <?php echo $Muscutranche5; ?>,
                <?php echo $Muscutranche6; ?>,
                <?php echo $Muscutranche7; ?>

            ],
            backgroundColor: [
                '#069adc',
                '#E65263',
                '#484547',
                '#1e6f2e',
                '#05366f',
                '#4c026f',
                '#6f6e04',
                '#000000',
            ]
        }],
        labels: [
            '0-10',
            '11-20',
            '21-30',
            '31-40',
            '41-50',
            '51-60',
            '60 + '
        ],

    };
    new Chart(ctx, {
        type: 'doughnut',
        data: data
    });
    new Chart(ctxBis, {
        type: 'bar',
        data: dataBis,
        options:
            {
                "scales":
                    {
                        "yAxes":
                            [{
                                "ticks":
                                    {
                                        "beginAtZero": true,
                                        suggestedMin: 0,
                                        suggestedMax: <?php echo $Muscustat['total']; ?> }

                            }]
                    }
            }
    });
    new Chart(ctxTer, {
        type: 'bar',
        data: dataBis,
        options:
            {
                "scales":
                    {
                        "yAxes":
                            [{
                                "ticks":
                                    {
                                        "beginAtZero": true,
                                        suggestedMin: 0,
                                        suggestedMax: 100
                                    }

                            }]
                    }
            }
    });

    $(document).ready(function () {
        $('body').on('click', '.selectorDiag', function () {

            var idEl = $(this).attr('data-toggle');
            if (!$(this).hasClass('active')) {
                $('.selectorDiag').each(function () {
                    $(this).removeClass('active');
                });
                $(this).addClass('active');
                $('.chart').each(function () {
                    if (!$(this).hasClass('d-none')) {
                        $(this).addClass('d-none');
                    }
                });

                $(idEl).removeClass('d-none');
            }
        });
    });


</script>

