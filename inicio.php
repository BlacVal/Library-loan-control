<?php 
session_start();

if(isset($_SESSION['usuario'])){
    echo '<a href="/php/logout.php"></a>';
}
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <link rel="icon" href="/assets/imagess/create-a-logo-for-a-book-lending-website-with-the--xUGYRNzKTsSZX7EX5FrmTA-Tu_1KVIRQTC8_jUSZEWxxw.jpeg">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Library loan control</title>
<meta name="title" content="Library loan control" />
<meta name="description" content="Bienvenido a una nueva experiencia virtual, Desde la comodidad de tu dispositivo electrónico puedes acceder a libros virtuales sobre el mundo de la programación" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="https://metatags.io/" />
<meta property="og:title" content="Library loan control" />
<meta property="og:description" content="Bienvenido a una nueva experiencia virtual, Desde la comodidad de tu dispositivo electrónico puedes acceder a libros virtuales sobre el mundo de la programación" />
<meta property="og:image" content="https://metatags.io/images/meta-tags.png" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="https://metatags.io/" />
<meta property="twitter:title" content="Library loan control" />
<meta property="twitter:description" content="Bienvenido a una nueva experiencia virtual, Desde la comodidad de tu dispositivo electrónico puedes acceder a libros virtuales sobre el mundo de la programación" />
<meta property="twitter:image" content="https://metatags.io/images/meta-tags.png" />
<meta name="keywords" content="Biblioteca,Virtual,Libros,Aprendizaje,Servicios,online,libros">
    <meta name="author" content="Samuel Brand Gaviria">
    <meta name="robots" content="nosnippet">
    <meta name="robots" content="noarchive">
    <meta name="robots" content="noimageindex">
</head>

<body>

<nav>
    <div class="nav-logo">
        <a href="/php/Acercade.php"><h1>Nosotros</h1></a>
    </div>
    <ul class="nav-links">
        <li class="link"><a href="/inicio.php">Home</a></li>
        <li id="link1" class="link"><a href="/php/buscar_libros.php">Books</a></li>
        <li id="link2" class="link"><a href="/php/libro.php">Loans</a></li>
        <li id="link3" class="link"><a href=""></a></li>
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
    
    <!-- Aquí añadimos el botón de modo -->
    <button id="mode-toggle" class="btn">Night mode</button>
</nav>


<header class="container">
    <div class="content">
        <span class="blur"></span>
        <span class="blur"></span>
        <h4>Desarrolla tus conocimientos como un profesional</h4>
        <h1>Hola, somos <span>Library Loan Control</span>, desarrolladores web</h1>
        <p><h4>
        Bienvenido a la Biblioteca Virtual de la Institución Educativa Félix de Bedout Moreno Library loan control
        Descubre un espacio diseñado para fomentar el aprendizaje y la investigación. Aquí, tendrás acceso a una amplia colección de libros en formato PDF, incluyendo títulos de programación y otros temas básicos de la media técnica. Además, ofrecemos un sistema de préstamo digital para que puedas llevarte tus libros favoritos a casa, de manera sencilla y rápida. ¡Explora, aprende y disfruta de la lectura!
            </h4></p>
    </div>
    <div class="image">
        <img src="./assets/imagess/header.png">
    </div>
</header>

<section class="container">
    <h2 class="header">Caracteristicas</h2>
    <div class="features">
        <div class="card">
            <center>
                <span><i class="ri-money-dollar-box-line"></i></span>
                <h4>
                Información </h4>
                <p><h4>
                En los siguientes libros tendrás mucha información que te será útil.
                    </h4></p>
                <a href="./php/buscar_libros.php">Go now <i class="ri-arrow-right-line"></i></a>
            </center>
        </div>
        <div class="card">
            <center>
                <span><i class="ri-bug-line"></i></span>
                <h4>
                Te ayudamos con información</h4>
                <p><h4>
                Contáctanos para aclarar tus dudas, qué libros están disponibles y más.
                    </h4></p>
                    <a href="https://iefelixdebedoutmoreno.edu.co" target="_blank">Go now <i class="ri-arrow-right-line"></i></a>

            </center>
        </div>
        <div class="card">
            <center>
                <span><i class="ri-history-line"></i></span>
                <h4>
                ¿Por qué hicimos este proyecto?</h4>
                <p><h4>
                Nuestra inspiración para hacer este proyecto, ¿cuál fue?
                    </h4></p>
                <a href="#">ve ahora <i class="ri-arrow-right-line"></i></a>
            </center>
        </div>
        <div class="card">
            <center>
                <span><i class="ri-shake-hands-line"></i></span>
                <h4>Cooperación</h4>
                <p><h4>
                Nuestro equipo de trabajo
                    </h4></p>
                <a href="/php/Acercade.php">Go now <i class="ri-arrow-right-line"></i></a>
            </center>
        </div>
    </div>
</section>

<footer class="container">
    <span class="blur"></span>
    <span class="blur"></span>
    <div class="column">
    </div>
</footer>
<center>
    <div class="copyright">
        <div>
            <img id="footer" class="banner-img float-center" src="/assets/imagess/I.E.Felix_de_Bedout_Moreno.png" alt="I.E. Félix de Bedout Moreno">
            <img id="footer" class="banner-img float-center" src="/assets/imagess/Pascual.png" alt="I.E. Pascual Bravo">
        </div>
        <p> &copy; 2024 Library loan Control. All rights reserved. </p>
    </div>
    </center>   
<script src="./assets/js/scripts.js"></script>
</body>
</html>