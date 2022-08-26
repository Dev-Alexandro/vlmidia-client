<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Título da página</title>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <style>
        html,
        body,
        .container {
            height: 100%;
            background: url('/img/tabela-kawahara.png') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .table {
            border: 0px solid #CCC;
            border-collapse: collapse;
            width: 760px;
            margin-left: 15px;
            margin-top: 199px;
            text-align: center;
        }

        td {
            border: none;
            font-weight: bold;
            font-size: 20px;

        }

        th {

            font-size: 30px;
            text-align: center;
        }
       

      
    </style>
    <script>
        id = 0;

        function destaque() {
            id += 1;
           


            $("tr").css("background-color", "#fff0");
            $("#coll"+id).css("background-color", "#FF0000");
            //idpega =  $("#coll"+id).attr('id');
            //console.log(idpega);
            if (id === 3) {


                id = 0;


            }



        }
        $(document).ready(function() {

            setInterval(destaque, 5000);



        });
    </script>

</head>


<body>



    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-8 col-md-8 col-lg-8">
                <table class="table">
                    <tr>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Unidade</th>
                    </tr>
                    <tr id="coll1">
                        <td>Picanha</td>
                        <td>R$ 29,96</td>
                        <td>KG</td>
                    </tr>
                    <tr id="coll2">
                        <td>Picanha</td>
                        <td>R$ 29,96</td>
                        <td>KG</td>
                    </tr>
                    <tr id="coll3">
                        <td>Picanha</td>
                        <td>R$ 29,96</td>
                        <td>KG</td>
                    </tr>



                </table>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4">

            </div>

        </div>



    </div>



</body>




</html>