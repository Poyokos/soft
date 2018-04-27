<?php
include('connection.php');

var_dump($_POST);
$nOperacion =  $_POST["nOperacion"];

$sql = 'SELECT * FROM sl_grand_table WHERE n_operacion = '.$nOperacion;
$response = mysqli_query($conn,$sql);

/* while ($row = mysqli_fetch_assoc($response)) {
    if ($_POST['compra'.$row["nro_dte"]] == "Si") {
        $sql = 'UPDATE sl_dte SET observacion = "", monto_financiado = '.$_POST['DTE'.$row["nro_dte"]].' ,acepta_compra_DTE = "Si" WHERE nro_dte = '.$row["nro_dte"];
    }else{
        $sql = 'UPDATE sl_dte SET observacion = "'.$_POST['obs'.$row["nro_dte"]].'" ,acepta_compra_DTE = "No", monto_financiado = 0 WHERE nro_dte = '.$row["nro_dte"];
    }
    mysqli_query($conn,$sql);
} */

while ($row = mysqli_fetch_assoc($response)) {
    $sql = 'UPDATE sl_grand_table SET monto_financiado_dte ='.$_POST['DTE'.$row["folio"]].', diferencia_precio_dte ='.$_POST['difPre'.$row["folio"]].', gasto_comision_dte ='.$_POST['gasCom'.$row["folio"]].', monto_iva_dte ='.$_POST['monIVA'.$row["folio"]].', costo_finan_dte ='.$_POST['costFin'.$row["folio"]].', aceptar_compra_dte ='.$_POST['compra'.$row["folio"]].', WHERE nro_operacion = '.$nOperacion.' AND folio ='.$row["folio"];
    mysqli_query($conn,$sql);
    
    echo $sql;
}

/* $sql = 'UPDATE sl_grand_table  SET monto_financiado =[value-6], diferencia_precio =[value-7], gasto_comision =[value-8], monto_iva =[value-9], costo_finan =[value-10], monto_liquido =[value-11], fecha_vencimiento =[value-12], observacion =[value-13], nro_dte =[value-14], rut_receptor =[value-15], tipo_dte =[value-16], folio =[value-17], fecha_emision =[value-18], fecha_pago =[value-19], monto_neto =[value-20], monto_exento =[value-21], monto_total =[value-22], monto_financiado_dte =[value-23], diferencia_precio_dte =[value-24], gasto_comision_dte =[value-25], monto_iva_dte =[value-26], costo_finan_dte =[value-27], aceptar_compra_dte =[value-28], observacion_dte =[value-29] WHERE nro_operacion = '.$nOperacion.' AND folio ='.$row["folio"]; */
?>