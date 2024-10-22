<?php
session_start();

// Redirigir si el usuario no ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

// Establecer rol predeterminado si no está definido
if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = 'user';
}

// Incluir el archivo de conexión a la base de datos
include './conexion_be.php'; // Asegúrate de ajustar la ruta según la estructura de tu proyecto

// Obtener el término de búsqueda
$q = isset($_GET['q']) ? $_GET['q'] : '';

// Consulta para seleccionar registros de la tabla 'libros' basados en la búsqueda
$query = "SELECT id, titulo, Estado FROM libros WHERE titulo LIKE ? OR Estado LIKE ?";
$stmt = $conexion->prepare($query);
$searchTerm = "%$q%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
$resultados = [];

while ($row = $result->fetch_assoc()) {
    $resultados[] = $row;
}

$stmt->close();
$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Libros</title>
    <link rel="stylesheet" href="/assets/css/libros.css">
</head>
<body>
<nav>
    <div class="nav-logo">
        <a href="/php/Acercade.php"><h3>Nosotros</h3></a>
    </div>
    <ul class="nav-links">
        <li class="link"><a href="/inicio.php">Home</a></li>
        <li id="link1" class="link"><a href="/php/buscar_libros.php">Books</a></li>
        <li id="link2" class="link"><a href="/php/libro.php">Loans</a></li>
    </ul>

    <?php if(isset($_SESSION['usuario'])): ?>
        <div class="menu-item">
            <button class="btn">
                <a href="/php/perfil.php">View Profile</a>
            </button>
            <ul class="submenu">
                <li><button class="btn"><a href="/php/logout.php">Sign Off</a></button></li>
            </ul>
        </div>
    <?php else: ?>
        <button class="btn"><a href="./index.php">Log In</a></button>
    <?php endif; ?>
    
    <button id="mode-toggle" class="btn">Night mode</button>
</nav>

<div class="container">
    <center><h3>Buscar Libros</h3></center>
    <form action="buscar_libros.php" method="get" autocomplete="off">
        <input type="text" name="q" placeholder="Buscar libros" value="<?php echo htmlspecialchars($q); ?>" required>
        <button type="submit">Buscar</button>
    </form>

    <div id="loader" style="display:none;">Cargando...</div>
    <div id="resultados">
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["titulo"]); ?></td>
                        <td>
                            <?php if ($_SESSION['role'] == 'admin'): ?>
                                <form action="actualizar_estado.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row["id"]); ?>">
                                    <input type="text" name="Estado" value="<?php echo htmlspecialchars($row["Estado"]); ?>">
                                    <button type="submit">Actualizar</button>
                                </form>
                            <?php else: ?>
                                <?php echo htmlspecialchars($row["Estado"]); ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="visualizador.php?id=<?php echo htmlspecialchars($row['id']); ?>">Ver PDF</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Formulario para subir libros, visible solo para administradores -->
        <?php if ($_SESSION['role'] == 'admin'): ?>
            <h3>Subir Libro</h3>
            <form action="subir_libro.php" method="POST" enctype="multipart/form-data">
                <label for="titulo">Título del archivo:</label>
                <input type="text" name="titulo" id="titulo" required>
                <br><br>

                <label for="Estado">Estado del archivo:</label>
                <input type="text" name="Estado" id="Estado" required>
                <br><br>

                <label for="pdf">Selecciona un archivo PDF:</label>
                <input type="file" name="pdf" accept="application/pdf" required>
                <br><br>

                <button type="submit" name="submit">Subir PDF</button>
            </form>
        <?php endif; ?>
        
    </div>
</div>

<script src="/assets/js/libros.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('mode-toggle');
    const body = document.body;

    // Cargar preferencia de modo oscuro
    if (localStorage.getItem('dark-mode') === 'true') {
        body.classList.add('night-mode');
        toggleButton.textContent = 'Day mode';
    }

    // Alternar entre modos y guardar preferencia
    toggleButton.addEventListener('click', function() {
        body.classList.toggle('night-mode');
        const isNightMode = body.classList.contains('night-mode');
        toggleButton.textContent = isNightMode ? 'Day mode' : 'Night mode';
        localStorage.setItem('dark-mode', isNightMode);
    });
});
</script>

<center>
    <div class="copyright">
        <div>
            <img id="footer" class="banner-img float-center" src="/assets/imagess/I.E.Felix_de_Bedout_Moreno.png" alt="I.E. Félix de Bedout Moreno">
            <img id="footer" class="banner-img float-center" src="/assets/imagess/Pascual.png" alt="I.E. Pascual Bravo">
        </div>
        <p> &copy; 2024 Library loan Control. All rights reserved. </p>
    </div>
</center>
</body>
</html>
