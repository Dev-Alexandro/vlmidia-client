var telaAtual = 0;
        
        

        function auto_load_tela() {
            $.ajax({
                url: "telas.php",
                cache: false,
                success: function (data) {

                    var valores = data.split("|");
                   





                    if (telaAtual + 1 === valores.length) {
                        telaAtual = 0;
                        //auto_load_tela();
                        $(window.document.location).attr('href','index.php');
                        
                        

                        


                    } else {


                   
                    var tela = valores[telaAtual].split(";")[0];
                    var tempo = valores[telaAtual].split(";")[2];
                    var posicao = valores[telaAtual].split(";")[1];
                    setTimeout("auto_load_tela()", tempo);//tempo de espera
                    //setInterval(auto_load_tela, tempo);
                    
                        
                                       
                    $("#tela").load(tela);
                    telaAtual += 1;


                    }



                }
            });
        }



        $(document).ready(function () {

            auto_load_tela();
           
          

        });

        
      





