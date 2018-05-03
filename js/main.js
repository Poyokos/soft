$(document).ready(function() {
    montLiquid();
    calcularCotizaccion();
    /* $("#trObs").hide(); */
    $("#difPrecio, #gastoCom, #montoIVA, #costoFinan").on("keyup", function() {
        montLiquid();
    });

    $("#btnSubmit").click(function(){
        alert("Simulacion guardada");
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

function guardarValor(id){
    var valor = document.getElementById('finan'+id).value;
    document.getElementById('DTE'+id).value = valor;
}
        
/* tot = tot.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
    tot = tot.split('').reverse().join('').replace(/^[\.]/, ''); */

function calcularCotizaccion(){
    var arr = document.getElementsByName('monto_financiado');
    var id=0;
    for(var i=0;i<arr.length;i++){
        id = arr[i].className;
        arr[i].className
    }

    /* var com = document.getElementById('difPrecio').value;
    var gas = document.getElementById('gastoCom').value;
    var mont = document.getElementById('montoIVA').value;
    var cost = document.getElementById('costoFinan').value;
    
    total = Number(tot) - (Number(com)+Number(gas)+Number(mont)+Number(cost));

    document.getElementById('monFin').value = tot;
    document.getElementById('montLiquido').value = total; */           
}


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
}