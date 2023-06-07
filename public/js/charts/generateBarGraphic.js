function generateChart({ id, props }) {
  Highcharts.chart(id, {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Personal docente'
    },
    subtitle: {
      text: 'Año ' + props.anio
    },
    xAxis: {
      categories: props.categories,
      crosshair: true
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Cantidad'
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
    },
    plotOptions: {
      column: {
        pointPadding: 0.2,
        borderWidth: 0
      }
    },
    series: [{
      name: 'Hombres',
      data: props.dataHombres
    },
    {
      name: 'Mujeres',
      data: props.dataMujeres
    }
    ]
  });
}
