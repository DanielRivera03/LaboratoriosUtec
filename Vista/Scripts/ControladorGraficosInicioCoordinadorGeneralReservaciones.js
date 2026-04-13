      $( document ).ready(function() {
        jQuery.ajax({
          url: '../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=conteo-por-estados-reservaciones-anio-actual',
          type: "POST",
          dataType: "json",
          contentType: "application/json; charset=utf-8",
          success: function (data) {
            Chart.defaults.global = {
              animation: true,
              animationSteps: 60,
              animationEasing: "easeOutIn",
              showScale: true,
              scaleOverride: false,
              scaleSteps: null,
              scaleStepWidth: null,
              scaleStartValue: null,
              scaleLineColor: "#eeeeee",
              scaleLineWidth: 3,
              scaleShowLabels: true,
              scaleLabel: "<%=value%>",
              scaleIntegersOnly: true,
              scaleBeginAtZero: true,
              scaleFontSize: 13,
              scaleFontStyle: "bold",
              scaleFontColor: "#717171",
              responsive: true,
              maintainAspectRatio: true,
              showTooltips: true,
              multiTooltipTemplate: "<%= value %>",
              tooltipFillColor: "#333333",
              tooltipEvents: ["mousemove", "touchstart", "touchmove"],
              tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
              tooltipFontSize: 15,
              tooltipFontStyle: "bold",
              tooltipFontColor: "#fff",
              tooltipTitleFontSize: 16,
              TitleFontStyle : "Raleway",
              tooltipTitleFontStyle: "bold",
              tooltipTitleFontColor: "#ffffff",
              tooltipYPadding: 10,
              tooltipXPadding: 10,
              tooltipCaretSize: 8,
              tooltipCornerRadius: 6,
              tooltipXOffset: 5,
              onAnimationProgress: function() {},
              onAnimationComplete: function() {}
          };
          // RESERVACIONES APROBADAS
          var DatosReservacionesAprobadas = {
              labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
              datasets: [{
                  label: "Reservaciones Aprobadas",
                  fillColor: "rgba(158, 248, 147, 0.4)",
                  strokeColor: vihoAdminConfig.primary,
                  highlightFill: "rgba(158, 248, 147, 0.6)",
                  highlightStroke: vihoAdminConfig.primary,
                  data: [data.resultado[0].ReservacionesAprobadas,data.resultado[1].ReservacionesAprobadas,data.resultado[2].ReservacionesAprobadas,
                  data.resultado[3].ReservacionesAprobadas,data.resultado[4].ReservacionesAprobadas,data.resultado[5].ReservacionesAprobadas,
                  data.resultado[6].ReservacionesAprobadas,data.resultado[7].ReservacionesAprobadas,data.resultado[8].ReservacionesAprobadas,
                  data.resultado[9].ReservacionesAprobadas,data.resultado[10].ReservacionesAprobadas,data.resultado[11].ReservacionesAprobadas],
                  
              }]
          };
          // RESERVACIONES APROBADAS
          var DatosReservacionesDenegadas = {
              labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
              datasets: [{
                  label: "Reservaciones Denegadas",
                  fillColor: "rgba(248, 147, 147, 0.4)",
                  strokeColor: vihoAdminConfig.primary,
                  highlightFill: "rgba(248, 147, 147, 0.6)",
                  highlightStroke: vihoAdminConfig.primary,
                  data: [data.resultado[0].ReservacionesDenegadas,data.resultado[1].ReservacionesDenegadas,data.resultado[2].ReservacionesDenegadas,
                  data.resultado[3].ReservacionesDenegadas,data.resultado[4].ReservacionesDenegadas,data.resultado[5].ReservacionesDenegadas,
                  data.resultado[6].ReservacionesDenegadas,data.resultado[7].ReservacionesDenegadas,data.resultado[8].ReservacionesDenegadas,
                  data.resultado[9].ReservacionesDenegadas,data.resultado[10].ReservacionesDenegadas,data.resultado[11].ReservacionesDenegadas],
                  
              }]
          };
          // RESERVACIONES CANCELADAS
          var DatosReservacionesCanceladas = {
            labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            datasets: [{
                label: "Reservaciones Denegadas",
                fillColor: "rgba(128, 144, 249, 0.4)",
                strokeColor: vihoAdminConfig.primary,
                highlightFill: "rgba(128, 144, 249, 0.6)",
                highlightStroke: vihoAdminConfig.primary,
                data: [data.resultado[0].ReservacionesCanceladas,data.resultado[1].ReservacionesCanceladas,data.resultado[2].ReservacionesCanceladas,
                data.resultado[3].ReservacionesCanceladas,data.resultado[4].ReservacionesCanceladas,data.resultado[5].ReservacionesCanceladas,
                data.resultado[6].ReservacionesCanceladas,data.resultado[7].ReservacionesCanceladas,data.resultado[8].ReservacionesCanceladas,
                data.resultado[9].ReservacionesCanceladas,data.resultado[10].ReservacionesCanceladas,data.resultado[11].ReservacionesCanceladas],
                
            }]
        };
          var Opciones = {
              scaleBeginAtZero: true,
              scaleShowGridLines: true,
              scaleGridLineColor: "rgba(0,0,0,0.1)",
              scaleGridLineWidth: 1,
              scaleShowHorizontalLines: true,
              scaleShowVerticalLines: true,
              barShowStroke: true,
              barStrokeWidth: 2,
              barValueSpacing: 5,
              barDatasetSpacing: 1,
          };
          // APROBADAS
          var ImprimirGraficoReservacionesAprobadas = document.getElementById("ReservacionesAprobadas").getContext("2d");
                GraficoReservacionesAprobadas = new Chart(ImprimirGraficoReservacionesAprobadas).Bar(DatosReservacionesAprobadas, Opciones);
          // DENEGADAS
          var ImprimirGraficoReservacionesDenegadas = document.getElementById("ReservacionesDenegadas").getContext("2d");
                GraficoReservacionesDenegadas = new Chart(ImprimirGraficoReservacionesDenegadas).Bar(DatosReservacionesDenegadas, Opciones);
          // CANCELADAS
          var ImprimirGraficoReservacionesCanceladas = document.getElementById("ReservacionesCanceladas").getContext("2d");
                GraficoReservacionesCanceladas = new Chart(ImprimirGraficoReservacionesCanceladas).Bar(DatosReservacionesCanceladas, Opciones);
          },
        }) 
    }); 