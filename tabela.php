<script src="js/jquery.js"></script>

<script>
    var tabelas;
    var tabelaAtual = 0;



    function auto_load_tabela() {


        $.ajax({
            url: "tabela_bd.php",
            cache: false,
            success: function(data) {

                var div = data.split("|");
                var dadostabela = div[tabelaAtual];
                var html = "<div><table id='tabela-precos' class=table>" + dadostabela + "</table></div>";



                if ((tabelaAtual + 1) === div.length) {
                    if (dadostabela != "" && !(dadostabela.match(/^\s+$/))) {
                        $("#auto_load_tabela_div").html(html);

                    }
                    tabelaAtual = 0;

                } else {

                    $("#auto_load_tabela_div").html(html);
                    tabelaAtual += 1;


                }



            }
        });
        refreshIntervalTabelaId = setTimeout(auto_load_tabela, 10000);
    }


    function auto_load_mensagem() {

        $.ajax({
            url: "mensagem.php",
            cache: false,
            success: function(data) {
                $("#auto_load_mensagem_div").html(data);
            }
        });
        refreshIntervalMensagemId = setTimeout(auto_load_mensagem, 150000);
    }






    $(document).ready(function() {

        auto_load_mensagem(); //Call auto_load() function when DOM is Ready
        auto_load_tabela(); //Call auto_load() function when DOM is Ready

    });
</script>



<!-- Page Content -->

<div>
    <img id='img_table' src='/img/<?php echo $_GET['imagem'] ?>'>






    <div id="auto_load_tabela_div">




    </div>










</div>
<div id="auto_load_mensagem_div">




</div>

<!-- /.container -->

<!-- jQuery -->

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>