<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="./css/principal.css">
        <script src="./js/jquery.min.js"></script>
</head>


<body>
    <h1>Poner algo chido xd
    </h1>

    <div class="car-section">
        <h2>Autos Disponibles</h2>
        <div class="container">
            <div class="car">
                <img src="carros/car1.jpg" alt="Carro 1">
                <h3>Corolla</h3>
                <p>Toyota
                    Sedan
                    2022</p>
                <p>Precio por hora: $50.00</p>
                <p>Carro 1</p>
            </div>
            <div class="car">
                <img src="carros/car2.jpg" alt="Carro 2">
                <h3>Civic</h3>
                <p>Honda
                    Sedán
                    2021</p>
                <p>Precio por hora: $55.00</p>
                <p>Carro 2</p>
            </div>
            <div class="car">
                <img src="carros/car3.jpg" alt="Carro 3">
                <h3>Escape</h3>
                <p>Ford
                    2020
                    SUV</p>
                <p>Precio por hora: $70.00</p>
                <p>Carro 3</p>
            </div>
            <div class="car">
                <img src="carros/car4.jpg" alt="Carro 4">
                <h3>Spark</h3>
                <p>Chevrolet
                    2023
                    Compacto</p>
                <p>Precio por hora: $40.00</p>
                <p>Carro 4</p>
            </div>
            <div class="car">
                <img src="carros/car5.jpg" alt="Carro 5">
                <h3>Wrangler</h3>
                <p>Jeep
                    2021
                    SUV</p>
                <p>Precio por hora: $90.00</p>
                <p>Carro 5</p>
            </div>
           
        </div>
    </div>

    <h2>Reserva carro para ${$_SESSION["id_cliente"]=$id_cliente;}</h2>
    <div class="container">
        <form id="formulario-Registro"  autocomplete="off">
            <table id="customerTable">
                <tr>
                    <th>Carro</th>
                    <td><select name="id_auto" id="id_auto">
                    
                     </select>
                    </td>
                </tr>                
                <tr>
                    <th>Recoleccion</th>
                    <td><input type="text" id="recoleccion" name="recoleccion" class="customerName" placeholder="Direccion de donde se recogera" required></td>
                </tr>
                <tr>
                    <th>Devolucion</th>
                    <td><input type="text" id="correo" name="correo" class="customerLastName" placeholder="Direcion de la devolucion" required></td>
                </tr>
                <tr>
                    <th>Inicio de la reservacion</th>
                    <td><input type="date" id="fecha_inicio" name="fecha_inicio" required></td>
                </tr>
                <tr>
                    <th>Fin de la resercacion</th>
                    <td><input type="date" id="fecha_fin" name="fecha_fin" required></td>
                </tr>
            </table>
            
            <div style="text-align: center;">
            <button type="button" class="btn btnAdd"  id="Agregar">Reservar</button>
                <button type="button" class="btn btnClean" id="Limpiar" >Nueva</button>
                <button type="button" class="btn btnEdit" id="Editar" >Editar</button>
                <button type="button" class="btn btnDelete" id="Eliminar">Eliminar</button>
            </div>
            <div>
                <i class="fa-solid fa-arrow-left flechas"></i>
                <i class="fa-solid fa-arrow-right flechas"></i>
            </div>
        </form>
    </div>
    
    <form id="logout-form" action="logout.php" method="POST">
        <button type="submit" class="logout-button">Cerrar sesión</button>
    </form>
</body>
</html>

<script type="text/javascript">

$(document).ready(function(){

 var currentIndex = 0;
 var registros = []; // Aquí almacenaremos los datos de los registros

  // Cargar los registros al cargar la página
  cargarRegistros();

 // Función para cargar los registros desde la base de datos o donde los tengas almacenados
 function cargarRegistros() {
  // Aquí debes cargar los registros desde la base de datos o donde los tengas almacenados
  // Esto es solo un ejemplo
  $.ajax({
    url:  '../back/db.php',
    type: 'POST',
    dataType: 'json',
    data: {
            Modulo: "Consultar"
    },
    success: function(data) {
     registros = data;
     cargarRegistro(currentIndex);
    } 
  }); 
}

 // Función para cargar los datos de los registros
 function cargarRegistro(index) {
   var registro = registros[index];
   console.log(registro);
   $('#id_auto').val(registro.id_auto);
   $('#recoleccion').val(registro.recolecion);
   $('#devolucion').val(registro.devolucion);
   $('#fecha_inicio').val(registro.fecha_inicio);
   $('#fecha_fin').val(registro.fecha_fin);
 
 }



// Evento click para la flecha izquierda (anterior)
 $('.fa-arrow-left').click(function() {
    console.log(currentIndex);
    if (currentIndex > 0) {
       currentIndex--;
       cargarRegistro(currentIndex);
   }
 });

 // Evento click para la flecha derecha (siguiente)
 $('.fa-arrow-right').click(function() {
    console.log(currentIndex);
   if (currentIndex < registros.length - 1) {
      currentIndex++;
      cargarRegistro(currentIndex);
   }
 });

//Funcion para limpiar los campos por medio del formulario
 $('#Limpiar').click(function(){
   $('#formulario-Registro')[0].reset();
 });

 $('#id_cliente').click(function(){
 var id = '';

     $.ajax({
         url:  '../back/db.php',
         type: 'POST',
         dataType: 'json',
         data : { id : id ,
            Modulo: 'clientes'
         },
         success: function(data) {
            text='';
            var registros = eval(data);
            for (var i = 0; i < registros.length; i++) {
            text += '<option value ="'+registros[i].id + '">' + registros[i].nombre +'</option>';
        }
        $("#id_cliente").html(text);
                   
         }
     });       
});

 
// Fuincion para concatenar los autos
 $('#id_auto').click(function(){
 var id = '';

     $.ajax({
         url:  '../back/db.php',
         type: 'POST',
         dataType: 'json',
         data : { id : id ,
            Modulo: 'autos'
         },
         success: function(data) {
            text='';
            var registros = eval(data);
            for (var i = 0; i < registros.length; i++) {
            text += '<option value ="'+registros[i].id + '">' + registros[i].marca +'</option>';
        }
        $("#id_auto").html(text);
                   
         }
     });       
});
//Funcion para Agregar la Información
 $('#Agregar').click(function(){

   if ($('#id_auto').val()  === '' || $('#recoleccion').val() === '' || $('#devolucion').val()  === '' || $('#fecha_inicio').val()  === '' || $('#fecha_fin').val()  === '' ) {
      alert('Por favor, complete todos los campos excepto ID');
      return false;
   }

     var data = $("#formulario-Registro").serializeArray(); // convert form to array

      data.push({
        name: "Modulo",
        value: "Guardar"
      });
        $.ajax({
            url:  '../back/db.php',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(data) {
              alert(data);
              location.reload();
            }
        });       
 });

//Funcion para Agregar la Información
 $('#Editar').click(function(){
   if ($('#id_auto').val()  === '' || $('#recoleccion').val() === '' || $('#devolucion').val()  === '' || $('#fecha_inicio').val()  === '' || $('#fecha_fin').val()  === '' ) {
      alert('Por favor, complete todos los campos excepto ID');
      return false;
   }

     var data = $("#formulario-Registro").serializeArray(); // convert form to array

      data.push({
        name: "Modulo",
        value: "Editar"
      });
        $.ajax({
            url:  '../back/db.php',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(data) {
              alert(data);
              location.reload();
            }
        });       
 });
   
//Funcion para Agregar la Información
 $('#Eliminar').click(function(){
     var data = $("#formulario-Registro").serializeArray(); // convert form to array

      data.push({
        name: "Modulo",
        value: "Eliminar"
      });
        $.ajax({
            url:  '../back/db.php',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(data) {
              alert(data);
              location.reload();
            }
        });       
 });

});

 
</script> 