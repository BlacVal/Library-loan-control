<?php
session_start();
include 'conexion_be.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $titulo = $_POST['titulo'];
    $estado = $_POST['Estado'];
    $pdf = $_FILES['pdf']['name'];
    $pdf_tmp = $_FILES['pdf']['tmp_name'];

    // Ruta donde se guardará el archivo PDF
    $upload_dir = "./libros/";
    $pdf_path = $upload_dir . basename($pdf);

    // Verificar si la carpeta de destino existe, si no, crearla
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Verificar si el archivo es PDF
    $file_type = strtolower(pathinfo($pdf_path, PATHINFO_EXTENSION));
    if ($file_type != "pdf") {
        echo "Solo se permiten archivos PDF.";
        exit();
    }

    // Mover el archivo al servidor
    if (move_uploaded_file($pdf_tmp, $pdf_path)) {
        // Insertar en la base de datos, cambiando 'pdf_path' a 'pdf'
        $query = "INSERT INTO libros (titulo, Estado, pdf) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("sss", $titulo, $estado, $pdf_path);

        if ($stmt->execute()) {
            echo "El archivo PDF se ha subido correctamente.";
        } else {
            echo "Error al subir el archivo a la base de datos: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al mover el archivo.";
    }

    $conexion->close();
}
?>
