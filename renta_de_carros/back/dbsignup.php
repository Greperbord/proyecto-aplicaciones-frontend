<?php

function Conectardb()
{
    // Datos de conexión a la base de datos
    $servername = "localhost:8889"; // Cambia esto si tu base de datos está en un servidor diferente
    $username = "root";
    $password = "root";
    $dbname = "renta_carros";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Comprobar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}

function Closedb()
{
    $conn = Conectardb();
    if ($conn->connect_error) {
        die("Error al cerrar la conexión: " . mysqli_error($conn));
    } else {
        mysqli_close($conn);
    }
}


if(isset($_POST['id'])) {
 $id = $_POST['id'];
 $nombre = $_POST['nombre'];
 $correo = $_POST['correo'];
 $telefono = $_POST['telefono'];
 $direccion = $_POST['direccion'];
 $contrasena = $_POST['contrasena'];

}
 $conn = Conectardb();
 
 switch ($_POST['Modulo']) {
    case "Guardar":
        $query = "SELECT * FROM clientes WHERE id = " . $id;
        $result = mysqli_query($conn, $query);
        $num_rows = $result->num_rows;

        if ($num_rows == 0) {
            // Consulta para insertar un nuevo instructor
            $sql = "INSERT INTO clientes (nombre, apate, amate, correo, telefono, direccion, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Datos del formulario
            $nombre = $_POST['nombre'];
            $apate = $_POST['apate'];
            $amate = $_POST['amate'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $contrasena = $_POST['contrasena'];

            // Encriptar la contraseña
            $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);

            // Vincular parámetros
            $stmt->bind_param("sssssss", $nombre, $apate, $amate, $correo, $telefono, $direccion, $contrasena_encriptada);

            // Ejecutar la consulta preparada
            if ($stmt->execute()) {
                echo json_encode("Instructor agregado correctamente");
            } else {
                echo json_encode("Error al agregar el instructor: " . mysqli_error($conn));
            }

            // Cerrar la consulta preparada
            $stmt->close();
        } else {
            echo json_encode("El ID del instructor ya existe en la base de datos, por lo tanto, no se agregó.");
        }
        break;
    default:
        echo json_encode("Opción no válida");


  case "Editar":
		$query = "SELECT * FROM clientes WHERE id = " . $id;
		$result = mysqli_query($conn, $query);
		$num_rows = $result->num_rows;

		if ($num_rows >= 1) {
		    // Consulta para actualizar un instructor existente
		    $sql = "UPDATE clientes SET nombre = ?, correo = ?, telefono = ?, direccion = ?, contrasena = ?  WHERE id = ?";
		    $stmt = $conn->prepare($sql);
		    $stmt->bind_param("sssssi", $nombre, $correo, $telefono, $direccion, $contrasena, $id);

         // Ejecutar la consulta preparada
		  if ($stmt->execute()) {
		   echo json_encode( "Instructor actualizado correctamente");
		  } else{
		  	echo json_encode( "error al actulizar el instructor". mysqli_error($conn));
		  }

	    // Cerrar la consulta preparada
		  $stmt->close();
		}


   break;   
   case "Consultar":
		// Consulta SQL para seleccionar todos los instructores
		$query = "SELECT * FROM clientes";
		$result = mysqli_query($conn, $query);

		// Verificar si la consulta fue exitosa
		if ($result) {
		    // Inicializar un array para almacenar los resultados
		    $clientes = array();

		    // Recorrer los resultados y almacenarlos en el array
		    while ($row = mysqli_fetch_assoc($result)) {
		        $clientes[] = $row;
		    }

		    // Liberar el resultado
		    mysqli_free_result($result);
		    // Devolver los resultados como JSON
		    echo json_encode($clientes);
		} else {
		    // Si la consulta falla, mostrar un mensaje de error
		    echo json_encode('Error al ejecutar la consulta: ' . mysqli_error($conn));
		}
   break;

   case "Eliminar":
		// Consulta SQL para eliminar el registro
      $query = "DELETE FROM clientes WHERE id = " . $id;

      // Ejecutar la consulta
       $result = mysqli_query($conn, $query);

      // Verificar si la consulta fue exitosa
      if ($result) {
        // Si la consulta fue exitosa, devolver un mensaje de éxito
        echo json_encode( 'El registro se eliminó satisfactoriamente.');
      } else {
        // Si la consulta falla, devolver un mensaje de error
        echo json_encode( 'Error al eliminar el registro: ' . mysqli_error($conn));
      }
   break;
 }
// Cerrar la conexión a la base de datos
Closedb();

 
?>