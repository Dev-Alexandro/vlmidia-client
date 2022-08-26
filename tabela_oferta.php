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
                var html = "<div class='col-sm-5 col-md-5 col-lg-5'><table class=table id='tabela-precos-promo'>" + dadostabela +
                    "</table></div><div class='col-sm-2 col-md-2 col-lg-2'></div><div class='col-sm-4 col-md-4 col-lg-4' id='promo'></div>";



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
        refreshIntervalTabelaId = setTimeout(auto_load_tabela, 45000);
        setTimeout(destaque, 500);

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

    function destaque() {

        var time = 0;
        //var tempo = ($('table tr').length) * 90000;
        $("tr").each(function(x) {
            var id = $(this).attr("id");

            setTimeout(function() {
                $("tr").css("background-color", "#fff0");
                $("#" + id).css("background-color", "#DF3A01");
                
                $.ajax({
                    url: "imagem_prodpromo_bd.php?barras="+id,
                    cache: false,
                    success: function(data) {

                        if(data != ""){

                            $("#promo").html(data); 

                        }
                                              

                    }
                });

            }, time);
            time += 5000;






        });




    }









    $(document).ready(function() {


        setTimeout(destaque, 500);
        auto_load_mensagem(); //Call auto_load() function when DOM is Ready
        auto_load_tabela(); //Call auto_load() function when DOM is Ready



    });
</script>



<!-- Page Content -->


    <img id='img_table' src='/img/<?php echo $_GET['imagem'] ?>'>

    <div class="row" id="auto_load_tabela_div">




    </div>


<div id="auto_load_mensagem_div_disable">




</div>

<!-- /.container -->

<!-- jQuery -->

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>