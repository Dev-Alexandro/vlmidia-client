<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
require_once 'config.php';
require_once 'database.php';
carrega_midias();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>LinkMidia TV</title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="js/jquery.js"></script> 
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">

            var refreshIntervalTabelaId = null;   
            var refreshIntervalMensagemId = null;
            var midias = <?php echo json_encode($midias, JSON_UNESCAPED_UNICODE); ?>;
            //console.log(midias);
            if (midias !== null) {
                var num_img = midias.length;
                var img_atual = 0;
                var encerra_midia = 0;
                var feeds_g1_brasil = 0;


            }

            function ChangeScreen()
            {
                  
                clearTimeout(refreshIntervalTabelaId);
                clearTimeout(refreshIntervalMensagemId);
                if (midias !== null)
                {
                    if (img_atual < (num_img - 1))
                    {
                        img_atual = img_atual + 1;
                    } else
                    {
                        img_atual = 0;
                    }

                    var tempo = midias[img_atual]['tempo'];
                    var tempo_split = tempo.split(":");
                    var milisegundos = (tempo_split[0] * 3600000) + (tempo_split[1] * 60000) + (tempo_split[2] * 1000);
                    var midia = midias[img_atual]['midia'];
                    var data_atual_formatada = new Date();
                    var mes = "";

                    if (data_atual_formatada.getUTCMonth() < 10) {
                        var mesInt = parseInt(data_atual_formatada.getMonth());
                        var mesInt = mesInt + 1;
                        mes = '0' + mesInt;
                    } else {

                        var mesInt = parseInt(data_atual_formatada.getMonth());
                        var mesInt = mesInt + 1;
                        mes = mesInt;

                    }

                    if (data_atual_formatada.getDate() < 10) {

                        dia = '0' + data_atual_formatada.getDate();

                    } else {

                        dia = data_atual_formatada.getDate();
                    }


                    var data_atual = data_atual_formatada.getFullYear() + "-" + mes + "-" + dia;
                    var data_fim = midias[img_atual]['dtfim'].split('-')[0] + "-" + midias[img_atual]['dtfim'].split('-')[1] + "-" + midias[img_atual]['dtfim'].split('-')[2];

                    if (Date.parse(data_fim) < Date.parse(data_atual)) {

                        encerra_midia = 1;
                        atualiza();

                    }





                    if (midias[img_atual]['tipo'] === 'Imagem') {

                        var html = "<img id='imagem' src='img/" + midia + "'>";
                         $("#tela").html(html);

                    } else if ((midias[img_atual]['tipo']) === 'Video') {

                       
                        var html = "<video controls autoplay id='video'> <source src='img/" + midia + "' type= video/mp4; codecs='avc1.42E01E, mp4a.40.2'> <source src='img/" + midia + "' type= video/webm; codecs='vp8, vorbis'></video>";
                         $("#tela").html(html);

                    } else if ((midias[img_atual]['tipo']) === 'uol_noticias') {
                        
                         
                        $.ajax({
                            url: 'feeds_uol_noticias.php',
                            type: 'POST',
                            data: {'funcao': 'troca_feed'},
                            success: function (data) {
                                
                               var html = "<img id='imgfeed' src='img/" + midia + "'><span id='texto-feed'>"+data+"</span>";
                                $("#tela").html(html);
                               
                                
                            }
                        })
                        
                        
                        
                        //var html = "<img id='conteudo' src='img/" + midia + "'><h2 id='texto-feed'>"+feedsUolNoticias[0]['description']+"</h2>";
                        


                    } else if ((midias[img_atual]['tipo']) === 'tabela') {

                        //console.log("aqui");
                        var tela = 'tabela.php?imagem='+midia;
                        $("#tela").load(tela);
                        
                    } else if  ((midias[img_atual]['tipo']) === 'tabela_oferta') {


                        var tela = 'tabela_oferta.php?imagem='+midia;
                        $("#tela").load(tela);

                    }


                    
                    
                }
               
                setTimeout("ChangeScreen()", milisegundos);
            }

            function CarregaFeedsUolNoticias() {


               
        
               
                for (i = 0; i < midias.length; i++) {
                    
                    if ((midias[i]['tipo']) === 'uol_noticias') {
                      
                        var link = midias[i]['feeds'];

                        $.ajax({
                            url: 'feeds_uol_noticias.php',
                            type: 'POST',
                            data: {'link': link, 'tipo': 'uol_noticias', 'funcao': 'carrega_banco'},
                            success: function (data) {
                                
                            }
                        });





                    }


                }




            }
            function atualiza() {


                $.ajax({

                    url: "atualiza.php",
                    success: function (data) {

                        if (encerra_midia == 1) {

                            encerra_midia = 0;
                            location.reload();

                        }


                        if (data == '1') {

                            location.reload();

                        }


                    }

                });





            }

            $(document).ready(function () {

                CarregaFeedsUolNoticias();
                ChangeScreen();



            });

            setInterval(function () {
                atualiza();
            }, 3000);

        </script>
    </head>
    <body>
        <div id="tela" class="container-fluid">

           


        </div>
    </body>

</html>
