<?php 
function retornar_menu($trabajo){
	if($trabajo=="usuario"){return "select * from trabajos where trabajo='usuario' OR trabajo='observador' ";}
	if($trabajo=="admin_asistencias"){return "select * from trabajos where trabajo='usuario' OR trabajo='admin_asistencias' OR trabajo='observador'";}
	if($trabajo=="admin_administracion"){return "select * from trabajos where trabajo='usuario' OR trabajo='admin_administracion' OR trabajo='observador'";}
	if($trabajo=="admin_general"){return "select * from trabajos";}
	if($trabajo=="observador"){return "select * from trabajos where trabajo='observador'";}
	return "Lo siento";
}

function fecha_text ($fecha){
	list($year,$month,$day) = explode("-",$fecha);
		switch ($month){
			case "01" : 
				$text_month="enero";
			break;
			case "02" :
				$text_month="febrero";
				break;
			case "03" :
				$text_month="marzo";
				break;
			case "04" :
				$text_month="abril";
				break;
			case "05" :
				$text_month="mayo";
				break;
			case "06" :
				$text_month="junio";
				break;
			case "07" :
				$text_month="julio";
				break;
			case "08" :
				$text_month="agosto";
				break;
			case "09" :
				$text_month="setiembre";
				break;
			case "10" :
				$text_month="octubre";
				break;
			case "11" :
				$text_month="noviembre";
				break;
			case "12" :
				$text_month="diciembre";
				break;}
		return "".$day." de ".$text_month." del ".$year."";
}
function mes_text ($mes){
		switch ($mes){
			case "01" : 
				$text_month="Enero";
			break;
			case "02" :
				$text_month="Febrero";
				break;
			case "03" :
				$text_month="Marzo";
				break;
			case "04" :
				$text_month="Abril";
				break;
			case "05" :
				$text_month="Mayo";
				break;
			case "06" :
				$text_month="Junio";
				break;
			case "07" :
				$text_month="Julio";
				break;
			case "08" :
				$text_month="Agosto";
				break;
			case "09" :
				$text_month="Setiembre";
				break;
			case "10" :
				$text_month="Octubre";
				break;
			case "11" :
				$text_month="Noviembre";
				break;
			case "12" :
				$text_month="Diciembre";
				break;}
		return $text_month;
}
//Convierto los acentos a HTML

function chao_tilde($entra)

{

	$traduce=array( 'á' => '&aacute;' , 'é' => '&eacute;' , 'í' => '&iacute;' , 'ó' => '&oacute;' , 'ú' => '&uacute;' , 'ñ' => '&ntilde;' , 'Ñ' => '&Ntilde;' , 'ä' => '&auml;' , 'ë' => '&euml;' , 'ï' => '&iuml;' , 'ö' => '&ouml;' , 'ü' => '&uuml;');

	$sale=strtr( $entra , $traduce );

	return $sale;

}

function color_asistencia ($asistencia,$condicion){
	if($asistencia=="Asistio" && $condicion=="Puntual"){return "datos_puntual";}
	if($asistencia=="Asistio" && $condicion=="Tarde"){return "datos_injustificado";}
	if($asistencia=="No Asistio" && $condicion=="Justificado"){return "datos_no_asistio";}
	if($asistencia=="No Asistio" && $condicion=="Injustificado"){return "datos_injustificado";}
	if($asistencia=="Asistio" && $condicion=="Tarde justificado"){return "datos_tarde";}
	return "datos_asistencia";
	
}
function color_deuda ($condicion){
	if($condicion==3){return "datos_pago";}
	if($condicion==2){return "datos_debe";}
	if($condicion==1){return "datos_no_pago";}
	return "datos_deuda";
	
}

?>