<?php

mysqli_report(MYSQLI_REPORT_STRICT);

require_once 'config.php';

include 'log.php';

function open_database() {

	try {

		$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $conn->set_charset("utf8"); 
		return $conn;

	} catch (Exception $e) {

		echo $e->getMessage();

		return null;

	}

}

function close_database($conn) {

	try {

		mysqli_close($conn);

	} catch (Exception $e) {

		echo $e->getMessage();

	}

}

function find( $table = null, $id = null ) {
	$database = open_database();
	$found = null;
	try {
	  if ($id) {
	    $sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
	    $result = $database->query($sql);
	    if ($result ->num_rows > 0) {
	      $found = $result->fetch_assoc();
	    }
	  } else {
	    $sql = "SELECT * FROM " . $table;
	    $result = $database->query($sql);
	    if ($result->num_rows > 0) {

	    //$found = $result->fetch_all(MYSQLI_ASSOC);

        

        // Metodo alternativo

        $found = array();

        while ($row = $result->fetch_assoc()) {

          array_push($found, $row);

        } //

	    }
	  }
	} catch (Exception $e) {
	  $_SESSION['message'] = $e->GetMessage();
	  $_SESSION['type'] = 'danger';
  }


	close_database($database);
	return $found;

}

function findMidias() {
	$database = open_database();
	$found = null;
	try {
	    $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));
            $dataHoje = $today->format("Y-m-d");
            $sql = "SELECT * FROM midia where '".$dataHoje."' between dtinicio and dtfim order by id ;";
            //echo $sql;
            $result = $database->query($sql);
	    if ($result->num_rows > 0) {

	    //$found = $result->fetch_all(MYSQLI_ASSOC);

        

        // Metodo alternativo

        $found = array();

        while ($row = $result->fetch_assoc()) {

          array_push($found, $row);

        } //

	    }
	  
	} catch (Exception $e) {
	  $_SESSION['message'] = $e->GetMessage();
	  $_SESSION['type'] = 'danger';
  }


	close_database($database);
	return $found;

}

function find_all( $table ) {

  return find($table);

}

function carrega_midias() {

	global $midias;
	$midias = findMidias();

}

function update($table = null, $id = 0, $data = null, $campo = null) {

  $database = open_database();

  $sql  = "UPDATE " . $table;

  $sql .= " SET $campo = '$data'";

  $sql .= " WHERE id=" . $id . ";";

  try {

    $database->query($sql ) ;

    $_SESSION['message'] = 'Registro atualizado com sucesso.';

    $_SESSION['type'] = 'success';

  } catch (Exception $e) { 

    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';

    $_SESSION['type'] = 'danger';

  } 

  close_database($database);

}

function save($table = null, $data = null) {

    $database = open_database();

    $columns = null;

    $values = null;

    //print_r($data);

    foreach ($data as $key => $value) {

            $columns .= trim($key, "'") . ",";

            $values .= "'$value',";
       
    }

    // remove a ultima virgula

    $columns = rtrim($columns, ',');

    $values = rtrim($values, ',');



    $sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";
   

    try {

        $database->query($sql);
        return $database->insert_id;

        //$_SESSION['message'] = 'Registro cadastrado com sucesso.';
        //$_SESSION['type'] = 'success';
    } catch (Exception $e) {


    echo $e; 
        //$_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
        //$_SESSION['type'] = 'danger';
    }

    close_database($database);
}

function removeFeed($table = null, $tipo = null) {

    $database = open_database();



    try {

        if ($tipo) {

            $sql = "DELETE FROM " . $table . " WHERE title = '" . $tipo."'";

            $result = $database->query($sql);

            if ($result = $database->query($sql)) {

                $_SESSION['message'] = "Registro Removido com Sucesso.";

                $_SESSION['type'] = 'success';
            }
        }
    } catch (Exception $e) {
        
        Logger($e->GetMessage());

        $_SESSION['message'] = $e->GetMessage();

        $_SESSION['type'] = 'danger';
    }

    close_database($database);
}

function carrega_feeds_Uol_Noticias() {

	global $feedsUol_Noticias;
	$feedsUol_Noticias = findFeeds('uol_noticias');
        return $feedsUol_Noticias[0]['description'];

}

function findFeeds($feedTipo = null) {
	$database = open_database();
	$found = null;
	try {
	    
            $sql = "SELECT * FROM feeds where title = '".$feedTipo."'  order by rand() limit 1;";
            //echo $sql;
            $result = $database->query($sql);
	    if ($result->num_rows > 0) {

	    //$found = $result->fetch_all(MYSQLI_ASSOC);

        

        // Metodo alternativo

        $found = array();

        while ($row = $result->fetch_assoc()) {

          array_push($found, $row);

        } //

	    }
	  
	} catch (Exception $e) {
	  $_SESSION['message'] = $e->GetMessage();
	  $_SESSION['type'] = 'danger';
  }


	close_database($database);
	return $found;

}
