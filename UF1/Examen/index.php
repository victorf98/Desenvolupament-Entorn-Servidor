<?php
    session_start();
    //Si hi ha una hora de login guardada o no hem fet logout entrarem
    if (isset($_SESSION["hora_login"]) && !isset($_GET["logout"]) && isset($_SESSION["nom"])) {
        //Calculem que portem 60 segons o menys per redirigir automàticament
        if (time() - $_SESSION["hora_login"] <= 60) {
            header("Location: hola.php");
        }else {
            unset($_SESSION["hora_login"]);
            header("Location: index.php");
        }
    }else {
        unset($_SESSION["nom"]);
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Accés</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">

</head>
<body>
    <?php
        /**
         * Si hi ha un missatge d'error fet apareixerà,
         * sino no apareix res
         */
        if (isset($_GET["missatge_error"])) { ?>
        <div class="container-notifications">
            <p class="hide" id="message" style="background: linear-gradient(to right, #FF4B2B, #FF416C);
            padding: 10px; border-radius: 10px; font-size: 18px; font-weight: bold; color: #FFFFFF; 
            transition: opacity 1.5s;"><?php echo $_GET["missatge_error"] ?></p>
        </div>
    <?php
        }
    ?>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="process.php" method="post">
                <h1>Registra't</h1>
                <span>crea un compte d'usuari</span>
                <input type="hidden" name="method" value="signup"/>
                <input type="text" name="nom" placeholder="Nom" />
                <input type="email" name="email" placeholder="Correu electronic" />
                <input type="password" name="password" placeholder="Contrasenya" />
                <button>Registra't</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="process.php" method="post">
                <h1>Inicia la sessió</h1>
                <span>introdueix les teves credencials</span>
                <input type="hidden" name="method" value="signin"/>
                <input type="email" name="email" placeholder="Correu electronic" />
                <input type="password" name="password" placeholder="Contrasenya" />
                <button>Inicia la sessió</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Ja tens un compte?</h1>
                    <p>Introdueix les teves dades per connectar-nos de nou</p>
                    <button class="ghost" id="signIn">Inicia la sessió</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Primera vegada per aquí?</h1>
                    <p>Introdueix les teves dades i crea un nou compte d'usuari</p>
                    <button class="ghost" id="signUp">Registra't</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    //Funcio perquè el missatge d'error desapareixi
    function amagaError(){
        if(document.getElementById("message"))
            document.getElementById("message").style.opacity = "0";
    }

    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });

    setTimeout(amagaError, 2000);

</script>
</html>
<?php
    }
?>