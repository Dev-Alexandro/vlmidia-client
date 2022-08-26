<?php

require_once 'database.php';

   

if (isset($_POST['funcao'])) {
    $funcao = $_POST['funcao'];
}
if (isset($_POST['link'])) {
    $link = $_POST['link'];
   
}
if (isset($_POST['tipo'])) {
    
    $tipo = $_POST['tipo'];
}




if ($funcao === 'carrega_banco') {
    
    $xml = simplexml_load_file($link);
    
    
    $description = array();
    removeFeed('feeds', $tipo);
    
    foreach ($xml->channel->item as $item) {
       
        $description['description'] = $item->title;
        $description['title'] = $tipo;
        save('feeds', $description);
    }
}


if ($funcao === 'troca_feed') {

    $corpo = '';
    $ret = carrega_feeds_Uol_Noticias();
    $texto = explode('|', $ret);
    $titulo = $texto[0];
    if (count($texto) > 1) {
    $corpo = $texto[1];
    }
   
    
    echo '<span id=texto-titulo-feed >' . $titulo . '</span></br></br><span id=texto-corpo-feed>' . $corpo . '</span>';
}
