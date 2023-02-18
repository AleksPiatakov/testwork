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

$plotLink.click(function(event) {
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
    function(response) {
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
setTimeout(function() {
  $(".settings").change(function() {
    var data = {
      settings_header_fixed: $settingsHeaderFixed.val(),
      settings_aside_fixed: $settingsAsideFixed.val(),
      settings_aside_folded: $settingsAsideFolded.val(),
      settings_aside_dock: $settingsAsideDock.val()
    };

    $.post("index.php", { settings: data }, function() {}, "json");
  });

  if ($plot.length) {
    $plot = $.plot($plot, plotData, {
      grid: {
        color: "#ffffff",
        hoverable: true,
        size: "11px"
      },
      xaxis: {
        font: { color: "#ffffff" },
        mode: "time",
        timeformat: "%d.%m (%a)",
        minTickSize: [1, "day"]
      },
      yaxis: {
        font: { color: "#ffffff" },
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
        // content: '<b>%x</b><br>%y'
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

// /*
//  Plot
//  */
// var $chartLink = $('.chart-link'),
//   $chart = $('#chart'),
//   plotData = [
//       {
//           data: [],
//           label: '',
//           color: '#64b1fc',
//           bars: {
//               show: true,
//               barWidth: 12 * 60 * 60 * 1000,
//               align: 'center',
//               fill: true
//           }
//       },
//       {
//           data: [],
//           label: '',
//           color: '#16bb00',
//           points: {
//               show: true,
//               radius: 3
//           },
//           lines: {
//               show: true
//           },
//           yaxis: 2
//       }
//   ];

// $chartLink.click(function (event) {
//     event.preventDefault();

//     var $this = $(this),
//       $spinner = $this.parents('.new_chart').find('.spinner');

//     $spinner.show();
//     $chartLink.parent().removeClass('active');
//     $this.parent().addClass('active');
//     if (IS_MOBILE == 1) {
//         var collapse_link = $this.closest('.new_chart').find('.collapse_link');
//         $this.closest('.new_index_title').find('#chart_dropdown').text($this.data('role'));
//         if (collapse_link.hasClass('collapsed')) {
//             collapse_link.click();
//         }
//     }
//     $.post(
//       'index2.php',
//       {
//           'plot': $this.data('period')
//       },
//       function (response) {

//           plotData[0].data = response.data[0];
//           plotData[0].label = response.label[0];
//           plotData[1].data = response.data[1];
//           plotData[1].label = response.label[1];

//           switch (response.plot) {
//               case 'day':
//                   plotData[0].bars.barWidth = 12 * 60 * 60 * 1000;
//                   $chart.getXAxes()[0].options.timeformat = '%d.%m (%a)';
//                   $chart.getXAxes()[0].options.minTickSize = [1, 'day'];

//                   break;

//               case 'week':
//                   plotData[0].bars.barWidth = (604800 / 2) * 1000;
//                   $chart.getXAxes()[0].options.timeformat = '%d.%m';
//                   $chart.getXAxes()[0].options.minTickSize = [7, 'day'];

//                   break;

//               case 'month':
//                   plotData[0].bars.barWidth = (2629743 / 2) * 1000;
//                   $chart.getXAxes()[0].options.timeformat = '%b';
//                   $chart.getXAxes()[0].options.minTickSize = [1, 'month'];

//                   break;
//           }

//           $chart.setData(plotData);
//           $chart.setupGrid();
//           $chart.draw();
//           $spinner.hide();
//       },
//       'json'
//     );
// });

// /*
//  Timer
//  */
// setTimeout(function () {
//     $('.settings').change(function () {
//         var data = {
//             'settings_header_fixed': $settingsHeaderFixed.val(),
//             'settings_aside_fixed': $settingsAsideFixed.val(),
//             'settings_aside_folded': $settingsAsideFolded.val(),
//             'settings_aside_dock': $settingsAsideDock.val()
//         };

//         $.post('index2.php', {'settings': data}, function () {
//         }, 'json');
//     });

//     if ($chart.length) {
//         $chart = $.plot($chart, plotData, {
//             grid: {
//                 color: '#eeeeee',
//                 hoverable: true,
//                 font: {
//                     size: 12,
//                     family: 'Roboto, sans-serif'
//                 }
//             },
//             xaxis: {
//                 font: {
//                     color: '#58666e',
//                     weight: '500',
//                     size: 12,
//                     lineHeight: 14,
//                     family: 'Roboto, sans-serif'
//                 },
//                 mode: 'time',
//                 timeformat: '%d.%m (%a)',
//                 minTickSize: [1, 'day']

//             },
//             yaxis: {
//                 font: {
//                     color: '#58666e',
//                     weight: '700',
//                     size: 12,
//                     lineHeight: 14,
//                     amily: 'Roboto, sans-serif'
//                 },
//                 minTickSize: 1,
//                 min: 0
//             },
//             yaxes: [
//                 {},
//                 {
//                     position: 'right'
//                 }
//             ],
//             legend: {
//                 backgroundOpacity: 0,
//                 margin: 5,

//                 font: {
//                     size: 12,
//                     family: 'Roboto, sans-serif'
//                 }

//             },
//             tooltip: true,
//             tooltipOpts: {
//                 defaultTheme: false,
//                 shifts: {
//                     x: 10,
//                     y: -25
//                 },
//                 // content: '<b>%x</b><br>%y'
//                 content: getTooltip
//             }
//         });
//     }

//     if ($chartLink.length) {
//         $chartLink.first().click();
//     }
// }, 2000);

// function getTooltip(label, x, y) {
//     var tooltip;
//     switch ($('li.active .chart-link').data('period')){
//         case 'day':
//             tooltip = "<b>" + $.datepicker.formatDate('dd.mm (D)',new Date(x)) +"</b><br><b>"+ label+"</b>" + "<br>" + y;
//             break
//         case 'week':
//             tooltip = "<b>" + $.datepicker.formatDate('MM',new Date(x+86400000)) +"</b><br><b>"+ label+"</b>" + "<br>" + y;
//             break
//         case 'month':
//             tooltip = "<b>" + $.datepicker.formatDate('MM',new Date(x+86400000)) +"</b><br><b>"+ label+"</b>" + "<br>" + y;
//             break
//     }
//     return tooltip;
// }
