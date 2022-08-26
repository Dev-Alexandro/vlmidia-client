<!DOCTYPE html>
<html>
<head>
 <!--<meta charset="utf-8">-->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

   <!-- <title>Portfolio Item - Start Bootstrap Template</title>-->

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!--<link href="css/portfolio-item.css" rel="stylesheet">-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body>

<?php


$servername = "localhost";
$username = "root";
$password = "c96b3c06";
$dbname = "intelitv";
$linhasTabela = ""; 
$linhasTabela2= "";
require_once('feeds.php');
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT `tabelaproduto`.`codprod`,
    `tabelaproduto`.`descprod`,
    `tabelaproduto`.`unidprod`,
    `tabelaproduto`.`promocprod`,
    `tabelaproduto`.`prprod`
FROM `intelitv`.`tabelaproduto` limit 18;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
	$cont = 0;
    while($row = $result->fetch_assoc()) {
		
		$cont += 1;
		if($cont == 10)
			break;
			
		$linhasTabela = $linhasTabela. "<tr><td>". mb_strtoupper(substr($row["descprod"],0,35))."</td><td>". 'R$' . number_format($row["prprod"], 2)."</td><td>". $row["unidprod"]."</td></tr>";
		
		
       
    
	
	}
} else {
    echo "0 results";
}
$conn->close();








			
   
	
       
		
			  echo"<h1 style='font-size: 150%;'><MARQUEE HEIGHT=60 WIDTH=900 DIRECTION=LEFTH SCROLLAMOUNT=15 style='font-weight: bold;  color: black;'>";
                          
                          echo showfeeduol();
                          
                          echo"</MARQUEE></h1>";
			  
			  
      
	
	
	
							

 







?>






   <!-- jQuery -->
    <script src="js/jquery.js"></script>
	

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>