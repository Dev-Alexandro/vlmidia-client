

        <?php

        require_once 'config.php';
        $servername = DB_HOST;
        $username = DB_USER;
        $password = DB_PASSWORD;
        $dbname = DB_NAME;
        $linhasTabela = "";
        $linhasTabela2 = "";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        mysqli_set_charset($conn, "utf8");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT `tabelaproduto`.`codprod`,
    `tabelaproduto`.`descprod`,
    `tabelaproduto`.`unidprod`,
    `tabelaproduto`.`promocprod`,
    `tabelaproduto`.`prprod`,
    `tabelaproduto`.`codbarras`
FROM `intelitv`.`tabelaproduto` order by `tabelaproduto`.`descprod`;";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            $cont = 0;
            $voltas = 0;

            while ($row = $result->fetch_assoc()) {

                $cont += 1;
                $voltas += 1;


                if ($cont == 9) {



                    $linhasTabela = $linhasTabela . "<tr id='" .$row["codbarras"]."' ><td>" . mb_strtoupper(substr($row["descprod"], 0, 35)) . "</td><td>" . 'R$' . number_format($row["prprod"], 2) . "</td><td>" . $row["unidprod"] . "</td></tr>" . "|";
                    $cont = 0;
                    
                } else {
                    
                    $linhasTabela = $linhasTabela . "<tr id='" .$row["codbarras"]."'><td>"  . mb_strtoupper(substr($row["descprod"], 0, 35)) . "</td><td>" . 'R$' . number_format($row["prprod"], 2) . "</td><td>" . $row["unidprod"] . "</td></tr>";
                    
                }
            }
        } else {
            echo "0 results";
        }
        $conn->close();



        echo $linhasTabela;


        ?>






