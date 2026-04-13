<h1 align="center">Control de Laboratorios FICA - UTEC</h1>

<img width="1916" height="1008" alt="image" src="https://github.com/user-attachments/assets/99e990d7-0712-443a-b94b-37fc23a1601f" />



<h2>Configuración Inicial</h2>
<p>Estimado(a) usuario(a), es un placer y honor compartir este nuevo proyecto enfocado en la administración integral de reservas y activos informáticos para la Facultad de Informática y Ciencias Aplicadas (FICA - UTEC). Agradezco mucho la visita a este repositorio. Antes de iniciar, usted debe realizar algunas configuraciones iniciales para el buen funcionamiento de este proyecto en su servidor local o en la nube. A continuación, se detallarán los cambios que usted debe realizar en el código fuente de la aplicación.</p>

<p><b>1) Configuración de conexión PDO (Base de Datos):</b> Este proyecto ha sido trabajado utilizando objetos de conexión seguros (PDO). Para que el sistema acceda a tus datos, por favor ubique y edite el siguiente archivo crítico: <code>Modelo/conexion.php</code>; allí usted podrá ubicar las variables principales del servidor y realizar el pertinente ajuste con las credenciales de su motor local (por defecto `localhost` y usuario `root` sin contraseña).</p>

<p><b>2) Configuración de la API de Twilio (Notificaciones SMS):</b> Este proyecto cuenta con el envío automático de notificaciones vía red móvil. Su función principal es alertar sobre la creación, modificación, y aprobación de solicitudes de reservas por parte de los docentes. Por lo cual, para evitar errores de latencia HTTP, por favor ubique los archivos controladores e invierta las variables correspondientes a su <b>Account SID</b>, <b>Auth Token</b> y número de teléfono emisor aprobados por Twilio. Para información más detallada, consulte la documentación oficial de Twilio. Usted es libre de comentar o ignorar esta funcionalidad si no cuenta con una llave API vigente.</p>

<p><b>3) Base de Datos:</b> Si por alguna razón al momento de importar la base de datos a su servidor existen errores o alertas de advertencia, quiere decir que la base se importó de manera parcial. Le sugerimos usar herramientas especializadas para bases con lógicas transaccionales fuertes en su interior, como el propio motor MySQL Workbench.</p>

<h2>Importante - Nuevos ajustes al entorno de Twilio</h2>

<p>Se ha blindado el código contra inyecciones e integraciones erróneas. Si usted instala el proyecto en producción pero <b>no ingresa</b> parámetros válidos en los constructores de Twilio, el sistema intentará forzar los comunicados a través de `file_get_contents` y podría ocasionar demoras al confirmar nuevas reservaciones. LOS USUARIOS QUE CLONEN O DESCARGUEN ESTE REPOSITORIO DEBEN ASIGNAR SU PROPIO TOKEN API EN LAS VARIABLES DE ENTORNO. EL TOKEN ORIGINAL FUE REMOVIDO EXPRESAMENTE POR SEGURIDAD.</p>

<h2>Recomendación:</h2>
<p>Se recomienda encarecidamente el uso del SGBD MySQL Workbench; de esta manera, la importación de todos los datos —junto con sus rutinas asociadas— se realizará de mejor forma que usando phpMyAdmin convencional. Para ello debe seguir estos pasos:
<ul>
  <li>Primero cree el esquema de la base de datos. Se recomienda estrictamente el nombre <b>control_laboratorios_utec</b>, ya que es la denominación parametrizada en la aplicación.</li>
  <li>Importe el script SQL que contiene las 18 tablas estructurales del sistema.</li>
  <li>Ejecute e importe las instrucciones para las <b>86 Vistas</b> que generan los reportes y DataTables de la solución.</li>
  <li>Ejecute e importe las instrucciones para los <b>175 Procedimientos Almacenados</b>. (Vital, pues el 100% de la lógica reside aquí).</li>
  <li>Active la variable global <i>Event Scheduler</i> en MySQL y ejecute las instrucciones para los <b>3 Eventos Automáticos / Jobs</b> del sistema.</li>
</ul>
Y de este modo, usted ha importado con éxito toda la lógica que la aplicación web consumirá dinámicamente. Por favor verifique que la cantidad de elementos importados (Tablas, Vistas, SPs) coinciden debidamente.
</p>

<h2>Información General</h2>

<p>Siguiendo los pasos anteriores, ʕ•́ᴥ•̀ʔっ usted ya tiene todo listo para ejecutar este proyecto en su servidor. A continuación se detallarán aspectos técnicos.</p>



<p><b>¿Qué es el Control de Laboratorios FICA?</b> Es una aplicación institucional web moderna que simula y reemplaza un intrincado proceso físico universitario. Usted puede llevar trazabilidad de cada sala especializada (Equipos, Componentes e Instalaciones). Además de ser un centro neurálgico donde los Docentes solicitan reservas con justificaciones, bloqueando cruces de horarios y controlando el cupo estudiantil antes de su aprobación unificada. El sistema clasifica de forma hermética el acceso en tres tipos de roles: <i>Coordinador General, Administrador de Laboratorios y Docentes</i>.</p>

<p>Este sistema, a nivel de código y base de datos, se encuentra distribuido de la siguiente manera:
<ul>
    <li><b>Arquitectura de Base de Datos (MySQL):</b></li>
    <ul>
        <li>18 Tablas transaccionales.</li>
        <li>175 Procedimientos Almacenados delegando la lógica.</li>
        <li>86 Vistas para gráficos e interactividad JSON.</li>
        <li>3 Disparadores temporales y de mantenimiento (Events).</li>
    </ul>
    <li><b>Arquitectura Web (Front y Back):</b></li>
    <ul>
        <li>Backend robusto bajo <b>PHP 8.2+</b> y el patrón <b>Modelo Vista Controlador (MVC)</b>.</li>
        <li>Ausencia total de código SQL dentro de la aplicación. Todas las interacciones llaman exclusivamente a subrutinas seguras.</li>
        <li>Frontend enriquecido usando plantillas Bootstrap.</li>
        <li>Manipulación asincrónica utilizando AJAX y Javascript Vanilla / jQuery.</li>
    </ul>
</ul>
</p>

<h2>¿Qué se puede hacer dentro de esta aplicación académica?</h2>
<p><ul>
  <li>Registar automáticamente y mantener a nuevos Profesores y Administradores.</li>
  <li>Visualización de métricas avanzadas (Dashboard) usando Chart.js para contabilizar el rendimiento, daños de equipos y laboratorios operables.</li>
  <li>Aceptar, posponer o descartar peticiones de reservaciones horarias lanzadas por los docentes con un solo click.</li>
  <li>Configurar avisos masivos hacia el personal.</li>
  <li>Consultar y exportar bitácoras formales o actas padronizadas de equipos a formato PDF y de Cálculo (Excel).</li>
  <li>Monitorear la cuota y disponibilidad de cada centro tecnológico (Por ejemplo: LAB 15 - Edificio Francisco Morazán).</li>
  <li><b>Gestión de Mantenimientos:</b>
    <br>▪ Levantar observaciones críticas de estado de equipos.
    <br>▪ Catalogar un PC o estación como en reparación por el administrador, quitándolo de la capacidad operativa instalada.
  </li>
  <li>Notificación centralizada e instantánea vía sistema o dispositivo telefónico cada vez que el calendario sufre una mutación radical.</li>
</ul>
Son algunas de las funciones macro que tú puedes ejercer dentro del panel. Toma nota de que los privilegios operables para los Docentes son únicamente solicitar y consultar, mientras que Coordinadores disponen de privilegios para asentar parámetros de control.</p>


<h2>Adicional</h2>

<p>Si deseas navegar bajo la demostración nativa de este software, asegúrate de clonar este repositorio usando <i>Git Clone</i> a tu entorno local XAMPP (`htdocs`). Los de acceso a emplear por un usuario Coordinador base son:<br>
<b>Usuario:</b> <code>daniel.rivera</code><br>
<b>Contraseña:</b> <code>lorem12345</code><br>
</p>

<h2>Algunas Capturas del Sistema</h2>

<h4>* Identificación Autenticada al Sistema Institucional</h4>
<img width="1536" height="826" alt="login" src="https://github.com/user-attachments/assets/eb43f13c-e997-4b2e-9332-e4ba49920be7" />


<h4>* Panel Maestro (Métricas y Rendimiento Estructural)</h4>
<img width="1536" height="826" alt="dashboard" src="https://github.com/user-attachments/assets/73adc853-0045-4933-b7f2-c12e01508492" />


<h4>* Interfaz de Gestión y Operatividad en Laboratorios</h4>
<img width="1536" height="826" alt="laboratorios" src="https://github.com/user-attachments/assets/4c93e49d-fc86-4660-9582-409b58a9ef57" />



<h2>Créditos Especiales:</h2>
<p>Para la realización de este proyecto, se ha utilizado el siguiente ecosistema de herramientas formales:

 <b>1. Renderización Dinámica: Bootstrap 5 FrameWork Central </b><br>
 <b>2. Notificaciones y Telecomunicaciones Integradas: API Twilio</b><br>
 <b>3. Lógica Transaccional: MySQL Enterprise Workbench</b><br>
 <b>4. Tabulaciones Avanzadas: JQuery DataTables Plugin</b><br>
  
</p>

<h2>Muchas gracias por obtener este repositorio hecho con muchas tazas de café ☕ ❤️</h2>

![poster_5dfe44fc8738c205dc24cc919a7de3fd](https://user-images.githubusercontent.com/44457989/84722426-6d047d80-af40-11ea-8a6d-31b4466c1c08.png)


** PROYECTO LIBERADO CON FINES EDUCATIVOS Y NO COMERCIALES **


<h4>*** Fecha de Subida: 13 abril 2026 ***</h4>
<h4>*** Año de Desarrollo Institucional: 2023 | Versión 1.0 ***</h4>
