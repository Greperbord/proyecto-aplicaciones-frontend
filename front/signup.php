<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="./css/signup.css">
        <script src="./js/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <form id="formulario-Registro" class="form" action="../back/signup.php" method="POST">
            <h2>Registrarse</h2>
            <input type="hidden" id="id" name="id" class="customerName" value="0">
            <input type="text" id="nombre" name="nombre" class="customerName" placeholder="Nombre(s)" required>
            <input type="text" id="apate" name="apate" class="customerName" placeholder="Apellido Paterno" required>
            <input type="text" id="amate" name="amate" class="customerName" placeholder="Apellido Materno" required>
            <input type="email" id="correo" name="correo" class="customerName" placeholder="Correo electrónico" required>
            <input type="text" id="direccion" name="direccion" class="customerName" placeholder="Dirección" required>
            <input type="text" id="telefono" name="telefono" class="customerName" placeholder="Teléfono" required>
            <input type="password" id="contrasena" name="contrasena" class="customerName" placeholder="Contraseña" required>
            <button type="button" class="btn btnAdd" id="Agregar">Registrarse</button>
            <p class="message">¿Ya tienes una cuenta? <a href="index.php">Iniciar sesión</a></p>
        </form>
    </div>
</body>
</html>

<script type="text/javascript">

$(document).ready(function(){

 var currentIndex = 0;
 var registros = []; // Aquí almacenaremos los datos de los registros

//Funcion para limpiar los campos por medio del formulario
 $('#Limpiar').click(function(){
   $('#formulario-Registro')[0].reset();
 });

//Funcion para Agregar la Información
 $('#Agregar').click(function(){

   if ($('#nombre').val()  === '' || $('#correo').val() === '' || $('#telefono').val() === '' || $('#direccion').val() === '' || $('#contrasena').val() === '' ) {
      alert('Por favor, complete todos los campos excepto ID');
      return false;
   }

     var data = $("#formulario-Registro").serializeArray(); // convert form to array

      data.push({
        name: "Modulo",
        value: "Guardar"
      });
        $.ajax({
            url:  '../back/dbsignup.php',
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
   if ($('#nombre').val()  === '' || $('#correo').val() === '' || $('#telefono').val() === '' || $('#direccion').val() === '' || $('#contrasena').val() === '' ) {
      alert('Por favor, complete todos los campos excepto ID');
      return false;
   }

     var data = $("#formulario-Registro").serializeArray(); // convert form to array

      data.push({
        name: "Modulo",
        value: "Editar"
      });
        $.ajax({
            url:  '../back/dbsignup.php',
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
            url:  '../back/dbsignup.php',
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