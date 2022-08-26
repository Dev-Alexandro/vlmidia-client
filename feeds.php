<?php

function showfeed($link) {

    $xml = simplexml_load_file($link)->channel; //carrega o arquivo XML e retornando um Array
    foreach ($xml->item as $item) { //faz o loop nas tag com o nome "item"
        //exibe o valor das tags que estão dentro da tag "item"
        //utilizamos a função "utf8_decode" para exibir os caracteres corretamente
        echo "<strong>Título:</strong> " . $item->title . "<br />";
        echo "<strong>Link:</strong> " . $item->link . "<br />";

        echo "<strong>Descrição:</strong> " . $item->description . "<br />";

      


        echo "<br />";
        
    } //fim do foreach 
}

function showfeeduol() {

    /*
     * Noticias
     * Descricao: Noticias RSS
     * Autor: Tonho
     * Contato: tonhocdn@gmail.com
     * Data: 01/02/2010
     * Modificacao: 01/02/2011
     * Versao: 1.0.0.0
     * Licenca: Copyright (C) 2011
     */

    $xml = simplexml_load_file("https://www.uol.com.br/rss.xml");
    $html = '<p>';
    foreach ($xml->channel->item as $item) {

        $html .= '<font face="Tahoma" size="6" color="#000000">' . $item->title . ' # ' . "</font></b>";
    }


    $html .= '</p>';

    echo $html;
}

?>