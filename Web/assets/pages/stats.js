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