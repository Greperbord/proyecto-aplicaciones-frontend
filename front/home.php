<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renta de autos chidos</title>
    <link rel="stylesheet" href="./css/principal.css">
    <script src="./js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php
    // Iniciar la sesión al comienzo del script PHP
    session_start();
    ?>
    <h1>Renta de autos chidos</h1>

    <div class="car-section">
        <h2>Autos Disponibles</h2>
        <div class="container">
        <div class="car" data-price="50" data-id="1">
            <img src="carros/car1.jpg" alt="Carro 1">
            <h3>Corolla</h3>
            <p>Toyota Sedan 2022</p>
            <p>Precio por hora: $50.00</p>
            <p>Capacidad: 5 personas</p>
            <p>Transmisión: Automática</p>
            <p>Motores: Motores de 1.8 litros de 139 caballos de fuerza o 2.0 litros de 169 caballos de fuerza.</p>
            <p class="availability">Verificando...</p>
        </div>

        <div class="car" data-price="55" data-id="2">
            <img src="carros/car2.jpg" alt="Carro 2">
            <h3>Civic</h3>
            <p>Honda Sedán 2021</p>
            <p>Precio por hora: $55.00</p>
            <p>Capacidad: 4 personas</p>
            <p>Transmisión: Automática</p>
            <p>Motores: Motores de 1.8 litros de 139 caballos de fuerza o 2.0 litros de 169 caballos de fuerza.</p>
            <p class="availability">Verificando...</p>
        </div>

        <div class="car" data-price="70" data-id="3">
            <img src="carros/car3.jpg" alt="Carro 3">
            <h3>Escape</h3>
            <p>Ford 2020 SUV</p>
            <p>Precio por hora: $70.00</p>
            <p>Capacidad: 5 personas</p>
            <p>Transmisión: Automática</p>
            p>Motores: Motores de 2.5 litros de 180 caballos de fuerza.</p>
            <p class="availability">Verificando...</p>
        </div>

        <div class="car" data-price="40" data-id="4">
            <img src="carros/car4.jpg" alt="Carro 4">
            <h3>Spark</h3>
            <p>Chevrolet 2023 Compacto</p>
            <p>Precio por hora: $40.00</p>
            <p>Capacidad: 4 personas</p>
            <p>Transmisión: Manual</p>
            <p>Motores: Motores de 1.0 litros de 80 caballos de fuerza.</p>
            <p class="availability">Verificando...</p>
        </div>

        <div class="car" data-price="90" data-id="5">
            <img src="carros/car5.jpg" alt="Carro 5">
            <h3>Wrangler</h3>
            <p>Jeep 2021 SUV</p>
            <p>Precio por hora: $90.00</p>
            <p>Capacidad: 5 personas</p>
            <p>Transmisión: Manual</p>
            <p>Motores: Motores de 3.6 litros de 285 caballos de fuerza.</p>
            <p class="availability">Verificando...</p>
        </div>

            
        </div>
    </div>

<?php
// Conexión a la base de datos
$servername = "localhost:8889";
$username = "root";
$password = "root";
$database = "renta_carros";

$conn = new mysqli($servername, $username, $password, $database);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para obtener el nombre del cliente desde la base de datos
function obtenerNombreCliente($conn, $idCliente) {
    $sql = "SELECT nombre FROM clientes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idCliente);
    $stmt->execute();
    $stmt->bind_result($nombre);
    $stmt->fetch();
    $stmt->close();
    return $nombre;
}

// Obtiene el ID del cliente de la sesión (asumimos que $_SESSION['user_id'] contiene el ID del cliente)
$idCliente = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

// Obtiene el nombre del cliente desde la base de datos
$nombreCliente = obtenerNombreCliente($conn, $idCliente);
?>

<h2>Reserva carro para <?php echo htmlspecialchars($nombreCliente); ?></h2>
    <div class="container">
        <form id="formulario-Registro" autocomplete="off">
            <table id="customerTable">
                <h2>Reservaciones</h2>
                <tr>
                    <th>Carro</th>
                    <td>
                        <select name="id_auto" id="id_auto">
                            <option value="0" data-price="0"></option>
                            <option value="1" data-price="50">Corolla</option>
                            <option value="2" data-price="55">Civic</option>
                            <option value="3" data-price="70">Escape</option>
                            <option value="4" data-price="40">Spark</option>
                            <option value="5" data-price="90">Wrangler</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Recolección</th>
                    <td>
                        <select name="recoleccion" id="recoleccion">
                            <option value="0"></option>
                            <option value="Ciudad de México, Ciudad de México">Ciudad de México, Ciudad de México</option>
                            <option value="Monterrey, Nuevo León">Monterrey, Nuevo León</option>
                            <option value="Guadalajara, Jalisco">Guadalajara, Jalisco</option>
                            <option value="Puebla, Puebla">Puebla, Puebla</option>
                            <option value="Mérida, Yucatán">Mérida, Yucatán</option>
                            <option value="Tijuana, Baja California">Tijuana, Baja California</option>
                            <option value="León, Guanajuato">León, Guanajuato</option>
                            <option value="Cancún, Quintana Roo">Cancún, Quintana Roo</option>
                        </select>
                    </td>
                    
                </tr>
                <tr>
                    <th>Devolución</th>
                    <td>
                        <select name="devolucion" id="devolucion">
                            <option value="0"></option>
                            <option value="Ciudad de México, Ciudad de México">Ciudad de México, Ciudad de México</option>
                            <option value="Monterrey, Nuevo León">Monterrey, Nuevo León</option>
                            <option value="Guadalajara, Jalisco">Guadalajara, Jalisco</option>
                            <option value="Puebla, Puebla">Puebla, Puebla</option>
                            <option value="Mérida, Yucatán">Mérida, Yucatán</option>
                            <option value="Tijuana, Baja California">Tijuana, Baja California</option>
                            <option value="León, Guanajuato">León, Guanajuato</option>
                            <option value="Cancún, Quintana Roo">Cancún, Quintana Roo</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Inicio de la reservación</th>
                    <td><input type="date" id="fecha_inicio" name="fecha_inicio" required></td>
                </tr>
                <tr>
                    <th>Fin de la reservación</th>
                    <td><input type="date" id="fecha_fin" name="fecha_fin" required></td>
                </tr>
                <tr>
                    <th>Pago</th>
                    <td class="pago-container"><input type="text" id="pago" name="pago" readonly></td>
                </tr>
                <tr>
                    <th>Estatus de la reservacion</th>
                    <td><div id="statusReservacion" class="status"></div></td>
                </tr>
                <tr >
                    <td><input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo $idCliente; ?>"></td>
                </tr> 
                <tr >
                    <td><input type="hidden" id="id" name="id" class="customerName" placeholder="ID Instructor" value ="0"readonly></td>
                </tr><
            </table>
            
            <div style="text-align: center;">
                <button type="button" class="btn btnAdd" id="Agregar">Reservar</button>
                <button type="button" class="btn btnClean" id="Limpiar">Nueva</button>
                <button type="button" class="btn btnEdit" id="Editar">Editar</button>
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

    <script type="text/javascript">
        $(document).ready(function() {
            var currentIndex = 0;
            var registros = []; // Aquí almacenaremos los datos de los registros

            verificarDisponibilidad();

            // Cargar los registros al cargar la página
            cargarRegistros();

            // Función para cargar los registros desde la base de datos o donde los tengas almacenados
            function cargarRegistros() {
                $.ajax({
                    url: '../back/db.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        Modulo: "Consultar"
                    },
                    success: function(data) {
                        registros = data;
                        cargarRegistro(currentIndex);
                        actualizarEstado(); // Llamar a actualizarEstado() al cambiar el índice con la flecha derecha
                    }
                });
            }

            // Función para cargar los datos de los registros
            function cargarRegistro(index) {
                var registro = registros[index];
                console.log(registro);
                $('#id').val(registro.id);
                $('#id_cliente').val(registro.id_cliente);
                $('#id_auto').val(registro.id_auto);
                $('#recoleccion').val(registro.recoleccion);
                $('#devolucion').val(registro.devolucion);
                $('#fecha_inicio').val(registro.fecha_inicio);
                $('#fecha_fin').val(registro.fecha_fin);
                $('#pago').val('$' + registro.pago);
            }

            // Evento click para la flecha izquierda (anterior)
            $('.fa-arrow-left').click(function() {
                console.log(currentIndex);
                if (currentIndex > 0) {
                    currentIndex--;
                    cargarRegistro(currentIndex);
                    actualizarEstado(); // Llamar a actualizarEstado() al cambiar el índice con la flecha derecha
                }
            });

            // Evento click para la flecha derecha (siguiente)
            $('.fa-arrow-right').click(function() {
                console.log(currentIndex);
                if (currentIndex < registros.length - 1) {
                    currentIndex++;
                    cargarRegistro(currentIndex);
                    actualizarEstado(); // Llamar a actualizarEstado() al cambiar el índice con la flecha derecha
                }
            });

            // Función para limpiar los campos por medio del formulario
            $('#Limpiar').click(function() {
                $('#formulario-Registro')[0].reset();
                actualizarEstado(); // Llamar a actualizarEstado() al cambiar el índice con la flecha derecha
            });

            // Función para calcular el pago
            function calcularPago() {
                var id_auto = $('#id_auto').val();
                var precioPorHora = $('#id_auto option:selected').data('price');
                var fechaInicio = new Date($('#fecha_inicio').val());
                var fechaFin = new Date($('#fecha_fin').val());

                if (!isNaN(fechaInicio) && !isNaN(fechaFin) && precioPorHora) {
                    var diferenciaEnHoras = (fechaFin - fechaInicio) / (1000 * 60 * 60);
                    var pagoTotal = diferenciaEnHoras * precioPorHora;
                    $('#pago').val(pagoTotal.toFixed(2));
                } else {
                    $('#pago').val('');
                }
            }

            // Evento para calcular el pago al cambiar la fecha de fin
            $('#fecha_fin').change(calcularPago);

            // Función para agregar la información
            $('#Agregar').click(function() {
                console.log('Valor del campo id_cliente:', $('#id_cliente').val());
                console.log('Valor del campo id_auto:', $('#id_auto').val());
                console.log('Valor del campo recoleccion:', $('#recoleccion').val());
                console.log('Valor del campo devolucion:', $('#devolucion').val());
                console.log('Valor del campo fecha_inicio:', $('#fecha_inicio').val());
                console.log('Valor del campo fecha_fin:', $('#fecha_fin').val());
                console.log('Valor del campo pago:', $('#pago').val());
                if ($('#user_id').val() === '' || $('#id_auto').val() === '' || $('#recoleccion').val() === '' || $('#devolucion').val() === '' || $('#fecha_inicio').val() === '' || $('#fecha_fin').val() === '' || $('#pago').val() === '') {
                    alert('Por favor, complete todos los campos');
                    return false;
                }
                
                // Establecer el valor del campo id como vacío
                $('#id').val('');

                // Calcular el pago antes de enviar el formulario
                calcularPago();

                var data = $("#formulario-Registro").serializeArray(); // Convertir formulario a array


                data.push({
                    name: "Modulo",
                    value: "Guardar"
                });

                $.ajax({
                    url: '../back/db.php',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function(data) {
                        alert(data);
                        location.reload();
                    }
                });
            });

            // Función para editar la información
            $('#Editar').click(function() {
                if ($('#id').val() === '' ||$('#id_auto').val() === '' || $('#recoleccion').val() === '' || $('#devolucion').val() === '' || $('#fecha_inicio').val() === '' || $('#fecha_fin').val() === ''|| $('#pago').val() === '' ) {
                    alert('Por favor, complete todos los campos');
                    actualizarEstado(); // Llamar a actualizarEstado() al cambiar el índice con la flecha derecha
                    return false;
                }

                // Calcular el pago antes de enviar el formulario
                calcularPago();

                var data = $("#formulario-Registro").serializeArray(); // Convertir formulario a array

                data.push({
                    name: "Modulo",
                    value: "Editar"
                });

                $.ajax({
                    url: '../back/db.php',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function(data) {
                        alert(data);
                        location.reload();
                    }
                });
            });

            // Función para eliminar la información
            $('#Eliminar').click(function() {
                var data = $("#formulario-Registro").serializeArray(); // Convertir formulario a array

                data.push({
                    name: "Modulo",
                    value: "Eliminar"
                });

                $.ajax({
                    url: '../back/db.php',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function(data) {
                        alert(data);
                        location.reload();
                    }
                });
            });
            // Función para actualizar el estado de la reserva
            function actualizarEstado() {
                var fechaInicio = new Date($('#fecha_inicio').val());
                var fechaFin = new Date($('#fecha_fin').val());
                var fechaActual = new Date();

                console.log("Fecha de inicio:", fechaInicio);
                console.log("Fecha de fin:", fechaFin);
                console.log("Fecha actual:", fechaActual);

                if (fechaInicio === '' || fechaFin === '') {
                    $('#statusReservacion').html(''); // Mostrar en blanco si las fechas están vacías
                    return;
                }

                if (fechaInicio > fechaActual) {
                    $('#statusReservacion').html('Por comenzar').addClass('upcoming').removeClass('in-process finished');
                } else if (fechaInicio <= fechaActual && fechaActual <= fechaFin) {
                    $('#statusReservacion').html('En proceso').addClass('in-process').removeClass('upcoming finished');
                } else if (fechaActual > fechaFin) {
                    $('#statusReservacion').html('Finalizada').addClass('finished').removeClass('upcoming in-process');
                } else {
                    $('#statusReservacion').html('');
                    }
            }


            // Función para verificar la disponibilidad de cada carro
            function verificarDisponibilidad() {
                $('.car').each(function() {
                    var carId = $(this).data('id');
                    var $availability = $(this).find('.availability');

                    $.ajax({
                        url: '../back/verificar_disponibilidad.php',
                        type: 'POST',
                        dataType: 'json', 
                        success: function(response) {
                            console.log('Respuesta del servidor para el carro ID ' + carId + ':', response); 

                            
                            var carData = response.find(car => car.id === carId.toString());
                            
                            if (carData) {
                                if (carData.disponibilidad === "1") {
                                    $availability.text('Disponible');
                                    $availability.css('color', 'green').css('font-weight', 'bold');
                                    //$availability.addClass('disponible').removeClass('no-disponible');
                                } else {
                                    $availability.text('No disponible');
                                    //$availability.addClass('no-disponible').removeClass('disponible');
                                    $availability.css('color', 'red').css('font-weight', 'bold');
                                }
                            } else {
                                $availability.text('No encontrado');
                                $availability.css('color', '').css('font-weight', '');
                                //$availability.removeClass('disponible no-disponible');
                            }
                        },
                        error: function() {
                            $availability.text('Error al verificar');
                            $availability.css('color', '').css('font-weight', '');
                            //$availability.removeClass('disponible no-disponible');
                        }
                    }); 
                });
            }

            verificarDisponibilidad();

            // Eventos para los inputs de fecha para actualizar el estado
            $('#fecha_inicio, #fecha_fin').on('change', actualizarEstado);

            // Actualización inicial del estado al cargar la página
            actualizarEstado();
            
        

            // Calcular el pago también al cambiar la fecha de inicio o el auto seleccionado
            $('#fecha_inicio').change(calcularPago);
            $('#id_auto').change(calcularPago);
        });
    </script>
</body>
</html>
