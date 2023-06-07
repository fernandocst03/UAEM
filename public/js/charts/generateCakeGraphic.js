function generateChart({ id, props }) {
  Highcharts.chart(id, {
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: props.title,
      align: 'left'
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
      point: {
        valueSuffix: '%'
      }
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
          enabled: true,
          format: '<b>{point.name}</b>: {point.percentage:.1f} %'
        }
      }
    },
    series: [{
      name: 'Brands',
      colorByPoint: true,
      data: [{
        name: 'PITC',
        y: props.pitc,
        sliced: true,
        selected: true
      },
      {
        name: 'P34T',
        y: props.p34t,
        sliced: true,
        selected: true
      },
      {
        name: 'PMT',
        y: props.pmt,
        sliced: true,
        selected: true
      },
      {
        name: 'PPH',
        y: props.pph,
        sliced: true,
        selected: true
      },
      ]
    }]
  });
}
