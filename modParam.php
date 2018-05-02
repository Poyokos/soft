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

$sql = "Select * from sl_parametro_empresa where rut_empresa = '{$rut}'";
$response = mysqli_query($conn, $sql);

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
?>