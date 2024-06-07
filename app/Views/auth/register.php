<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <style>
        @font-face {
            font-family: 'sf-bold';
            src: url('../fonts/SF-Pro-Display-Bold.otf') format('woff2');
        }

        @font-face {
            font-family: 'graphik-black';
            src: url('../fonts/GraphikBlack.otf') format('woff2');
        }

        @font-face {
            font-family: 'graphik-bold';
            src: url('../fonts/GraphikBold.otf') format('woff2');
        }

        @font-face {
            font-family: 'sf-black';
            src: url('../fonts/SF-Pro-Display-Black.otf') format('woff2');
        }

        @font-face {
            font-family: 'sf-regular';
            src: url('../fonts/SF-Pro-Text-Regular.otf') format('woff2');
        }

        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

        body {
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'sf-regular', sans-serif;
            height: 100vh;
            padding: 0 !important;
            margin: 0 !important;
        }

        .login-title {
            font-family: 'graphik-black';
            font-size: 35px;
            margin-left: -5px;
        }

        .descripcion-title {
            font-size: 15px;
            margin: 10px 0;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
        }

        a {
            color: #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        button {
            border-radius: 20px;
            border: 1px solid #FF4B2B;
            background-color: #c24f22;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
            width: 106%;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
        }

        form {
            background-color: #FFFFFF;
            display: flex;
            align-items: left;
            justify-content: center;
            flex-direction: column;
            padding: 0 100px;
            padding-right: 130px;
            height: 100%;
            text-align: left;
        }

        input {
            background-color: #f2f2f2;
            color: #111 !important;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
            border-radius: 20px;
            font-size: 18px;
        }

        .input-group {
            display: flex;
            gap: 10px;
            width: 105%;
        }

        .input-group .half-width {
            width: 100%;
            flex: 1;
        }


        .container {
            background-color: #fff;
            position: relative;
            overflow: hidden;
            width: 100%;
            padding: 0 !important;
            height: 100vh;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 55%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: #fff;
            background: url("/assets/img/fondo-login.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: left;
            justify-content: left;
            flex-direction: column;
            padding: 0 40px;
            text-align: left;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        @media screen and (max-width: 1068px) {

            .form-container.sign-in-container,
            .form-container.sign-up-container {
                width: 100%;
                left: 0;
            }

            .overlay-container {
                display: none;
            }


            form {
                padding: 0 200px;
            }

            input {
                font-size: 16px;
            }

            .login-title {
                font-size: 30px;
            }

            .descripcion-title {
                font-size: 13px;
            }

            button {
                font-size: 10px;
                padding: 10px 30px;
            }
        }

        @media screen and (max-width: 768px) {

            .form-container.sign-in-container,
            .form-container.sign-up-container {
                width: 100%;
                left: 0;
            }

            .overlay-container {
                display: none;
            }


            form {
                padding: 0 80px;
                padding-right: 100px;
            }

            input {
                font-size: 16px;
            }

            .login-title {
                font-size: 30px;
            }

            .descripcion-title {
                font-size: 13px;
            }

            button {
                font-size: 10px;
                padding: 10px 30px;
            }
        }

        .redireccion-auth {
            text-align: center;
        }

        .strong {
            font-family: 'sf-bold';
            font-size: 15px;
        }

        span {
            margin-left: 10px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container" id="container">
        <div class="overlay-container">
            <div class="overlay"></div>
        </div>
        <div class="form-container sign-in-container">
            <form action="<?= site_url('auth/do_register') ?>" method="post" autocomplete="off">
                <?= csrf_field() ?>
                <span class="login-title">¡Bienvenido, aventurero!</span>
                <span class="descripcion-title">Descubre la app definitiva para gestionar tus tareas.</span>
                <?php if (isset($validation) && $validation->hasError('nombre')): ?>
                    <span class="mensaje-error"><?= $validation->getError('nombre') ?></span>
                <?php endif; ?>
                <?php if (isset($validation) && $validation->hasError('apellidos')): ?>
                    <span class="mensaje-error"><?= $validation->getError('apellidos') ?></span>
                <?php endif; ?>
                <div class="input-group">

                    <input type="text" name="nombre" placeholder="Escribe tu nombre" value="<?= set_value('nombre') ?>"
                        class="half-width" autocomplete="given-name">


                    <input type="text" name="apellidos" placeholder="Escribe tus apellidos" class="half-width"
                        value="<?= set_value('apellidos') ?>" autocomplete="family-name">

                </div>
                <?php if (isset($validation) && $validation->hasError('email')): ?>
                    <span class="mensaje-error"><?= $validation->getError('email') ?></span>
                <?php endif; ?>
                <input type="email" name="email" placeholder="Escribe tu email" value="<?= set_value('email') ?>"
                    autocomplete="email">

                <?php if (isset($validation) && $validation->hasError('contraseña')): ?>
                    <span class="mensaje-error"><?= $validation->getError('contraseña') ?></span>
                <?php endif; ?>
                <input type="password" placeholder="Escribe tu contraseña" name="contraseña" autocomplete="new-password"
                    id="password">


                <?php if (isset($validation) && $validation->hasError('confirmar_contraseña')): ?>
                    <span class="mensaje-error"><?= $validation->getError('confirmar_contraseña') ?></span>
                <?php endif; ?>
                <input type="password" name="confirmar_contraseña" placeholder="Confirmar contraseña"
                    autocomplete="new-password">

                <button type="submit" value="Register">Continuar</button>
                <a class="redireccion-auth" href="<?= site_url('auth/login') ?>">Tengo una cuenta, <span
                        class="strong">Iniciar sesión</span></a>
            </form>
        </div>
    </div>
</body>

</html>