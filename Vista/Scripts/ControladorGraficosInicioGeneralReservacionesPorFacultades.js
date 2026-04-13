$( document ).ready(function() {
    jQuery.ajax({
      url: '../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=conteo-por-facultades-reservaciones-anio-actual',
      type: "POST",
      dataType: "json",
      contentType: "application/json; charset=utf-8",
      success: function (data) {
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.load('current', {'packages':['line']});
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawBasic);
        // ENERO
        let CantidadFicaEnero = parseInt(data.resultado[0].Cantidad);
        let CantidadFCSEnero = parseInt(data.resultado[12].Cantidad);
        let CantidadFCEEnero = parseInt(data.resultado[24].Cantidad);
        let CantidadFDEnero = parseInt(data.resultado[36].Cantidad);
        // FEBRERO
        let CantidadFicaFebrero = parseInt(data.resultado[1].Cantidad);
        let CantidadFCSFebrero = parseInt(data.resultado[13].Cantidad);
        let CantidadFCEFebrero = parseInt(data.resultado[25].Cantidad);
        let CantidadFDFebrero = parseInt(data.resultado[37].Cantidad);
        // MARZO
        let CantidadFicaMarzo = parseInt(data.resultado[2].Cantidad);
        let CantidadFCSMarzo = parseInt(data.resultado[14].Cantidad);
        let CantidadFCEMarzo = parseInt(data.resultado[26].Cantidad);
        let CantidadFDMarzo = parseInt(data.resultado[38].Cantidad);
        // ABRIL
        let CantidadFicaAbril = parseInt(data.resultado[3].Cantidad);
        let CantidadFCSAbril = parseInt(data.resultado[15].Cantidad);
        let CantidadFCEAbril = parseInt(data.resultado[27].Cantidad);
        let CantidadFDAbril = parseInt(data.resultado[39].Cantidad);
        // MAYO
        let CantidadFicaMayo = parseInt(data.resultado[4].Cantidad);
        let CantidadFCSMayo  = parseInt(data.resultado[16].Cantidad);
        let CantidadFCEMayo  = parseInt(data.resultado[28].Cantidad);
        let CantidadFDMayo  = parseInt(data.resultado[40].Cantidad);
        // JUNIO
        let CantidadFicaJunio = parseInt(data.resultado[5].Cantidad);
        let CantidadFCSJunio  = parseInt(data.resultado[17].Cantidad);
        let CantidadFCEJunio  = parseInt(data.resultado[29].Cantidad);
        let CantidadFDJunio  = parseInt(data.resultado[41].Cantidad);
        // JULIO
        let CantidadFicaJulio = parseInt(data.resultado[6].Cantidad);
        let CantidadFCSJulio  = parseInt(data.resultado[18].Cantidad);
        let CantidadFCEJulio  = parseInt(data.resultado[30].Cantidad);
        let CantidadFDJulio  = parseInt(data.resultado[42].Cantidad);
        // AGOSTO
        let CantidadFicaAgosto = parseInt(data.resultado[7].Cantidad);
        let CantidadFCSAgosto  = parseInt(data.resultado[19].Cantidad);
        let CantidadFCEAgosto  = parseInt(data.resultado[31].Cantidad);
        let CantidadFDAgosto  = parseInt(data.resultado[43].Cantidad);
        // SEPTIEMBRE
        let CantidadFicaSeptiembre = parseInt(data.resultado[8].Cantidad);
        let CantidadFCSSeptiembre  = parseInt(data.resultado[20].Cantidad);
        let CantidadFCESeptiembre  = parseInt(data.resultado[32].Cantidad);
        let CantidadFDSeptiembre  = parseInt(data.resultado[44].Cantidad);
        // OCTUBRE
        let CantidadFicaOctubre = parseInt(data.resultado[9].Cantidad);
        let CantidadFCSOctubre   = parseInt(data.resultado[21].Cantidad);
        let CantidadFCEOctubre   = parseInt(data.resultado[33].Cantidad);
        let CantidadFDOctubre   = parseInt(data.resultado[45].Cantidad);
        // NOVIEMBRE
        let CantidadFicaNoviembre = parseInt(data.resultado[10].Cantidad);
        let CantidadFCSNoviembre   = parseInt(data.resultado[22].Cantidad);
        let CantidadFCENoviembre   = parseInt(data.resultado[34].Cantidad);
        let CantidadFDNoviembre   = parseInt(data.resultado[46].Cantidad);
        // DICIEMBRE
        let CantidadFicaDiciembre = parseInt(data.resultado[11].Cantidad);
        let CantidadFCSDiciembre   = parseInt(data.resultado[23].Cantidad);
        let CantidadFCEDiciembre   = parseInt(data.resultado[35].Cantidad);
        let CantidadFDDiciembre   = parseInt(data.resultado[47].Cantidad);
        function drawBasic() {
          if ($("#combo-chart").length > 0) {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Informatica y Ciencias Aplicadas', 'Ciencias Sociales', 'Ciencias Empresariales', 'Derecho'],
          ['Ene',  CantidadFicaEnero, CantidadFCSEnero, CantidadFCEEnero, CantidadFDEnero],
          ['Feb',  CantidadFicaFebrero, CantidadFCSFebrero,     CantidadFCEFebrero,      CantidadFDFebrero],
          ['Mar',  CantidadFicaMarzo, CantidadFCSMarzo,     CantidadFCEMarzo,      CantidadFDMarzo],
          ['Abr',  CantidadFicaAbril, CantidadFCSAbril,     CantidadFCEAbril,      CantidadFDAbril],
          ['May',  CantidadFicaMayo, CantidadFCSMayo,     CantidadFCEMayo,      CantidadFDMayo],
          ['Jun',  CantidadFicaJunio, CantidadFCSJunio,     CantidadFCEJunio,      CantidadFDJunio],
          ['Jul',  CantidadFicaJulio, CantidadFCSJulio,     CantidadFCEJulio,      CantidadFDJulio],
          ['Ago',  CantidadFicaAgosto, CantidadFCSAgosto,     CantidadFCEAgosto,      CantidadFDAgosto],
          ['Sep',  CantidadFicaSeptiembre, CantidadFCSSeptiembre,     CantidadFCESeptiembre,      CantidadFDSeptiembre],
          ['Oct',  CantidadFicaOctubre, CantidadFCSOctubre,     CantidadFCEOctubre,      CantidadFDOctubre],
          ['Nov',  CantidadFicaNoviembre, CantidadFCSNoviembre,     CantidadFCENoviembre,      CantidadFDNoviembre],
          ['Dic',  CantidadFicaDiciembre, CantidadFCSDiciembre,     CantidadFCEDiciembre,      CantidadFDDiciembre]
        ]);
        var options = {
          title : 'Reservaciones Aprobadas Por Facultades / Meses (2023)',
          vAxis: {title: 'Cantidad'},
          hAxis: {title: 'Meses'},
          seriesType: 'bars',
          series: {5: {type: 'line'}},
          height: 600,
          width:'100%',
          colors: ["#e1b12c","#273c75","#c23616","#44bd32"]
      };
      var chart = new google.visualization.ComboChart(document.getElementById('combo-chart'));
      chart.draw(data, options);
      }}
      },
    }) 
}); 