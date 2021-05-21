<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bienvenido</title>
    <link href="dist/css/login/login.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
</head>

<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->
            <h2 class="active"> Inicio de sesión </h2>

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="dist/img/login.jpg" id="icon" alt="User Icon" />
            </div>

            @if ($errors->any())

                <div class="alert alert-danger">
                    <ul style="list-style: none">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            @endif
            <!-- Login Form -->
            <form action="{{ url('log') }}" method="POST">
                @csrf
                <input type="text" name="user" id="login" class="fadeIn second" placeholder="Usuario"
                    value="{{ old('user') }}" required autofocus>
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="Contraseña"
                    required>
                <input type="submit" class="fadeIn fourth" value="Ingresar">
            </form>

            <!-- Remind Passowrd -->
            <!-- <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div> -->

        </div>
    </div>
</body>

</html>
