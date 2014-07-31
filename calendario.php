<!-- Ejemplo original
http://librosweb.es/ejercicios/javascript/soluciones/ejercicio18/ejercicio18.html
-->

<html>
<head>
<title>Ejercicio 18 - Utilidades, Calendario</title>

<link rel="stylesheet" type="text/css" media="all" href="Estilos/calendar-estilo.css" />

<script type="text/javascript" src="JavaScript/calendar/calendar.js"></script>
<script type="text/javascript" src="JavaScript/calendar/calendar-es.js"></script>
<script type="text/javascript" src="JavaScript/calendar/calendar-setup.js"></script>

</head>

<body>

<p></p>
<input type="input" name="fecha" id="fecha" />
<span style="background-color: #ffc; cursor:default; padding:.3em; border:thin solid #ff0; text-decoration:underline; color: blue;" 
onmouseover="this.style.cursor='pointer'; this.style.cursor='hand'; this.style.backgroundColor='#ff8'; this.style.textDecoration='none';"
onmouseout="this.style.backgroundColor='#ffc'; this.style.textDecoration='underline';"
id="fecha_usuario">
Cambiar fecha
</span>


<script type="text/javascript">
Calendar.setup({
  inputField: "fecha",
  ifFormat:   "%Y-%m-%d",
  weekNumbers: false,
  displayArea: "fecha_usuario",
  daFormat:    "%A, %d de %B de %Y"
});
</script>

</body>
</html>
