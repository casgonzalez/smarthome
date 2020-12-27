<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acceso</title>
    <style>
        html {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            min-height: 100%;
            background: #F1F1F1;
        }

        /* Animation Keyframes */
        @keyframes scale_header {
            0%   {max-height: 0px; margin-bottom: 0px; opacity: 0;}
            100% {max-height: 117px; margin-bottom: 25px; opacity: 1;}
        }

        @keyframes input_opacity {
            0%   {transform: translateY(-10px); opacity: 0}
            100% {transform: translateY(0px); opacity: 1}
        }

        @keyframes text_opacity {
            0% {color: transparent;}
        }

        @keyframes error_before {
            0%   {height: 5px; background: rgba(0, 0, 0, 0.156); color: transparent;}
            10%  {height: 117px; background: #FFFFFF; color: #C62828}
            90%  {height: 117px; background: #FFFFFF; color: #C62828}
            100% {height: 5px; background: rgba(0, 0, 0, 0.156); color: transparent;}
        }


        /* Login Form */
        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            width: 340px;
            height: auto;
            padding: 5px;
            box-sizing: border-box;
        }

        .login-container img {
            width: 200px;
            margin: 0 0 20px 0;
        }

        .login-container p {
            align-self: flex-start;
            font-family: 'Roboto', sans-serif;
            font-size: 0.8rem;
            color: rgba(0, 0, 0, 0.5);
        }

        .login-container p a {
            color: rgba(0, 0, 0, 0.4);
        }

        .login {
            position: relative;
            width: 100%;
            padding: 10px;
            margin: 0 0 10px 0;
            box-sizing: border-box;
            border-radius: 3px;
            background: #FAFAFA;
            overflow: hidden;
            animation: input_opacity 0.2s cubic-bezier(.55, 0, .1, 1);
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14),
            0 1px 5px 0 rgba(0, 0, 0, 0.12),
            0 3px 1px -2px rgba(0, 0, 0, 0.2);
        }

        .login > header {
            position: relative;
            width: 100%;
            padding: 10px;
            margin: -10px -10px 25px -10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            background: #1c2a48 ;
            font-family: 'Roboto', sans-serif;
            font-size: 1.3rem;
            color: #FAFAFA;
            animation: scale_header 0.6s cubic-bezier(.55, 0, .1, 1), text_opacity 1s cubic-bezier(.55, 0, .1, 1);
            box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.14),
            0px 1px 5px 0px rgba(0, 0, 0, 0.12),
            0px 3px 1px -2px rgba(0, 0, 0, 0.2);
        }

        .login.error_1 > header:before,
        .login.error_2 > header:before {
            animation: error_before 3s cubic-bezier(.55, 0, .1, 1);
        }

        .login.error_1 > header:before {
            content: 'Invalid username or password!';
        }

        .login.error_2 > header:before {
            content: 'Invalid or expired Token!';
        }


        .login > header h4 {
            font-size: 0.7em;
            animation: text_opacity 1.5s cubic-bezier(.55, 0, .1, 1);
            color: rgba(255, 255, 255, 0.4);
        }

        /* Form */
        .login-form {
            padding: 15px;
            box-sizing: border-box;
        }


        /* Inputs */
        .login-input {
            position: relative;
            width: 100%;
            padding: 10px 5px;
            margin: 0 0 25px 0;
            border: none;
            border-bottom: 2px solid rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
            background: transparent;
            font-size: 1rem;
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
            opacity: 1;
            animation: input_opacity 0.8s cubic-bezier(.55, 0, .1, 1);
            transition: border-bottom 0.2s cubic-bezier(.55, 0, .1, 1);
        }

        .login-input:focus {
            outline: none;
            border-bottom: 2px solid #1c2a48 ;
        }


        /* Submit Button */
        .submit-container {
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            position: relative;
            padding: 10px;
            margin: 35px -25px -25px -25px;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .login-button {
            padding: 10px;
            border: none;
            background-color: #2bbbad !important;
            border-radius: 3px;
            color:white;
            font-family: 'Roboto', sans-serif;
            font-size: 0.9rem;
            font-weight: bold;
            cursor: pointer;
            opacity: 1;
            animation: input_opacity 0.8s cubic-bezier(.55, 0, .1, 1);
            transition: background 0.2s ease-in-out;
            text-transform: uppercase;
        }

        .login-button.raised {
            padding: 5px 10px;
            color: #FAFAFA;
            background: #1c2a48 ;
            box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.137255),
            0px 1px 5px 0px rgba(0, 0, 0, 0.117647),
            0px 3px 1px -2px rgba(0, 0, 0, 0.2);
        }

        .login-button:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .login-button.raised:hover {
            background: #FDAB43;
        }

        .flexible {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .flexible h2 {
            padding: 0px;
            margin: 0px;
        }

    </style>
</head>
<body>
<div class="login-container">
    <section class="login" id="login">
        <header class="flexible">
            <img style="width: 50px; height: 50px;" src="{{asset('imagenes/icons/005-smart_home.png')}}" alt="">
            <div class="">
                <h2>Smart Home</h2>
            </div>

        </header>
        <form class="login-form" action="{{asset('login')}}" method="post">
            @csrf
            <input type="text" name="email" class="login-input" placeholder="Correo electronico" required autofocus/>
            <input type="password" name="password" class="login-input" placeholder="Contraseña" required/>
            <div class="submit-container">
                <button type="submit" class="login-button">Iniciar Sesión</button>
            </div>
        </form>
    </section>
</div>

<script>
    var form = document.getElementById('login');
    var buttonE1 = document.getElementById('e1');

    buttonE1.addEventListener('click', function () {
        form.classList.add('error_1');
        setTimeout(function () {
            form.classList.remove('error_1');
        }, 3000);
    });
</script>
</body>
</html>
