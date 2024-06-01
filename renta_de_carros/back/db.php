<?php

function Conectardb()
{
    // Datos de conexión a la base de datos
    $servername = "localhost:8889"; 
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

function Closedb($conn)
{
    $conn->close();
}

session_start();

$user_id = $_SESSION['user_id'];

$id = isset($_POST['id']) ? intval($_POST['id']) : null;
$id_cliente = isset($_POST['id_cliente']) ? intval($_POST['id_cliente']) : null;
$id_auto = isset($_POST['id_auto']) ? intval($_POST['id_auto']) : null;
$fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : null;
$fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;
$recoleccion = isset($_POST['recoleccion']) ? $_POST['recoleccion'] : null;
$devolucion = isset($_POST['devolucion']) ? $_POST['devolucion'] : null;
$pago = isset($_POST['pago']) ? floatval($_POST['pago']) : null;
$modulo = isset($_POST['Modulo']) ? $_POST['Modulo'] : null;

$conn = Conectardb();

switch ($modulo) {
    case "Guardar":
        $query = "SELECT * FROM reservas WHERE id = ?";
        $stmt = $conn->prepare($query);
        //$stmt->bind_param("i", $id);
        //$stmt->execute();
        //$result = $stmt->get_result();
        $result = mysqli_query($conn, $query);
        $num_rows = $result->num_rows;

        if ($num_rows == 0) {
            $sql = "INSERT INTO reservas (id_cliente, id_auto, fecha_inicio, fecha_fin, recoleccion, devolucion, pago) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iissssd", $id_cliente, $id_auto, $fecha_inicio, $fecha_fin, $recoleccion, $devolucion, $pago);

            if ($stmt->execute()) {
                echo json_encode("Reservación agregada correctamente");
            } else {
                echo json_encode("Error al agregar la reservación: " . $conn->error);
            }
        } else {
            echo json_encode("El ID de la reservación ya existe en la base de datos por lo tanto no se agregó");
        }
        $stmt->close();
        break;

    case "Editar":
        $query = "SELECT * FROM reservas WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_rows = $result->num_rows;

        if ($num_rows >= 1) {
            $sql = "UPDATE reservas SET id_auto = ?, fecha_inicio = ?, fecha_fin = ?, recoleccion = ?, devolucion = ?, pago = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issssdi", $id_auto, $fecha_inicio, $fecha_fin, $recoleccion, $devolucion, $pago, $id);

            if ($stmt->execute()) {
                echo json_encode("Reservación actualizada correctamente");
            } else {
                echo json_encode("Error al actualizar la reservación: " . $stmt->error);
            }
        } else {
            echo json_encode("La reservación no existe");
        }
        $stmt->close();
        break;

    case "Consultar":
        $query = "SELECT * FROM reservas WHERE id_cliente = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            $reservas = array();
            while ($row = $result->fetch_assoc()) {
                $reservas[] = $row;
            }
            echo json_encode($reservas);
        } else {
            echo json_encode('Error al ejecutar la consulta: ' . $conn->error);
        }
        $stmt->close();
        break;

    

    case "Eliminar":
        $sql = "DELETE FROM reservas WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode('La reservacion se eliminó satisfactoriamente.');
        } else {
            echo json_encode('Error al eliminar reservacion: ' . $stmt->error);
        }
        $stmt->close();
        break;

    default:
        echo json_encode("Operación no válida");
        break;
}

// Cerrar la conexión a la base de datos
Closedb($conn);

?>
