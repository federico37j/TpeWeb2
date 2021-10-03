<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{BASE_URL}" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;1,700&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="img/el_eco_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    
    <title>El Eco</title>
</head>

<body>

    <header id="header">
        <div class="contenedor-arriba-header container">
            <article class="contenedor-redes">
                <ul>
                    <li><a href="https://www.facebook.com/elecodetandil/" target="_blank">
                            <ion-icon name="logo-facebook"></ion-icon>
                        </a></li>
                    <li><a href="https://twitter.com/elecotandil/" target="_blank">
                            <ion-icon name="logo-twitter"></ion-icon>
                        </a></li>
                    <li><a href="https://www.youtube.com/user/elecodetandil/" target="_blank">
                            <ion-icon name="logo-youtube"></ion-icon>
                        </a></li>
                    <li><a href="https://www.instagram.com/elecodetandil/" target="_blank">
                            <ion-icon name="logo-instagram"></ion-icon>
                        </a></li>
                </ul>
            </article>
            <article class="temperatura">
                <p>18.6 ºC</p>
                <a href="logout"><ion-icon name="log-out-outline"></ion-icon></a>
            </article>
        </div>
        <div class="contenedor-logo">
            <a href="home"><img class="logo-principal" src="img/el_eco_logo.png" alt="Logo"></a>
        </div>
        <div class="contenedor-medio-header container">
            <article class="contenedor-fecha-accesos">
                <div class="text-center">
                    <p>Viernes, 04 de Junio de 2021 │ Tandil, Buenos Aires</p>
                </div>
                <div class="accesos">
                    <ion-icon name="newspaper-outline"></ion-icon>
                    <p>EDICIÓN IMPRESA</p>
                    <ion-icon name="tv-outline"></ion-icon>
                    <p>TV EN VIVO</p>
                    <ion-icon name="mic-outline"></ion-icon>
                    <p>RADIO EN VIVO</p>
                </div>
            </article>
        </div>
        <div class="contenedor-medio-header-mobile container">
            <div class="contenedor-logo-menu">
                <div class="contenedor-btn-menu">
                    <button id="btn-menu-barras">
                        <ion-icon name="reorder-four-outline" role="img" class="md hydrated"
                            aria-label="reorder four outline"></ion-icon>
                    </button>
                </div>
                <div class="contenedor-logo">
                    <a href="home"><img src="img/el_eco_logo.png" alt="Logo"></a>
                </div>
            </div>
            <div class="contenedor-accesos">
                <article class="accesos">
                    <ion-icon name="newspaper-outline"></ion-icon>
                    <ion-icon class="tv" name="tv-outline"></ion-icon>
                    <ion-icon name="mic-outline"></ion-icon>
                </article>
            </div>
        </div>
    </header>
    <nav>
        <section class="contenedor-bajo-header ocultar">
            <ul class="botonera">
                <li><a href="home">HOME</a></li>
                <li><a href="#">CONTACTO</a></li>
                <li><a href="login">ACCEDER</a></li>
                {* <li class="administrador"><a href="admin">ADMIN</a></li> *}
            </ul>
        </section>
</nav>

<article class="lo-ultimo container">
    <p class="titulo-lo-ultimo">+ INFORME CORONAVIRUS EN TANDIL +</p>
    <p class="noticia-lo-ultimo">Se registraron 39 nuevos contagios y aumentó la ocupación de camas</p>
</article>