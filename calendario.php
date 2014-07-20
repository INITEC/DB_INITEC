<?
function calendario (){

$tipo_semana = 1;
$tipo_mes = 1;

$MESCOMPLETO[1] = 'Enero';
$MESCOMPLETO[2] = 'Febrero';
$MESCOMPLETO[3] = 'Marzo';
$MESCOMPLETO[4] = 'Abril';
$MESCOMPLETO[5] = 'Mayo';
$MESCOMPLETO[6] = 'Junio';
$MESCOMPLETO[7] = 'Julio';
$MESCOMPLETO[8] = 'Agosto';
$MESCOMPLETO[9] = 'Septiembre';
$MESCOMPLETO[10] = 'Octubre';
$MESCOMPLETO[11] = 'Noviembre';
$MESCOMPLETO[12] = 'Diciembre';

$MESABREVIADO[1] = 'Ene';
$MESABREVIADO[2] = 'Feb';
$MESABREVIADO[3] = 'Mar';
$MESABREVIADO[4] = 'Abr';
$MESABREVIADO[5] = 'May';
$MESABREVIADO[6] = 'Jun';
$MESABREVIADO[7] = 'Jul';
$MESABREVIADO[8] = 'Ago';
$MESABREVIADO[9] = 'Sep';
$MESABREVIADO[10] = 'Oct';
$MESABREVIADO[11] = 'Nov';
$MESABREVIADO[12] = 'Dic';

$SEMANACOMPLETA[0] = 'Domingo';
$SEMANACOMPLETA[1] = 'Lunes';
$SEMANACOMPLETA[2] = 'Martes';
$SEMANACOMPLETA[3] = 'Miércoles';
$SEMANACOMPLETA[4] = 'Jueves';
$SEMANACOMPLETA[5] = 'Viernes';
$SEMANACOMPLETA[6] = 'Sábado';

$SEMANAABREVIADA[0] = 'Dom';
$SEMANAABREVIADA[1] = 'Lun';
$SEMANAABREVIADA[2] = 'Mar';
$SEMANAABREVIADA[3] = 'Mie';
$SEMANAABREVIADA[4] = 'Jue';
$SEMANAABREVIADA[5] = 'Vie';
$SEMANAABREVIADA[6] = 'Sáb';

$ARRDIASSEMANA = $SEMANAABREVIADA;
$ARRMES = $MESABREVIADO;

date_default_timezone_set('America/Los_Angeles');
if(!$dia) $dia = date(d);
if ( isset($_GET["mes"]) ){$mes=$_GET["mes"];}
	else {$mes = date(n);}
if ( isset($_GET["ano"]) ){$ano=$_GET["ano"];}
	else {$ano = date(Y);}

$TotalDiasMes = date(t,mktime(0,0,0,$mes,$dia,$ano));
$DiaSemanaEmpiezaMes = date(w,mktime(0,0,0,$mes,1,$ano));
$DiaSemanaTerminaMes = date(w,mktime(0,0,0,$mes,$TotalDiasMes,$ano));
$EmpiezaMesCalOffset = $DiaSemanaEmpiezaMes;
$TerminaMesCalOffset = 6 - $DiaSemanaTerminaMes;
$TotalDeCeldas = $TotalDiasMes + $DiaSemanaEmpiezaMes + $TerminaMesCalOffset;


if($mes == 1){
	$MesAnterior = 12;
	$MesSiguiente = $mes + 1;
	$ano_a = $ano - 1;
	$ano_s = $ano;
}elseif($mes == 12){
	$MesAnterior = $mes - 1;
	$MesSiguiente = 1;
	$ano_a = $ano;
	$ano_s = $ano + 1;
}else{
	$MesAnterior = $mes - 1;
	$MesSiguiente = $mes + 1;
	$ano_a = $ano;
	$ano_s = $ano;}
	
$AnoAnterior = $ano - 1;
$AnoSiguiente = $ano + 1;






print "<table style=\"font-family:arial;font-size:9px\" bordercolor=navy align=center border=0 cellpadding=1 cellspacing=1>";
print " <tr>";
print " <td colspan=10>";
print " <table border=0 align=center width=\"1%\" style=\"font-family:arial;font-size:9px\">";
print " <tr>";
print " <td width='50px'><a href='calendario.php?mes=$mes&ano=$AnoAnterior'><img src='img_cal/imagen_1.jpg' border='0' width='20px' ></a></td>";
print " <td width='50px'><a href='calendario.php?mes=$MesAnterior&ano=$ano_a'><img src='img_cal/imagen_2.jpg' border='0' width='20px' ></a></td>";
print " <td width='50px' colspan=\"1\" align=\"center\" nowrap><b>".$ARRMES[$mes]." - $ano</b></td>";
print " <td width='50px'><a href='calendario.php?mes=$MesSiguiente&ano=$ano_s'><img src='img_cal/imagen_3.jpg' border='0' width='20px' ></a></td>";
print " <td width='50px'><a href='calendario.php?mes=$mes&ano=$AnoSiguiente'><img src='img_cal/imagen_4.jpg' border='0' width='20px' ></a></td>";
print " </tr>";


print " </table>";
print " </td>";
print "</tr>";
print "<tr>";
foreach($ARRDIASSEMANA AS $key){
print "<td bgcolor=#ccccff><b>$key</b></td>";
}
print "</tr>";

for($a=1;$a <= $TotalDeCeldas;$a++){
if(!$b) $b = 0;
if($b == 7) $b = 0;
if($b == 0) print '<tr>';
if(!$c) $c = 1;
if($a > $EmpiezaMesCalOffset AND $c <= $TotalDiasMes){
if($c == date(d) && $mes == date(m) && $ano == date(Y)){
print "<td bgcolor=\"#ffcc99\">$c<br></td>";
}elseif($b == 0 OR $b == 6){
print "<td bgcolor=#99cccc>$c</td>";
}else{
print "<td bgcolor=\"#EEEEEE\">$c</td>";
}
$c++;
}else{
print "<td> </td>";
}
if($b == 6) print '</tr>';
$b++;
}
print "</table>";
unset($key);
}

?>