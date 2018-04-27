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
        <script type="text/javascript">

            $(document).ready(function() {
                montLiquid();
                /* $("#trObs").hide(); */
                $("#difPrecio, #gastoCom, #montoIVA, #costoFinan").on("keyup", function() {
                    montLiquid();
                });
                
                $("#estadoRechazar").click(function(){
                    $(":text, #fechaVen, :radio").prop("disabled",true);
                    $("#estadoAceptar").prop("disabled",false);
                    $("#estadoRechazar").prop("disabled",false);
                    $("#trObs").show();
                })

                $("#estadoAceptar").click(function(){
                    $(":text, #fechaVen, :radio").prop("disabled",false);
                    $("#estadoAceptar").prop("disabled",false);
                    $("#estadoRechazar").prop("disabled",false);
                    $("#trObs").hide();
                })
                
                $('.btnModificarParam').click(function(){
                var valores = [];
                var llaves = [];
                var id = $(this).attr('id');
                var element = document.getElementsByName('parametros'+id);
                var rut = $("#rutEmpresa"+id).val();
                for(var i=0;i<element.length;i++){
                    valores.push(element[i].value);
                    llaves.push(element[i].id);
                }
                /* for(var i=0;i<element.length;i++){
                    arr[element[i].id] = element[i].value;
                } */
                //console.log(arr);
                //var jsonString = JSON.stringify(arr);
                //console.log(jsonString);
                //console.log(jsonString);
                /* var id = $(this).attr('id');
                var rut = $("#rutEmpresa"+id).val();
                var p1 = $("#param1"+id).val();
                var p2 = $("#param2"+id).val();
                var p3 = $("#param3"+id).val();
                var p4 = $("#param4"+id).val(); */
                $.ajax({
                url: 'modParam.php',
                type: 'POST',
                data: {
                    'rut': rut,
                    'value': valores,
                    'key': llaves
                },
                success: function(response){
                    alert(response);
                    location.reload();
                }
                });
                });
                
            });

            function guardarParam(){
                
            }

            function guardarValor(id){
                var valor = document.getElementById('finan'+id).value;
                document.getElementById('DTE'+id).value = valor;
            }
                    
            /* tot = tot.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
                tot = tot.split('').reverse().join('').replace(/^[\.]/, ''); */
            
            function montLiquid(){
                var arr = document.getElementsByName('monto_financiado');
                var tot=0;
                for(var i=0;i<arr.length;i++){
                    if(parseInt(arr[i].value))
                        tot += parseInt(arr[i].value);
                }

                var com = document.getElementById('difPrecio').value;
                var gas = document.getElementById('gastoCom').value;
                var mont = document.getElementById('montoIVA').value;
                var cost = document.getElementById('costoFinan').value;
                
                total = Number(tot) - (Number(com)+Number(gas)+Number(mont)+Number(cost));

                document.getElementById('monFin').value = tot;
                document.getElementById('montLiquido').value = total;           
            }
            

            function disabl(valor){
                var value = valor;
                document.getElementById('finan'+valor).value = "";
                document.getElementById('obs'+valor).disabled = false;
                document.getElementById('finan'+valor).disabled = true;
                montLiquid();
            }

            function enabl(valor,monto){
                var value = valor;
                document.getElementById('obs'+valor).value = "";
                document.getElementById('obs'+valor).disabled = true;
                document.getElementById('finan'+valor).disabled = false;
                document.getElementById('finan'+valor).value = monto;
                montLiquid();
            }
            
            function soloNumeros(e){
                var key = window.Event ? e.which : e.keyCode
                return (key >= 48 && key <= 57)
            }
            
            function maximo(input,max){
                var valor = document.getElementById('finan'+input).value;
                var tope = max;
                if (valor > tope) {
                    alert("El valor a financiar no puede ser mayor al monto total");
                    var tam = valor.length;
                    valor = valor.substr(0,valor.length-1);
                    document.getElementById('finan'+input).value = valor;
                }
                /* var key = window.Event ? e.which : e.keyCode
                return (key >= 48 && key <= 57) */
            }

         </script>
           <style>  
           .file_drag_area  
           {  
                width:400px;  
                height:100px;  
                border:2px dashed #ccc;  
                line-height:100px;  
                text-align:center;  
                font-size:24px;  
           }  
           .file_drag_over{  
                color:#000;  
                border-color:#000;  
           }  
           
           table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even){background-color: #f2f2f2 }

            th {
                background-color: #CD7F1A ;
                color: white;
            }
            
            #divDnD{
                display:none;
            }

            input[type=text]{
                width: 150px;
            }

            .param{
                width: 20px;
            }

            textarea {
                resize: none;
            }
            
           </style>  
           

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
                    <td align="right"><input type="submit" value="Guardar Simulacion"/></td>
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
        <?php
        $sql = "Select * from sl_parametro_sistema";
        $th = mysqli_query($conn,$sql);
        $test = mysqli_query($conn,$sql);
        $tr = mysqli_query($conn,$sql);
        echo '<th>Rut Receptor</th>'; 
        while ($row = mysqli_fetch_assoc($th)) {
            echo '<th>'.$row["parametro"].'</th>';
        }
        echo "<tr>";
        echo '<td>'.$rutEmpresas[$i].'</td>';

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
        if (mysqli_num_rows($emp) != 0) {
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
        }

       /*  while ($row = mysqli_fetch_assoc($tr)) {
            echo '<td><input class="param" type="text" name="'."parametros".$i.'" id="'.$row["parametro"].'" value="'.$row["valor"].'" /></td>';
        } */

        /* echo '<td><input type="button" id="'.$rutEmpresas[$i].'" name="'.$rutEmpresas[$i].'" value="Modificar Parametros" onclick="guardarParam(\''.$rutEmpresas[$i].'\')"/></td>'; */
        echo '<input type="hidden" id="rutEmpresa'.$i.'" value="'.$rutEmpresas[$i].'"/>';
        echo '<td><input type="button" class="btnModificarParam" id="'.$i.'" name="'.$i.'" value="Modificar Parametros" /></td>';
        echo "</tr>";
        ?>
        </tr>
            
                <th># N°DTE</th>
                <th># Tipo DTE</th>
                <th># Folio</th>
                
                <th># Fecha de Emision</th>
                <th># Fecha de Pago</th>
                <th># Monto Neto</th>
                <th># Monto Exento</th>
                <th># Monto Total</th>
                <th># Monto Retenido</th>
                <th># Monto Bruto</th>
                <th>* Monto Financiado</th>
                <th>¿Aceptar compra?</th>
                
                <th>Observacion</th>
                
                <th>Diferencia de Precio</th>
                <th>Gastos Y Comisiones</th>
                <th>Monto de IVA</th>
                <th>Costo Financiero</th>
                
            
            <?php
                $sql = 'SELECT * FROM sl_grand_table WHERE n_operacion = 3213 and rut_receptor= \''.$rutEmpresas[$i].'\'';
                $response = mysqli_query($conn,$sql);
                if (mysqli_num_rows($response) > 0) {
                    while ($row = mysqli_fetch_assoc($response)) {
                        echo '<tr>
                        <td>'.$row["nro_dte"].'</td>
                        <td>'.$row["tipo_dte"].'</td>
                        <td>'.$row["folio"].'</td>
                        
                        <td>'.$row["fecha_emision"].'</td>
                        <td>'.$row["fecha_pago"].'</td>
                        <td>'.$row["monto_neto"].'</td>
                        <td>'.$row["monto_exento"].'</td>
                        <td>'.$row["monto_total"].'</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td><input type="text" oninput="return maximo('.$row["folio"].','.$row["monto_total"].')" onKeyPress="return soloNumeros(event)" onChange="guardarValor('.$row["folio"].')" onKeyUp="montLiquid()" id="finan'.$row["folio"].'" name="monto_financiado" value="'.$row["monto_total"].'" style="width: 140;"></td>
                        <td>
                        <label class="radio-inline">
                        <input type="radio" id="compraSi'.$row["folio"].'" onclick="enabl('.$row["folio"].','.$row["monto_total"].')" name="compra'.$row["folio"].'" value="Si" checked>SI
                        </label>
                        <label class="radio-inline" id="radioCompraNo">
                        <input type="radio" id="compraNo'.$row["folio"].'" onclick="disabl('.$row["folio"].')" name="compra'.$row["folio"].'" value="No">NO
                        </label>
                        </td>
                        <td><textarea name="obs'.$row["folio"].'" id="obs'.$row["folio"].'" cols="20" rows="3" disabled></textarea></td>
                        <input type="hidden" name="DTE'.$row["folio"].'" id="DTE'.$row["folio"].'" value="'.$row["monto_total"].'"/>
                        <td><input type="text" name="difPre'.$row["folio"].'" id="difPre'.$row["folio"].'" /></td>
                        <td><input type="text" name="gasCom'.$row["folio"].'" id="gasCom'.$row["folio"].'" /></td>
                        <td><input type="text" name="monIVA'.$row["folio"].'" id="monIVA'.$row["folio"].'" /></td>
                        <td><input type="text" name="costFin'.$row["folio"].'" id="costFin'.$row["folio"].'" /></td>
                        </tr>';
                    }
                    echo '</br>';
                }
            ?>           
        </table>
        <?php } ?>
        <!-- Tabla por cada rut de receptor -->
        </form>
       <!-- HERE IS GONNA BE THE NEW DRAG N DROP IDEA -->
          
    </body>
</html>



