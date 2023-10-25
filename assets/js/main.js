function iniciarSesion(){

    let correo=document.getElementById("idCorreo").value;
    let contrasena=document.getElementById("idContrasena").value;
    let datos={
        "correo":correo,
        "contrasena":contrasena
    };

    $.ajax({
        url: "assets/php/iniciarSesion.php",
        type: "post",
        data: datos,
        success: function(response){
            console.log(response);
        if(response=='correcto'){
            location.replace("menu.php");
        }
        else{
            $("#result").html("Error, correo o contraseña incorrecto");

            setTimeout(()=>{
                document.getElementById("result").innerHTML="";
            },6000);
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
    console.log(textStatus, errorThrown);
    $("#result").html("Error al realizar el cálculo");
    }
    });
      
}

function verificarCedula(){

    let cedula=document.getElementById("idCedula").value;
    let nombre=document.getElementById("idNombre");
    let apellido=document.getElementById("idApellido");
    let telefono=document.getElementById("idTelefono");
    let direccion=document.getElementById("idDireccion");

    let dato={"cedula":cedula};

    $.ajax({
        url: "assets/php/buscarCedula.php",
        type: "get",
        dataType:"json",
        data: dato,
        success: function(response){
        if(response!='efe'){
            document.getElementById("idNombre").value= response.nombre;
            nombre.disabled = true;
            document.getElementById("idApellido").value= response.apellido;
            apellido.disabled = true;
            document.getElementById("idTelefono").value= response.telefono;
            telefono.disabled = true;
            document.getElementById("idDireccion").value= response.direccion;
            direccion.disabled = true;
            
        }else{
            document.getElementById("idNombre").value= "";
            nombre.disabled = false;
            document.getElementById("idApellido").value= "";
            apellido.disabled = false;
            document.getElementById("idTelefono").value= "";
            telefono.disabled = false;
            document.getElementById("idDireccion").value= "";
            direccion.disabled = false;

        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
    console.log(textStatus, errorThrown);
    $("#result").html("Error al realizar el cálculo");
    }
    });
}


function registrarCompra(){

    let cedula=document.getElementById("idCedula").value;
    let nombre=document.getElementById("idNombre").value;
    let apellido=document.getElementById("idApellido").value;
    let telefono=document.getElementById("idTelefono").value;
    let direccion=document.getElementById("idDireccion").value;

    let precio=document.getElementById("idPrecio").value;
    let cantidad=document.getElementById("idCantidad").value;
    
    let datos={
        "cedula":cedula,
        "nombre":nombre,
        "apellido":apellido,
        "telefono":telefono,
        "direccion":direccion,
        "precio":precio,
        "cantidad":cantidad
    };

    $.ajax({
        url: "assets/php/crearCompra.php",
        type: "post",
        dataType:"json",
        data: datos,
        success: function(response){
        if(response.respuesta=='Compra guardada con exito'){
            document.getElementById("result").style.color="green";
            $("#result").html(response.respuesta);

            let formulario = document.getElementById('idFormulario');
            formulario.reset();
            document.getElementById("idTotal").innerHTML="TOTAL 0 $";

            setTimeout(()=>{
                document.getElementById("result").innerHTML="";
            },4000);
            
        }
        else{
            document.getElementById("result").style.color="red";
            $("#result").html(response.respuesta);

            setTimeout(()=>{
                document.getElementById("result").innerHTML="";
            },6000);
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
    console.log(textStatus, errorThrown);
    $("#result").html("Error al realizar el cálculo");
    }
    });
      
}

function selectReporte(){

    let tReporte=document.getElementById("idReporte").value;
    // let filtro=document.getElementById("idFiltro").value;
    // let buscar=document.getElementById("idBusqueda").value;

    // if()

    

    $.ajax({
        url: "assets/php/tablas.php",
        type: "get",
        data: {"tabla":tReporte},
        success: function(response){
        if(response=='correcto'){
            
        }
        else{
          
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
    console.log(textStatus, errorThrown);
    $("#result").html("Error al realizar el cálculo");
    }
    });
      
}

function total(){
    let precio=document.getElementById("idPrecio").value;
    let cantidad=document.getElementById("idCantidad").value;
    let total=precio*cantidad;

    if(total>0){
        document.getElementById("idTotal").innerHTML="TOTAL "+parseFloat(total).toFixed(2)+"$";
    }else{
        document.getElementById("idTotal").innerHTML="TOTAL 0 $";
    }
}

function borrarFormularioCompra(){

    let nombre=document.getElementById("idNombre");
    let apellido=document.getElementById("idApellido");
    let telefono=document.getElementById("idTelefono");
    let direccion=document.getElementById("idDireccion");

    nombre.disabled = false;
    apellido.disabled = false;
    telefono.disabled = false;
    direccion.disabled = false;

    let formulario=document.getElementById("idFormulario");
    formulario.reset();

    document.getElementById("idTotal").innerHTML="TOTAL 0 $";
}

function cambioSucursal(){

    let sucursal=document.getElementById("selectSucursal").value;
    let dato={
        "sucursal":sucursal
    }

    $.ajax({
        url: "assets/php/cambioSucursal.php",
        type: "get",
        dataType:"json",
        data: dato,
        success: function(response){
            if(response.resultado=="ok"){  
                $('#staticBackdrop').modal('hide');

            } 
    },
    error: function(jqXHR, textStatus, errorThrown) {
    console.log(textStatus, errorThrown);
    
    }
    });
}

