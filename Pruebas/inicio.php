<?php
// Creamos un array con los nombre de los botones 
$menu_items = Array(); 
$menu_items[0] = "Lunes"; 
$menu_items[1] = "Martes"; 
$menu_items[2] = "Miercoles"; 
$menu_items[3] = "Jueves"; 
$menu_items[4] = "Viernes"; 
$menu_items[5] = "Sabado"; 
?> 
 
<html> 
<head> 
<basefont face=arial> 
</head> 
<body> 
<center><h2>Pulsa sobre una dia</h2></center> 
<table border=0> 
 
<?php
// repite por cada Item 
foreach($menu_items as $channel) 
{ 
// y imprime el boton 
?> 
 
<tr> 
<td> 
<a href="indice.php?channel=<?php echo $channel;?>"> 
<img src="boton.php?channel=<?php echo $channel; ?>" border=0></a> 
</td> 
</tr> 
 
<?php
} 
?> 
 
</table> 
</body> 
</html> 