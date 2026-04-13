"use strict";

$(document).ready(function () {
  jQuery.ajax({
    url: '../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=conteo-por-facultades-reservaciones-anio-actual',
    type: "POST",
    dataType: "json",
    contentType: "application/json; charset=utf-8",
    success: function success(data) {
      google.charts.load('current', {
        packages: ['corechart', 'bar']
      });
      google.charts.load('current', {
        'packages': ['line']
      });
      google.charts.load('current', {
        'packages': ['corechart']
      });
      google.charts.setOnLoadCallback(drawBasic); // ENERO

      var CantidadFicaEnero = parseInt(data.resultado[0].Cantidad);
      var CantidadFCSEnero = parseInt(data.resultado[12].Cantidad);
      var CantidadFCEEnero = parseInt(data.resultado[24].Cantidad);
      var CantidadFDEnero = parseInt(data.resultado[36].Cantidad); // FEBRERO

      var CantidadFicaFebrero = parseInt(data.resultado[1].Cantidad);
      var CantidadFCSFebrero = parseInt(data.resultado[13].Cantidad);
      var CantidadFCEFebrero = parseInt(data.resultado[25].Cantidad);
      var CantidadFDFebrero = parseInt(data.resultado[37].Cantidad); // MARZO

      var CantidadFicaMarzo = parseInt(data.resultado[2].Cantidad);
      var CantidadFCSMarzo = parseInt(data.resultado[14].Cantidad);
      var CantidadFCEMarzo = parseInt(data.resultado[26].Cantidad);
      var CantidadFDMarzo = parseInt(data.resultado[38].Cantidad); // ABRIL

      var CantidadFicaAbril = parseInt(data.resultado[3].Cantidad);
      var CantidadFCSAbril = parseInt(data.resultado[15].Cantidad);
      var CantidadFCEAbril = parseInt(data.resultado[27].Cantidad);
      var CantidadFDAbril = parseInt(data.resultado[39].Cantidad); // MAYO

      var CantidadFicaMayo = parseInt(data.resultado[4].Cantidad);
      var CantidadFCSMayo = parseInt(data.resultado[16].Cantidad);
      var CantidadFCEMayo = parseInt(data.resultado[28].Cantidad);
      var CantidadFDMayo = parseInt(data.resultado[40].Cantidad); // JUNIO

      var CantidadFicaJunio = parseInt(data.resultado[5].Cantidad);
      var CantidadFCSJunio = parseInt(data.resultado[17].Cantidad);
      var CantidadFCEJunio = parseInt(data.resultado[29].Cantidad);
      var CantidadFDJunio = parseInt(data.resultado[41].Cantidad); // JULIO

      var CantidadFicaJulio = parseInt(data.resultado[6].Cantidad);
      var CantidadFCSJulio = parseInt(data.resultado[18].Cantidad);
      var CantidadFCEJulio = parseInt(data.resultado[30].Cantidad);
      var CantidadFDJulio = parseInt(data.resultado[42].Cantidad); // AGOSTO

      var CantidadFicaAgosto = parseInt(data.resultado[7].Cantidad);
      var CantidadFCSAgosto = parseInt(data.resultado[19].Cantidad);
      var CantidadFCEAgosto = parseInt(data.resultado[31].Cantidad);
      var CantidadFDAgosto = parseInt(data.resultado[43].Cantidad); // SEPTIEMBRE

      var CantidadFicaSeptiembre = parseInt(data.resultado[8].Cantidad);
      var CantidadFCSSeptiembre = parseInt(data.resultado[20].Cantidad);
      var CantidadFCESeptiembre = parseInt(data.resultado[32].Cantidad);
      var CantidadFDSeptiembre = parseInt(data.resultado[44].Cantidad); // OCTUBRE

      var CantidadFicaOctubre = parseInt(data.resultado[9].Cantidad);
      var CantidadFCSOctubre = parseInt(data.resultado[21].Cantidad);
      var CantidadFCEOctubre = parseInt(data.resultado[33].Cantidad);
      var CantidadFDOctubre = parseInt(data.resultado[45].Cantidad); // NOVIEMBRE

      var CantidadFicaNoviembre = parseInt(data.resultado[10].Cantidad);
      var CantidadFCSNoviembre = parseInt(data.resultado[22].Cantidad);
      var CantidadFCENoviembre = parseInt(data.resultado[34].Cantidad);
      var CantidadFDNoviembre = parseInt(data.resultado[46].Cantidad); // DICIEMBRE

      var CantidadFicaDiciembre = parseInt(data.resultado[11].Cantidad);
      var CantidadFCSDiciembre = parseInt(data.resultado[23].Cantidad);
      var CantidadFCEDiciembre = parseInt(data.resultado[35].Cantidad);
      var CantidadFDDiciembre = parseInt(data.resultado[47].Cantidad);

      function drawBasic() {
        if ($("#combo-chart").length > 0) {
          var data = google.visualization.arrayToDataTable([['Month', 'Informatica y Ciencias Aplicadas', 'Ciencias Sociales', 'Ciencias Empresariales', 'Derecho'], ['Ene', CantidadFicaEnero, CantidadFCSEnero, CantidadFCEEnero, CantidadFDEnero], ['Feb', CantidadFicaFebrero, CantidadFCSFebrero, CantidadFCEFebrero, CantidadFDFebrero], ['Mar', CantidadFicaMarzo, CantidadFCSMarzo, CantidadFCEMarzo, CantidadFDMarzo], ['Abr', CantidadFicaAbril, CantidadFCSAbril, CantidadFCEAbril, CantidadFDAbril], ['May', CantidadFicaMayo, CantidadFCSMayo, CantidadFCEMayo, CantidadFDMayo], ['Jun', CantidadFicaJunio, CantidadFCSJunio, CantidadFCEJunio, CantidadFDJunio], ['Jul', CantidadFicaJulio, CantidadFCSJulio, CantidadFCEJulio, CantidadFDJulio], ['Ago', CantidadFicaAgosto, CantidadFCSAgosto, CantidadFCEAgosto, CantidadFDAgosto], ['Sep', CantidadFicaSeptiembre, CantidadFCSSeptiembre, CantidadFCESeptiembre, CantidadFDSeptiembre], ['Oct', CantidadFicaOctubre, CantidadFCSOctubre, CantidadFCEOctubre, CantidadFDOctubre], ['Nov', CantidadFicaNoviembre, CantidadFCSNoviembre, CantidadFCENoviembre, CantidadFDNoviembre], ['Dic', CantidadFicaDiciembre, CantidadFCSDiciembre, CantidadFCEDiciembre, CantidadFDDiciembre]]);
          var options = {
            title: 'Reservaciones Aprobadas Por Facultades / Meses (2023)',
            vAxis: {
              title: 'Cantidad'
            },
            hAxis: {
              title: 'Meses'
            },
            seriesType: 'bars',
            series: {
              5: {
                type: 'line'
              }
            },
            height: 600,
            width: '100%',
            colors: ["#e1b12c", "#273c75", "#c23616", "#44bd32"]
          };
          var chart = new google.visualization.ComboChart(document.getElementById('combo-chart'));
          chart.draw(data, options);
        }
      }
    }
  });
});
//# sourceMappingURL=ControladorGraficosInicioCoordinadorGeneralReservacionesPorFacultades.dev.js.map
