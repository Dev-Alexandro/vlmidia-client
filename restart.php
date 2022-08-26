<?php


try {
 shell_exec('sudo reboot');  
 echo 'Reiniciando Maquina!!!';

} catch (Exception $e) {
  
  echo 'Exceção capturada: ',  $e->getMessage(), "\n";
}


?>
