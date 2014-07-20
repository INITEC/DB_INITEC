<?php 
function retornar_menu($trabajo){
	if($trabajo=="usuario"){return "select * from trabajos where trabajo='usuario' ";}
	if($trabajo=="admin_asistencias"){return "select * from trabajos where trabajo='usuario' OR trabajo='admin_asistencias'";}
	if($trabajo=="admin_administracion"){return "select * from trabajos where trabajo='usuario' OR trabajo='admin_administracion'";}
	if($trabajo=="admin_general"){return "select * from trabajos";}
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
?>