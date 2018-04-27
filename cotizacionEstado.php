<?php
iclude('connection.php');

var_dump($_POST);
/* $nOperacion =  $_POST["nOperacion"];

$sql = 'SELECT n_DTE FROM sl_dte WHERE n_operacion = '.$nOperacion;
$response = mysqli_query($conn,$sql);

while ($row = mysqli_fetch_assoc($response)) {
    if ($_POST['compra'.$row["n_DTE"]] == "Si") {
        $sql = 'UPDATE sl_dte SET observacion = "", monto_financiado = '.$_POST['DTE'.$row["n_DTE"]].' ,acepta_compra_DTE = "Si" WHERE n_DTE = '.$row["n_DTE"];
    }else{
        $sql = 'UPDATE sl_dte SET observacion = "'.$_POST['obs'.$row["n_DTE"]].'" ,acepta_compra_DTE = "No", monto_financiado = 0 WHERE n_DTE = '.$row["n_DTE"];
    }
    mysqli_query($conn,$sql);
} */
?>