<?php
function ajuste_primera_palabra($texto,$num_letras=8,$add='...'){
            $new_texto = explode(' ',$texto);
            $long = strlen($new_texto[0]);
            if($long > $num_letras){
                $palabra = substr($new_texto[0],0,$num_letras);
                $palabra = $palabra."...";
            } else {
                $palabra = $new_texto[0];
            }
            return $palabra;
        }
?>