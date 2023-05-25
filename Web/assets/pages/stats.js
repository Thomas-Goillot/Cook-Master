if ($("#barChart").length) {
    var currentChartCanvas = $("#barChart").get(0).getContext("2d");
    var currentChart = new Chart(currentChartCanvas, {
      type: "bar",
      data: {
        labels: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
        datasets: dataOfUsers,
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
  
        scales: {
          yAxes: [
            {
              display: false,
              gridLines: {
                drawBorder: false,
              },
              ticks: {
                fontColor: "#686868",
              },
            },
          ],
          xAxes: [
            {
              ticks: {
                fontColor: "#686868",
              },
              gridLines: {
                display: false,
                drawBorder: false,
              },
            },
          ],
        },
        elements: {
          point: {
            radius: 0,
          },
        },
      },
    });
  }

  if ($("#pieChart").length) {
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: {
        datasets: dataOfSubscriptions,
        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
          'Free',
          'Starter',
          'Master'
        ]
      },
      options: {
        responsive: true,
        animation: {
          animateScale: true,
          animateRotate: true
        }
      }
    });
  }


/*
 Template Name: Opatix - Admin & Dashboard Template
 Author: Myra Studio
 File: Morris
*/

$(function() {
  'use strict';
  if ($('#morris-line-example').length) {
    Morris.Line({
      element: 'morris-line-example',
      gridLineColor: '#eef0f2',
      lineColors: ['#9b94da', '#574bd6'],
      data: [{
          y: '2013',
          a: 80,
          b: 100
        },
        {
          y: '2014',
          a: 110,
          b: 130
        },
        {
          y: '2015',
          a: 90,
          b: 110
        },
        {
          y: '2016',
          a: 120,
          b: 140
        },
        {
          y: '2017',
          a: 110,
          b: 125
        },
        {
          y: '2018',
          a: 170,
          b: 190
        },
        {
          y: '2019',
          a: 120,
          b: 140
        }
      ],
      xkey: 'y',
      ykeys: ['a', 'b'],
      hideHover: 'auto',
      resize: true,
      labels: ['Series A', 'Series B']
    });
  }
  if ($('#morris-area-example').length) {
    Morris.Area({
      element: 'morris-area-example',
      lineColors: ['#9b94da', '#9e1b21'],
      data: [{
          y: '2013',
          a: 80,
          b: 100
        },
        {
          y: '2014',
          a: 110,
          b: 130
        },
        {
          y: '2015',
          a: 90,
          b: 110
        },
        {
          y: '2016',
          a: 120,
          b: 140
        },
        {
          y: '2017',
          a: 110,
          b: 125
        },
        {
          y: '2018',
          a: 170,
          b: 190
        },
        {
          y: '2019',
          a: 120,
          b: 140
        }
      ],
      xkey: 'y',
      ykeys: ['a', 'b'],
      hideHover: 'auto',
      gridLineColor: '#eef0f2',
      resize: true,
      labels: ['Series A', 'Series B']
    });
  }
  if ($("#morris-bar-example").length) {
    Morris.Bar({
      element: 'morris-bar-example',
      barColors: ['#c5bff5', '#877de8'],
      data: [{
        y: '2013',
        a: 80,
        b: 100
      },
      {
        y: '2014',
        a: 110,
        b: 130
      },
      {
        y: '2015',
        a: 90,
        b: 110
      },
      {
        y: '2016',
        a: 120,
        b: 140
      },
      {
        y: '2017',
        a: 110,
        b: 125
      },
      {
        y: '2018',
        a: 170,
        b: 190
      },
      {
        y: '2019',
        a: 120,
        b: 140
      }
    ],
      xkey: 'y',
      ykeys: ['a', 'b'],
      hideHover: 'auto',
      gridLineColor: '#eef0f2',
      resize: true,
      barSizeRatio: 0.4,
      labels: ['Series A', 'Series B']
    });
  }
  if ($("#morris-donut-example").length) {
    Morris.Donut({
      element: 'morris-donut-example',
      resize: true,
      colors: ['#FF0000', '#FF4242', '#FF8B8B'],
      data: [{
          label: "Entrées",
          value: dataOfStarters
        },
        {
          label: "Plats",
          value: dataOfDishes
        },
        {
          label: "Desserts",
          value: dataOfDesserts
        }
      ]
    });
  }
  if ($("#line-chart-updating").length) {
    //Updating Line chart data
    var nReloads = 0;
    function data(offset) {
        var ret = [];
        for (var x = 0; x <= 360; x += 10) {
            var v = (offset + x) % 360;
            ret.push({
                x: x,
                y: Math.sin(Math.PI * v / 180).toFixed(4),
                z: Math.cos(Math.PI * v / 180).toFixed(4)
            });
        }
        return ret;
    }
    var graph = Morris.Line({
        element: 'line-chart-updating',
        data: data(0),
        xkey: 'x',
        ykeys: ['y', 'z'],
        labels: ['Apple', 'Samsung'],
        parseTime: false,
        ymin: -1.0,
        ymax: 1.0,
        hideHover: true,
        lineColors: ['#c5bff5', '#9e1b21'],
        resize: true
    });
    function update() {
        nReloads++;
        graph.setData(data(5 * nReloads));
        $('#reloadStatus').text(nReloads + ' reloads');
    }
    setInterval(update, 100);
  }
});



































