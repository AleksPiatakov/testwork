<script>
    // console.log(test_11)

    const session = <?php echo json_encode($_SESSION) ?>;
    const TEXT_BLOCK_PLOT_XAXIS_LABEL = "<?php echo TEXT_BLOCK_PLOT_XAXIS_LABEL ?>";
    const TEXT_BLOCK_PLOT_YAXIS_LABEL = "<?php echo TEXT_BLOCK_PLOT_YAXIS_LABEL ?>";

    const localSession = {...session};
    let language = localSession.languages_code === 'uk' ? localSession.languages_code = 'ua' : localSession.languages_code;

    var options = {
        chart: {
            type: "bar",
            height: $(window).width() >= 768 ? '260px' : '230px',
        },
        fill: {
            type: "solid",
            opacity: 1

        },
        colors: ["#43CE9D", "#FFD400"],
        dataLabels: {
            enabled: false
        },
        series: [
            {
                // name: 'Current month',
                name: TEXT_BLOCK_PLOT_XAXIS_LABEL,
                data: []
            },
            {
                name: TEXT_BLOCK_PLOT_YAXIS_LABEL,
                type: 'column',
                data: [],
                options: {
                    stroke: {
                        width: 0,
                        show: false,
                    },
                }
            }
        ],
        legend: {
            show: false
        },
        yaxis: [
            {
                labels: {
                    formatter: function (value) {
                        if(String(parseInt(value)).length >= 7) {
                            return parseInt(value / 1000000) + 'mln';
                        } else if (String(Math.ceil(value)).length >= 5) {
                            return parseInt(value / 1000) + 'k';
                        } else return parseInt(value);
                    },
                },
            },
            {
                opposite: true,
                labels: {
                    formatter: function (value) {
                        return parseInt(value);
                    },
                },
            }
        ],
        markers: {
            size: 0,
            style: "hollow"
        },
        xaxis: {
            type: "datetime",
            tooltip: {
                enabled: false
            }
        },
        tooltip: {
            x: {
                // format: "dddd, MMMM Do"
                format: "dd MMMM yyyy"
            }
        },
    };

    function drawText(item, text, state) {
        // Define canvas inner class
        var apexChartsInner = item.w.globals.dom.baseEl
            .querySelector(".apexcharts-inner")
            .getBoundingClientRect();

        // Define canvas title position
        var apexchartsTitleText = item.w.globals.dom.baseEl
            .querySelector(".apexcharts-title-text")
            .getBoundingClientRect();

        // Get full canvas height
        var canvas = item.el.offsetHeight;

        return item.addText({
            x: apexchartsTitleText.width + 13,
            y: apexChartsInner.height - canvas + 13,
            text: text,
            fontSize: 16,
            cssClass: "apexcharts-percentage-text " + state
        });
    }

    async function renderCharts(array) {
        var renderedCharts = [];

        // Split charts array to render each
        Object.entries(array).map(async (chart) => {
            // Query selector by it's name
            var el = document.querySelector(chart[0]);

            // Get it's options
            var options = chart[1];

            // Upade options language
            var languageOptions = await $.getJSON('https://cdn.jsdelivr.net/npm/apexcharts/dist/locales/' + language + '.json');
            options.chart.locales = [languageOptions];
            options.chart.defaultLocale = language;

            // console.log(options);

            // Create new ApexCharts element
            var newChart = new ApexCharts(el, options);

            if (el !== null) {
                // Render defined element
                newChart.render();
            } else {
                // Recall current function
                setTimeout(() => {
                    renderCharts(array)
                }, 300);
            }

            // Remove first char of chart name ('#' or '.')
            var name = chart[0].substr(1);

            // Set name as first element of array's object
            renderedCharts[name] = newChart;
        });

        return renderedCharts;
    }

    $("document").ready(function () {
        var renderedChartsArray = {};

        $spinner = $(".new_chart")
            .parents(".item")
            .find(".spinner");

        $.post(
            "index.php",
            {
                plot: "month"
            },
            function (response) {
                options.series[0].data = response.data[0];
                options.series[1].data = response.data[1];

                // Define all charts to render
                var chartArray = {
                    ".index-page-charts": options
                    // '.gross-volume': spark1,
                };

                // Render defined charts
                renderedChartsArray = renderCharts(chartArray);

                $spinner.hide();
            },
            "json"
        );

        // Click to change period
        $(document).on("click", ".chart-link", async function (event) {
            event.preventDefault();

            $spinner.show();
            $(this).parents('.nav-pills').find('li').removeClass("active");
            $(this).parent().addClass("active");

            var period = $(this).attr('data-period');
            var charts = await renderedChartsArray;

            $.post(
                "index.php",
                {
                    plot: period
                },
                function (response) {
                    options.series[0].data = response.data[0];
                    options.series[1].data = response.data[1];

                    var item = charts['index-page-charts'];

                    // Update chart with new data
                    item.updateSeries([
                        {data: response.data[0]},
                        {data: response.data[1]}
                    ]);

                    $spinner.hide();
                },
                "json"
            );
        });

    });


    /*
     Plot
     */
    var $plotLink = $(".plot-link"),
        $plot = $("#plot"),
        plotData = [
            {
                data: [],
                label: "",
                color: "#64b1fc",
                bars: {
                    show: true,
                    barWidth: 12 * 60 * 60 * 1000,
                    align: "center",
                    fill: true
                }
            },
            {
                data: [],
                label: "",
                color: "#16bb00",
                points: {
                    show: true,
                    radius: 3
                },
                lines: {
                    show: true
                },
                yaxis: 2
            }
        ];

    $plotLink.click(function (event) {
        event.preventDefault();

        var $this = $(this),
            $spinner = $this.parents(".item").find(".spinner");

        $spinner.show();
        $plotLink.parent().removeClass("active");
        $this.parent().addClass("active");

        $.post(
            "index.php",
            {
                plot: $this.data("period")
            },
            function (response) {
                plotData[0].data = response.data[0];
                plotData[0].label = response.label[0];
                plotData[1].data = response.data[1];
                plotData[1].label = response.label[1];

                switch (response.plot) {
                    case "day":
                        plotData[0].bars.barWidth = 12 * 60 * 60 * 1000;
                        $plot.getXAxes()[0].options.timeformat = "%d.%m (%a)";
                        $plot.getXAxes()[0].options.minTickSize = [1, "day"];

                        break;

                    case "week":
                        plotData[0].bars.barWidth = (604800 / 2) * 1000;
                        $plot.getXAxes()[0].options.timeformat = "%d.%m";
                        $plot.getXAxes()[0].options.minTickSize = [7, "day"];

                        break;

                    case "month":
                        plotData[0].bars.barWidth = (2629743 / 2) * 1000;
                        $plot.getXAxes()[0].options.timeformat = "%b";
                        $plot.getXAxes()[0].options.minTickSize = [1, "month"];

                        break;
                }

                $plot.setData(plotData);
                $plot.setupGrid();
                $plot.draw();
                $spinner.hide();
            },
            "json"
        );
    });

    /*
     Timer
     */
    setTimeout(function () {
        $(".settings").change(function () {
            var data = {
                settings_header_fixed: $settingsHeaderFixed.val(),
                settings_aside_fixed: $settingsAsideFixed.val(),
                settings_aside_folded: $settingsAsideFolded.val(),
                settings_aside_dock: $settingsAsideDock.val()
            };

            $.post("index.php", {settings: data}, function () {
            }, "json");
        });

        if ($plot.length) {
            $plot = $.plot($plot, plotData, {
                grid: {
                    color: "#ffffff",
                    hoverable: true,
                    size: "11px"
                },
                xaxis: {
                    font: {color: "#ffffff"},
                    mode: "time",
                    timeformat: "%d.%m (%a)",
                    minTickSize: [1, "day"]
                },
                yaxis: {
                    font: {color: "#ffffff"},
                    minTickSize: 1,
                    min: 0
                },
                yaxes: [
                    {},
                    {
                        position: "right"
                    }
                ],
                legend: {
                    backgroundOpacity: 0,
                    margin: 10,
                    color: "#ffffff"
                },
                tooltip: true,
                tooltipOpts: {
                    defaultTheme: false,
                    shifts: {
                        x: 10,
                        y: -25
                    },
                    content: getTooltip
                }
            });
        }

        if ($plotLink.length) {
            $plotLink.first().click();
        }
    }, 2000);

    function getTooltip(label, x, y) {
        var tooltip;
        switch ($("li.active .plot-link").data("period")) {
            case "day":
                tooltip =
                    "<b>" +
                    $.datepicker.formatDate("dd.mm (D)", new Date(x)) +
                    "</b><br><b>" +
                    label +
                    "</b>" +
                    "<br>" +
                    y;
                break;
            case "week":
                tooltip =
                    "<b>" +
                    $.datepicker.formatDate("MM", new Date(x + 86400000)) +
                    "</b><br><b>" +
                    label +
                    "</b>" +
                    "<br>" +
                    y;
                break;
            case "month":
                tooltip =
                    "<b>" +
                    $.datepicker.formatDate("MM", new Date(x + 86400000)) +
                    "</b><br><b>" +
                    label +
                    "</b>" +
                    "<br>" +
                    y;
                break;
        }
        return tooltip;
    }

</script>