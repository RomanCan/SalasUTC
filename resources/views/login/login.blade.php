<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bienvenido</title>
    <link href="dist/css/login/login.css" rel="stylesheet" type="text/css">
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

            <!-- Login Form -->
            <form action="{{ url('log') }}" method="POST">
                @csrf
                <input type="text" id="login" class="fadeIn second" name="user" placeholder="Usuario" required>
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
