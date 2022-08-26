<?php

require_once 'database.php';
global $atualiza;
$atualiza = find('atualiza', 1);

if ($atualiza['atualiza'] == '1') {
    
    update('atualiza', 1, '0', 'atualiza');
    
} 

echo $atualiza['atualiza'];
