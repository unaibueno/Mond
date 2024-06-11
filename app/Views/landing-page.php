<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Mond - Innovación que organiza, diseño que inspira</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link type="text/css" href="vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <style>
        @font-face {
            font-family: 'graphik-black';
            src: url('../fonts/GraphikBlack.otf') format('woff2');
            /* Agrega otras propiedades según sea necesario, como font-weight y font-style */
        }

        @font-face {
            font-family: 'graphik-bold';
            src: url('../fonts/GraphikBold.otf') format('woff2');
            /* Agrega otras propiedades según sea necesario, como font-weight y font-style */
        }

        @font-face {
            font-family: 'sf-bold';
            src: url('../fonts/SF-Pro-Display-Bold.otf') format('woff2');
            /* Agrega otras propiedades según sea necesario, como font-weight y font-style */
        }

        @font-face {
            font-family: 'sf-black';
            src: url('../fonts/SF-Pro-Display-Black.otf') format('woff2');
            /* Agrega otras propiedades según sea necesario, como font-weight y font-style */
        }

        @font-face {
            font-family: 'sf-regular';
            src: url('../fonts/SF-Pro-Text-Regular.otf') format('woff2');
        }

        body {
            margin: 0;
            font-family: 'sf-regular';
        }

        .navbar {
            position: fixed;
            top: 35px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 39%;
            background-color: rgba(242, 242, 242, 0.9);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            padding-right: 4px;
            z-index: 1000;
            border-radius: 40px;
            backdrop-filter: blur(10px);
        }

        .navbar .navbar-left {
            display: flex;
            align-items: center;
        }

        .navbar .navbar-left span {
            font-family: 'graphik-black';
            font-size: 30px;
            text-transform: uppercase;
            color: #1e1e1e;
            margin-top: 2px;
        }

        .navbar img {
            margin: 0 5px;
            padding: 5px
        }

        .navbar a {
            margin: 0 10px;
            text-decoration: none;
            color: #000;
            font-weight: bold;
        }

        .boton-inicio-sesion {
            background-color: black;
            border-radius: 40px;
            padding: 12px;
            color: #fff !important;
        }

        .navbar-right {
            display: flex;
            align-items: center;
        }

        .content {
            padding: 330px;
            padding-top: 160px;
            padding-bottom: 100px;
        }

        .content h1 {
            font-size: 73px;
            margin-bottom: 20px;
            text-align: center;
            font-family: 'sf-bold';
        }

        .content p {
            font-size: 19px;
            color: #666;
            margin-bottom: 30px;
            padding: 0 50px;
            text-align: center;
        }

        .content .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
            border-radius: 30px;
        }

        .content .buttons a {
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            border-radius: 30px;
            background-color: black;
        }

        .content .buttons a.secondary {
            background-color: white;
            color: black;
            border-radius: 30px;
            border: 2px solid #f2f2f2;
        }

        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 0px;
        }

        .image-container img {
            max-width: 70%;
            height: auto;
            border-radius: 40px;
            margin-bottom: 90px;
        }

        .extra-content {
            text-align: center;
            margin-bottom: 50px;
        }

        .extra-content h2 {
            font-family: 'sf-bold';
            font-size: 36px;
            margin-bottom: 30px;
        }

        .extra-content .image-row {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .extra-content .image-row img {
            max-width: 30%;
            height: auto;
            border-radius: 20px;
        }

        /*:::::Pie de Pagina*/
        .pie-pagina {
            width: 100%;
            background-color: #111;
        }

        .pie-pagina .grupo-1 {
            width: 100%;
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 50px;
            padding: 45px 0px;
        }

        .pie-pagina .grupo-1 .box figure {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: left;
            align-items: left;
        }

        .pie-pagina .grupo-1 .box figure img {
            width: 100px;
        }

        .pie-pagina .grupo-1 .box h2 {
            color: #fff;
            margin-bottom: 25px;
            font-size: 20px;
        }

        .pie-pagina .grupo-1 .box p {
            color: #efefef;
            margin-bottom: 10px;
        }

        .pie-pagina .grupo-1 .red-social a {
            display: block;
            text-decoration: none;
            width: 100%;
            height: 45px;
            line-height: 45px;
            color: #fff;
            margin-right: 10px;
            text-align: left;
            transition: all 300ms ease;
        }

        .pie-pagina .grupo-1 .red-social a:hover {
            color: aqua;
        }

        .pie-pagina .grupo-2 {
            background-color: #000000;
            padding: 15px 10px;
            text-align: center;
            color: #fff;
        }

        .pie-pagina .grupo-2 small {
            font-size: 15px;
        }

        @media screen and (max-width:800px) {
            .pie-pagina .grupo-1 {
                width: 90%;
                grid-template-columns: repeat(1, 1fr);
                grid-gap: 30px;
                padding: 35px 0px;
            }
        }

        @media screen and (max-width: 800px) {
            .content {
                padding: 200px 0;
            }

            .navbar {
                width: 90%;
                max-width: none;
            }

            .content {
                padding: 200px 0;
            }

            .navbar {}


            .content h1 {
                font-size: 8vw;
                /* Ajustado de 12vw a 8vw */
            }

            .content p {
                font-size: 5vw;
                /* Ajustado de 6vw a 5vw */
            }

        }

        @media screen and (max-width: 500px) {
            .content {
                padding: 200px 0;
            }

            .navbar {}


            .content h1 {
                font-size: 8vw;
                /* Ajustado de 12vw a 8vw */
            }

            .content p {
                font-size: 5vw;
                /* Ajustado de 6vw a 5vw */
            }


        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="navbar-left">
            <img src="assets/img/logo-mond-dark.png" alt="Logo" width="30" height="30">
            <span>Mond</span>
        </div>
        <div class="navbar-right">
            <a href="#">Docs</a>
            <a class="boton-inicio-sesion" href="<?= base_url('dashboard') ?>">Iniciar sesión</a>
        </div>
    </div>

    <div class="content">
        <h1>Haz que cada minuto cuente, con Mond.</h1>
        <p>Descubre una nueva forma de ser productivo. Nuestra interfaz intuitiva te
            mantiene enfocado y
            organizado, haciendo que cada momento cuente</p>
        <div class="buttons">
            <a href="#">Únete a mond</a>
            <a href="#" class="secondary">Descubre las posibilidades</a>
        </div>
    </div>
    <div class="image-container">
        <img src="assets/img/imagen-dashboard.png" alt="Central Image">
    </div>
    <div class="extra-content">
        <!-- <div class="image-row">
            <img src="assets/img/image1.png" alt="Image 1">
            <img src="assets/img/image2.png" alt="Image 2">
            <img src="assets/img/image3.png" alt="Image 3">
        </div> -->
    </div>

    <footer class="pie-pagina">
        <div class="grupo-1">
            <div class="box">
                <figure>
                    <a href="#">
                        <img src="assets/img/logo-white.png" alt="Logo de SLee Dw">

                    </a>
                </figure>
            </div>
            <div class="box">
                <h2>SOBRE NOSOTROS</h2>
                <p style="margin: 0;">Mond es un trabajo de fin de grado realizado con el objetivo de
                    aplicar y demostrar los
                    conocimientos adquiridos durante el curso. Este proyecto no tiene fines comerciales y no genera
                    ingresos
                    económicos. Está destinado exclusivamente a la evaluación académica.</p>
            </div>
            <div class="box">
                <h2>SIGUENOS</h2>
                <div class="red-social">
                    <a href="#" class="fa fa-facebook">Contacto</a>
                    <a href="#" class="fa fa-twitter">Documentación</a>
                    <a href="#" class="fa fa-instagram">Politica de privacidad</a>
                </div>
            </div>
        </div>
        <div class="grupo-2">
            <small>&copy; 2024 <b>Unai Bueno</b> - Todos los derechos reservados.</small>
        </div>
    </footer>
    <script src="vendor/@fortawesome/fontawesome-free/js/all.min.js"></script>
    <script src="assets/plugins/fontawesome-free/js/all.min.js"></script>
</body>

</html>