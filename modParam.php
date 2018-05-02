<?php 
include('connection.php');

/* $rut = $_POST["rut"];
$p1 = $_POST["p1"];
$p2 = $_POST["p2"];
$p3 = $_POST["p3"];
$p4 = $_POST["p4"];
$query = false; */

$rut = $_POST["rut"];
$array = array_combine($_POST["key"],$_POST["value"]);
var_dump($_POST);

$sql = "Select * from sl_parametro_empresa where rut_empresa = '{$rut}'";
$response = mysqli_query($conn, $sql);
/* echo $sql;
var_dump($response); */

foreach($array as $nomParam => $value) {
    $sql = "Select * from sl_parametro_empresa where rut_empresa = '{$rut}' AND parametro ='{$nomParam}'";
    $response = mysqli_query($conn, $sql);
    if (mysqli_num_rows($response) == 0) {
        $sql = "INSERT INTO sl_parametro_empresa(parametro,valor,rut_empresa) VALUES('{$nomParam}','{$value}','{$rut}')";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: ".mysql_errno()."\n";
        } 
    }else{
        $sql = "UPDATE sl_parametro_empresa SET valor = '{$value}' WHERE rut_empresa = '{$rut}' AND parametro = '{$nomParam}'";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: ".mysql_errno()."\n";
        }
    }
}

echo "Actualizacion completada";

/* if (mysqli_num_rows($response) == 0) {
    echo "Insert";
    $sql = "INSERT INTO sl_parametro_empresa(rut_empresa,p1,p2,p3,p4) VALUES('{$rut}','{$p1}','{$p2}','{$p3}','{$p4}')";
    if (mysqli_query($conn, $sql)) {
        $query = true;
    }
}else{
    echo "Udpdate";
    $sql = "UPDATE sl_parametro_empresa SET p1 = '{$p1}', p2 = '{$p2}', p3 = '{$p3}',p4 = '{$p4}' WHERE rut_empresa = '{$rut}'";
    echo $sql;
    if (mysqli_query($conn, $sql)) {
        $query = true;
    }
}

if ($query) {
    echo "Datos actualizados";
}else{
    echo "Error al actualizar";
} */

/* if (isset($_POST["create"])) {
    $param = $_POST["parametro"];
    $valor = $_POST["valor"];
    $com = $_POST["comentario"];
    
    $sql = "INSERT INTO sl_system_config (parametro, valor, comentario) VALUES ('{$param}', '{$valor}', '{$com}')";
  
    if (mysqli_query($conn, $sql)) {
  	  $id = mysqli_insert_id($conn);
      $response = '<tr>
      <td>'.$id.'</td>
      <td>'.$param.'</td>
      <td>'.$valor.'</td>
      <td>'.$com.'</td>
      <td>
          <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
          <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i></a>
      </td>
  </tr>';
  	  echo $response;
  	}else {
  	  echo "Error: ". mysqli_error($conn);
    }
   exit();
}

if (isset($_POST["update"])) {
    $param = $_POST["parametro"];
    $valor = $_POST["valor"];
    $com = $_POST["comentario"];
    $id = $_POST["id"];

    $sql = "UPDATE sl_system_config SET parametro = '{$param}', valor = '{$valor}', comentario = '{$com}' WHERE id = '{$id}'";

    if (mysqli_query($conn, $sql)) {
  	  echo "Parametro Editado";
    }else{
        echo "Error, no se a podido editar el parametro: ". mysqli_error($conn);
    }
}

if (isset($_POST["drop"])) {
    $id = $_POST["id"];

    $sql = "DELETE FROM sl_system_config WHERE id = '{$id}'";
   
    if (mysqli_query($conn, $sql)) {
  	  echo "Parametro Eliminado";
    }else{
        echo "Error, no se pudo eliminar el parametro: ". mysqli_error($conn);
    }
} */

?>