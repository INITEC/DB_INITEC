<?php 
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
?>