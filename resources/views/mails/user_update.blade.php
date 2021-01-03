<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenidos</title>
    <!-- CSS only -->
    <style>
        .container {
            width: 100%;
        }

        .card{
            border: 1px solid rgba(0,0,0,0.3);
            padding: 10px 5px;
        }
        .card-body {
            padding: 10px;
        }

        .btn{
            padding: 10px;
            background-color: darkgrey;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn:hover {
            cursor: pointer;
        }

        .btn-success {
            background-color: #1c2a48 !important;
            color:white;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-body">
            <span>{{$user->nombre}} Tu cuenta de SmartHome ha sido actualizada</span>
            <br> <br>
            <span>Nombre de usuario Anteriro: {{$previusEmail}}</span> <br>
            <span>Nombre de usuario: {{$user->email}}</span> <br>
            <span>
                Contraseña:
                @if($isUpdatePassword)
                    {{$password}}
                @else
                    Tu contraseña no ha sido actualizada
                @endif
            </span>
        </div>
    </div>
</div>
</body>
</html>
