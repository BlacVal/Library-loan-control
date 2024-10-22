<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

include './conexion_be.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Obtener el título y la ruta del PDF desde la base de datos
    $stmt = $conexion->prepare("SELECT titulo, pdf FROM libros WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($titulo, $pdf_path);
    $stmt->fetch();
    $stmt->close();
    $conexion->close();

    // Verificar si se obtuvo el PDF
    if (!$pdf_path || !file_exists($pdf_path)) {
        echo "El archivo PDF no existe.";
        exit();
    }
} else {
    echo "ID de libro no proporcionado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visor de PDF</title>
    <link rel="stylesheet" href="/assets/css/visualizador.css">
</head>
<body class="day-mode">
    <nav>
        <div class="nav-logo">
            <a href="/php/Acercade.php"><h1>Nosotros</h1></a>
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
        <center><header>
            <div class="content">
                <h1>Visor de PDF</h1>
                <p><?php echo htmlspecialchars($titulo); ?></p>
            </div>
        </header></center>
        <div id="pdf-container">
            <!-- Mostramos el PDF directamente usando la ruta guardada -->
            <iframe src="<?php echo $pdf_path; ?>" width="100%" height="900px"></iframe>
        </div>
    </div>
    <center>
    <div class="copyright">
        <div>
            <img id="fotter" class="banner-img float-center" src="/assets/imagess/I.E.Felix_de_Bedout_Moreno.png" alt="I.E. Félix de Bedout Moreno">
            <img id="fotter" class="banner-img float-center" src="/assets/imagess/Pascual.png" alt="I.E. Pascual Bravo">
        </div>
        <p> &copy; 2024 Library loan Control. All rights reserved. </p>
    </div>
    </center>
</body>
</html>
