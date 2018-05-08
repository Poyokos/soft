<?php 
include('connection.php');
?>

<meta http-equiv =”Cache-Control” content ="no-cache"/>
<meta http-equiv="expires" content="0">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Pragma" CONTENT="no-cache">


<!DOCTYPE html>
<html>


    <head>
        <meta charset="UTF-8">
        <title>Operaciones de Softland</title>
        
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  -->
        <script src="js/main.js"></script>
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    </head>
    <body>
                
        <form name="form_fc" action="cotizacionEstado.php" method="POST">
            <table border="solid">
                <thead>
                    <tr>
                    <td>
                            <input type="hidden" name="nOperacion" value="3213"/> 
                            <center><h2>N°Operacion - Rut de la empresa</h2></center>
                            <center><h2>Estado</h2></center>
                            <!-- <center>
                                <label class="radio-inline">
                                    <input type="radio" name="optradio" id="estadoAceptar" checked>Aceptar
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="optradio" id="estadoRechazar" >Rechazar
                                </label>
                            </center>
                            </br>
                            <center><input type="submit" id="enviarForm" onClick="alertaEnvio()" value="Enviar Estado Cotizacion"/></center> -->
                            <button id="btnPrueba">Prueba</button>
                    </td>
                    </tr>       
                </thead>
            </table>
            <table border="solid">
                
                <?php
                $sql =  "SELECT SUM(monto_total) FROM sl_grand_table WHERE n_operacion = 3213";
                $response = mysqli_query($conn,$sql);
                while ($row = mysqli_fetch_assoc($response)) {
                    $totalCot = $row["SUM(monto_total)"];
                }
                ?>

                <tr>
                    <td>Monto total de la Operación:</td>
                    <td><input type="text"   name="monTotalCot" id="monTotalCot" value="<?php echo $totalCot?>" readOnly/></td>
                </tr>
                
                <tr>
                    <td># Monto Financiado:</td>
                    <td><input type="text"  name="monFin" id="monFin" readOnly/>Monto financiado por Factoring</td>
                </tr>
                <tr>
                    <td>? Diferencia de Precio:</td>
                    <td><input type="text" onKeyPress="return soloNumeros(event)"  onkeyup="montLiquid()"  name="difPrecio" id="difPrecio" readOnly/></td>
                </tr>
                
                <tr>
                    <td align="left">* Gastos y Comisiones:</td>
                    <td><input type="text" onKeyPress="return soloNumeros(event)"  onkeyup="montLiquid()" name="gastoCom" id="gastoCom" readOnly/></td>
                </tr>

                <tr>
                    <td align="left">* Monto de IVA:</td>
                    <td><input type="text" onKeyPress="return soloNumeros(event)"  onkeyup="montLiquid()" name="montoIVA" id="montoIVA" readOnly/>Monto IVA por concepto de operacion</td>
                </tr>

                <tr>
                    <td align="left">* Costo Financiero:</td>
                    <td><input type="text" onKeyPress="return soloNumeros(event)"  onkeyup="montLiquid()" name="costoFinan" id="costoFinan" readOnly/>Costo financiero incurrido por factoring para la operacion</td>
                </tr>
                 
                <tr>
                    <td align="left">Monto Liquido:</td>
                    <td><input type="text"  name="montLiquido" id="montLiquido" placeholder="Monto a girar" readOnly/></td>
                </tr>

                <tr>
                    <td align="left">? Fecha de vencimiento:</td>
                    <td><input type="text"  name="datepicker" id="datepicker" /></td>
                </tr>

                <tr>
                    <td align="right"><input type="submit" id="btnSubmit" name="btnSubmit" value="Guardar Simulacion"/></td>
                </tr>
                    
            </table>

            <div id="resp">
            <center><h2>DTE</h2></center>
        </div>
        <!-- Tabla por cada rut de receptor -->
        <?php 
        $sql = "SELECT DISTINCT rut_receptor from sl_grand_table WHERE n_operacion = 3213";
        $c = 0;
        $response = mysqli_query($conn,$sql);
        $rutEmpresas = [];
        while ($row = mysqli_fetch_assoc($response)) {
            $rutEmpresas[$c] = $row["rut_receptor"];
            $c++;
        }
        ?>

        <?php for ($i=0; $i < count($rutEmpresas); $i++) { ?>
            <table border="solid">
        </tr>
                <th># N°DTE</th>
                <th># Tipo DTE</th>
                <th># Folio</th>              
                <th># Fecha de Emision</th>
                <th># Fecha de Pago</th>
                <th># Monto Total</th>
                <th>¿Aceptar compra?</th>
                <th>Observacion</th>
                <!-- <th># Monto Retenido</th>
                <th>* Monto A Financiar</th>
                <th>Diferencia de Precio</th>
                <th>Gastos Y Comisiones</th>
                <th>Monto de IVA</th>
                <th>Dias</th>
                <th>Costo Financiero</th> -->
            <?php
                $sql = 'SELECT * FROM sl_grand_table WHERE n_operacion = 3213 and rut_receptor= \''.$rutEmpresas[$i].'\'';
                $response = mysqli_query($conn,$sql);
                echo "</br>";
                echo '<center><p>'.$rutEmpresas[$i].'</p></center>';
                if (mysqli_num_rows($response) > 0) {
                    while ($row = mysqli_fetch_assoc($response)) {
                        echo '<tr>
                        <td>'.$row["nro_dte"].'</td>
                        <td>'.$row["tipo_dte"].'</td>
                        <td>'.$row["folio"].'</td>                    
                        <td>'.$row["fecha_emision"].'</td>
                        <td>'.$row["fecha_pago"].'</td>
                        <td><input class="montoTotal" name="'.str_replace(".","",$rutEmpresas[$i]).'" id="'.$row["folio"].'" value="'.$row["monto_total"].'" readOnly/></td>
                        <td>
                        <label class="radio-inline">
                        <input type="radio" id="compraSi'.$row["folio"].'" onclick="enabl('.$row["folio"].','.$row["monto_total"].')" name="compra'.$row["folio"].'" value="Si" checked>SI
                        </label>
                        <label class="radio-inline" id="radioCompraNo">
                        <input type="radio" id="compraNo'.$row["folio"].'" onclick="disabl('.$row["folio"].')" name="compra'.$row["folio"].'" value="No">NO
                        </label>
                        </td>
                        <td><textarea name="obs'.$row["folio"].'" id="obs'.$row["folio"].'" cols="20" rows="3" disabled></textarea></td>';
                        /* <td>'.$row["monto_total"]*((100-$parametro["Retencion"])/100).'</td>
                        <td>'.$row["monto_total"]*($parametro["Retencion"]/100).'</td>                        
                        <input type="hidden" name="DTE'.$row["folio"].'" id="DTE'.$row["folio"].'" value="'.$row["monto_total"].'"/>
                        <td><input type="text" name="difPre'.$row["folio"].'" id="difPre'.$row["folio"].'" value="'.$row["diferencia_precio_dte"].'"/></td>
                        <td><input type="text" name="gasCom'.$row["folio"].'" id="gasCom'.$row["folio"].'" value="'.$parametro["Comision"]*$row["monto_total"]*($parametro["Dias"]/30).'"/></td>
                        <td><input type="text" name="monIVA'.$row["folio"].'" id="monIVA'.$row["folio"].'" value="'.$row["monto_iva_dte"].'"/></td>
                        <td><input type="text"/></td>
                        <td><input type="text" name="costFin'.$row["folio"].'" id="costFin'.$row["folio"].'" value="'.$row["costo_finan_dte"].'"/></td>
                        </tr>'; */
                    }
                    echo '</br>';
                }
            ?>

            <!-- <?php
            $sql = "Select * from sl_parametro_sistema";
            $th = mysqli_query($conn,$sql);
            $test = mysqli_query($conn,$sql);
            $tr = mysqli_query($conn,$sql);
            /* echo '<th>Rut Receptor + Nombre Receptor</th>';  */
            while ($row = mysqli_fetch_assoc($th)) {
                echo '<th>'.$row["parametro"].'</th>';
            }
            echo "<tr>";
            /* echo '<td>'.$rutEmpresas[$i].'</td>'; */
    
            $param = [];
            $valor = [];
            $f = 0;
    
            while ($row = mysqli_fetch_assoc($test)) {
                $valor[$f] = $row["valor"];
                $param[$f] = $row["parametro"];
                $f++;
            }
    
            //var_dump($arr[3]);
    
            $sql = 'Select * from sl_parametro_empresa where rut_empresa = \''.$rutEmpresas[$i].'\'';
            $emp = mysqli_query($conn,$sql);
              
            /* var_dump($emp); */
            /* if (mysqli_num_rows($emp) != 0) {
                $a = 0;
                while ($row = mysqli_fetch_assoc($emp)) {
                    echo '<td><input class="param" type="text" name="'."parametros".$i.'" id="'.$row["parametro"].'" value="'.$row["valor"].'" /></td>';
                    $a++;
                }
    
                for ($x=$a; $x <count($param) ; $x++) { 
                    echo '<td><input class="param" type="text" name="'."parametros".$i.'" id="'.$param[$x].'" value="'.$valor[$x].'" /></td>';
                }
    
            }else{
                while ($row = mysqli_fetch_assoc($tr)) {
                    echo '<td><input class="param" type="text" name="'."parametros".$i.'" id="'.$row["parametro"].'" value="'.$row["valor"].'" /></td>';
                }
            } */
            $parametro = [];
            if (mysqli_num_rows($emp) != 0) {
                $a = 0;
                while ($row = mysqli_fetch_assoc($emp)) {
                    echo '<td><input class="param" type="text" name="'."parametros".$i.'" id="'.$row["parametro"].'" value="'.$row["valor"].'" /></td>';
                    $parametro[$row["parametro"]]=$row["valor"];
                    $a++;
                }
    
                for ($x=$a; $x <count($param) ; $x++) { 
                    echo '<td><input class="param" type="text" name="'."parametros".$i.'" id="'.$param[$x].'" value="'.$valor[$x].'" /></td>';
                }
    
                //var_dump($parametro);
            }else{
                while ($row = mysqli_fetch_assoc($tr)) {
                    echo '<td><input class="param" type="text" name="'."parametros".$i.'" id="'.$row["parametro"].'" value="'.$row["valor"].'" /></td>';
                    $parametro[$row["parametro"]]=$row["valor"];
                    
                }
                //var_dump($parametro);
            }
    
           /*  while ($row = mysqli_fetch_assoc($tr)) {
                echo '<td><input class="param" type="text" name="'."parametros".$i.'" id="'.$row["parametro"].'" value="'.$row["valor"].'" /></td>';
            } */
    
            /* echo '<td><input type="button" id="'.$rutEmpresas[$i].'" name="'.$rutEmpresas[$i].'" value="Modificar Parametros" onclick="guardarParam(\''.$rutEmpresas[$i].'\')"/></td>'; */
            echo '<input type="hidden" id="rutEmpresa'.$i.'" value="'.$rutEmpresas[$i].'"/>';
        echo '<td><center><input type="button" class="btnModificarParam" id="'.$i.'" name="'.$i.'" value="Simular" /></center></td>';
        echo "</tr>";
            ?>            -->
        </table>
        <table border="solid">
        <!-- <th><center>Simulacion</center></th> -->
            <tr>
            <td colspan="2"><center>Simulacion</center></td>
            </tr>

            <tr>
            <td>Monto Bruto</td>
            <?php
            echo '<td><input class="mntBruto" name="mntBruto'.$rutEmpresas[$i].'" id="mntBruto'.str_replace(".","",$rutEmpresas[$i]).'" value="" readOnly/></td>';
            ?>
            </tr>

            <!-- <tr>
            <td>Anticipo</td>
            <?php
            echo '<td><input name="mntBruto'.$rutEmpresas[$i].'" id="mntBruto'.$rutEmpresas[$i].'" value=""/></td>';
            ?>
            </tr>

            <tr>
            <td>Monto Retenido</td>
            <?php
            echo '<td><input name="mntBruto'.$rutEmpresas[$i].'" id="mntBruto'.$rutEmpresas[$i].'" value=""/></td>';
            ?>
            </tr>

            <tr>
            <td>Monto A Financiar</td>
            <?php
            echo '<td><input name="mntBruto'.$rutEmpresas[$i].'" id="mntBruto'.$rutEmpresas[$i].'" value=""/></td>';
            ?>
            </tr>

            <tr>
            <td>Gasto Legal / Notaria / Notificación</td>
            <?php
            echo '<td><input name="mntBruto'.$rutEmpresas[$i].'" id="mntBruto'.$rutEmpresas[$i].'" value=""/></td>';
            ?>
            </tr>
            
            <tr>
            <td>Comisión RC</td>
            <?php
            echo '<td><input name="mntBruto'.$rutEmpresas[$i].'" id="mntBruto'.$rutEmpresas[$i].'" value=""/></td>';
            ?>
            </tr>

            <tr>
            <td>Gastos Operacion</td>
            <?php
            echo '<td><input name="mntBruto'.$rutEmpresas[$i].'" id="mntBruto'.$rutEmpresas[$i].'" value=""/></td>';
            ?>
            </tr>

            <tr>
            <td>IVA</td>
            <?php
            echo '<td><input name="mntBruto'.$rutEmpresas[$i].'" id="mntBruto'.$rutEmpresas[$i].'" value=""/></td>';
            ?>
            </tr>

            <tr>
            <td>Dias</td>
            <?php
            echo '<td><input name="mntBruto'.$rutEmpresas[$i].'" id="mntBruto'.$rutEmpresas[$i].'" value=""/></td>';
            ?>
            </tr>

            <tr>
            <td>Tasa Interes Mensual</td>
            <?php
            echo '<td><input name="mntBruto'.$rutEmpresas[$i].'" id="mntBruto'.$rutEmpresas[$i].'" value=""/></td>';
            ?>
            </tr>

            <tr>
            <td>Interes</td>
            <?php
            echo '<td><input name="mntBruto'.$rutEmpresas[$i].'" id="mntBruto'.$rutEmpresas[$i].'" value=""/></td>';
            ?>
            </tr>

            <tr>
            <td>Monto Liquido</td>
            <?php
            echo '<td><input name="mntBruto'.$rutEmpresas[$i].'" id="mntBruto'.$rutEmpresas[$i].'" value=""/></td>';
            ?>
            </tr> -->
            
            <td colspan="2"><center><button>Simular</button></center></td>

           

        </table>
        <?php } ?>
        <!-- Tabla por cada rut de receptor -->
        </form>
       <!-- HERE IS GONNA BE THE NEW DRAG N DROP IDEA -->
          
    </body>
</html>



