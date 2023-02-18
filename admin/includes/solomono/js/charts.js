$(document).ready(function() {

    function generateDayWiseTimeSeries(s, count) {
        var values = [[
          4,3,10,9,29,19,25,9,12,7,19,5,13,9,17,2,7,5
        ], [
          2,3,8,7,22,16,23,7,11,5,12,5,10,4,15,2,6,2
        ]];
        var i = 0;
        var series = [];
        var x = new Date("11 Nov 2012").getTime();
        while (i < count) {
          series.push([x, values[s][i]]);
          x += 86400000;
          i++;
        }
        return series;
      }

    var randomizeArray = function (arg) {
    var array = arg.slice();
    var currentIndex = array.length,
        temporaryValue, randomIndex;

    while (0 !== currentIndex) {

        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
    }

    // data for the sparklines that appear below header area
    var sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46];
    let spark1Data = randomizeArray(sparklineData);

    var options = {
        chart: {
          type: "area",
          height: 300,
          foreColor: "#999",
          stacked: true,
          zoom: {
            type: 'x',
            enabled: true,
            autoScaleYaxis: true
          },
          dropShadow: {
            enabled: true,
            enabledSeries: [0],
            top: -2,
            left: 2,
            blur: 5,
            opacity: 0.06
          }
        },
        colors: ['#0090FF','#DCE6EC'],
        stroke: {
          curve: "smooth",
          width: 2
        },
        dataLabels: {
          enabled: false
        },
        series: [
        {
            name: 'Current month',
            data: generateDayWiseTimeSeries(1, 18)
        }, 
        {
          name: 'Last month',
          data: generateDayWiseTimeSeries(0, 18)
        }],
        markers: {
          size: 0,
          strokeColor: "#fff",
          strokeWidth: 2,
          strokeOpacity: 1,
          fillOpacity: 1,
          hover: {
            size: 5
          }
        },
        xaxis: {
          type: "datetime",
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          tooltip: {
            enabled: false
          }
        },
        yaxis: {
          labels: {
            offsetX: 14,
            offsetY: -5
          },
          tooltip: {
            enabled: false
          }
        },
        grid: {
          padding: {
            left: -5,
            right: 5
          }
        },
        tooltip: {
          x: {
            format: "dd MMM yyyy"
          },
        },
        legend: {
          position: 'top',
          horizontalAlign: 'center'
        },
        fill: {
          type: "gradient",
          fillOpacity: 0
        },
        // fill: {
        //     opacity: 0.3,
        //   },
    };    

    var spark1 = {
    chart: {
        type: 'area',
        height: 200,
        sparkline: {
        enabled: true
        },
    },
    stroke: {
        curve: "smooth",
        width: 2
        },
    fill: {
        opacity: 0.3,
    },
    series: [{
        data: spark1Data
    }],
    yaxis: {
        min: 0
    },
    // colors: ['#DCE6EC'],
    title: {
        text: '$2,330.00',
        offsetX: 0,
        style: {
            fontSize: '24px',
            cssClass: 'apexcharts-title-text',
            color: '#0090FF'
        }
    },
    subtitle: {
        text: 'Gross volume',
        offsetX: 0,
        style: {
            fontSize: '14px',
            cssClass: 'apexcharts-subtitle-text',
            color: '#7e87a9'
        }
    }
    }

    var spark2 = {
        chart: {
            type: 'area',
            height: 200,
            sparkline: {
            enabled: true
            },
        },
        stroke: {
            curve: "smooth",
            width: 2
            },
        fill: {
            opacity: 0.3
        },
        colors: ['#fc4d4a'],
        
        series: [{
            data: randomizeArray(sparklineData)
        }],
        yaxis: {
            min: 0
        },
        // colors: ['#DCE6EC'],
        title: {
            text: '6',
            offsetX: 0,
            style: {
                fontSize: '24px',
                cssClass: 'apexcharts-title-text',
                color: '#fc4d4a'
            }
        },
        subtitle: {
            text: 'New customers',
            offsetX: 0,
            style: {
                cssClass: 'apexcharts-subtitle-text',
                color: '#7e87a9'
            }
        }
    }

    var spark3 = {
        chart: {
            type: 'area',
            height: 200,
            sparkline: {
                enabled: true
            },
        },
        stroke: {
            curve: "smooth",
            width: 2
            },
        fill: {
            opacity: 0.3,
        },
        series: [{
            data: randomizeArray(sparklineData)
        }],
        yaxis: {
            min: 0
        },
        // colors: ['#DCE6EC'],
        title: {
            text: '459',
            offsetX: 0,
            style: {
                fontSize: '24px',
                cssClass: 'apexcharts-title-text',
                color: '#0090FF'
            }
        },
        subtitle: {
            text: 'Successful payments',
            offsetX: 0,
            style: {
                fontSize: '14px',
                cssClass: 'apexcharts-subtitle-text',
                color: '#7e87a9'
            }
        }
    }

    function drawText(item, text, state) {
        // Define canvas inner class
        var apexChartsInner = item.w.globals.dom.baseEl.querySelector('.apexcharts-inner').getBoundingClientRect();

        // Define canvas title position
        var apexchartsTitleText = item.w.globals.dom.baseEl.querySelector('.apexcharts-title-text').getBoundingClientRect();

        // Get full canvas height
        var canvas = (item.el.offsetHeight);

        return item.addText({
            x: apexchartsTitleText.width + 13,
            y: apexChartsInner.height - canvas + 13,
            text: text,
            fontSize: 16,
            cssClass: 'apexcharts-percentage-text ' + state,
        });
    }

    function renderCharts(array) {
        var renderedCharts = [];

        // Split charts array to render each
        Object.entries(array).map(chart => {
            // Query selector by it's name
            var el = document.querySelector(chart[0]);

            // Get it's options
            var options = chart[1];
            
            // Create new ApexCharts element
            var newChart = new ApexCharts(el, options);

            // Render defined element
            newChart.render();

            // Remove first char of chart name ('#' or '.')
            var name = chart[0].substr(1);

            // Set name as first element of array's object 
            renderedCharts[name] = newChart;
        });

        return renderedCharts;
    }
    
    // Define all charts to render
    var chartArray = {
        '#months-comparison-chart': options,
        '.gross-volume': spark1,
        '.new-customers': spark2,
        '.successful-payments': spark3,
        '.revenue-per-customer': spark3,
        '.net-volume-sales': spark2,
        '.high-risk-payments': spark1
    };    

    // Render defined charts 
    var charts = renderCharts(chartArray);


    // Add text to chart
    drawText(charts['successful-payments'], '+25%', 'succeed');
    drawText(charts['new-customers'], '-14%', 'danger');
    drawText(charts['net-volume-sales'], '-3.2%', 'danger');
    drawText(charts['revenue-per-customer'], '+19.8%', 'succeed');
    

});