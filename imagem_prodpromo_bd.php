

        <?php

        require_once 'config.php';
        $servername = DB_HOST;
        $username = DB_USER;
        $password = DB_PASSWORD;
        $dbname = DB_NAME;
        $linhasTabela = "";
        $linhasTabela2 = "";
        function logMe($msg){
            // Abre ou cria o arquivo bloco1.txt
            // "a" representa que o arquivo é aberto para ser escrito
            $fp = fopen("log.txt", "a");
            
            // Escreve a mensagem passada através da variável $msg
            $escreve = fwrite($fp, $msg);
            
            // Fecha o arquivo
            fclose($fp); 
            }

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        mysqli_set_charset($conn, "utf8");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT `produtos`.`descprod`,
    `produtos`.`prprod`,
    `produtos`.`imagem`
FROM `intelitv`.`produtos` where codbarras = '" .$_GET['barras']. "';";
        //logMe($sql);
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
           
            while ($row = $result->fetch_assoc()) {

             $resultado  = "<img  id='img-promo' src='img/" . $row["imagem"] . "'></br><p id='preco-promo'>R$ 18,90</p>";
             //logMe($resultado);
            }
        } else {
            $resultado = "";
        }
        $conn->close();



        echo $resultado;


        ?>






