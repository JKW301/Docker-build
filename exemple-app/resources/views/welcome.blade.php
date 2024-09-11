<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="{{ asset('css/acceuil.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullpage.js@3.1.2/dist/fullpage.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js"></script>
</head>

<body style="position: relative;">

<header data-aos="fade-down" class="fp-auto-height" style="position: fixed; z-index: 1000; width: 100%;">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: transparent;">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#home-section" style="font-weight: bold; color: white; font-size: 22px;" onmouseover="this.style.color='#800080';" onmouseout="this.style.color='white';">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/login" style="font-weight: bold; color: white; font-size: 22px;" onmouseover="this.style.color='#800080';" onmouseout="this.style.color='white';">Se Connecter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dons" style="font-weight: bold; color: white; font-size: 22px;" onmouseover="this.style.color='#800080';" onmouseout="this.style.color='white';">Faire un Don</a>
            </li>
        </ul>
    </nav>
    <script>
    window.addEventListener('scroll', function() {
        var navbar = document.querySelector('.navbar');
        var scrollPosition = window.scrollY;

        if (scrollPosition > window.innerHeight) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>
</header>
<div class="section" style="background: url(images/img_page_1.jpeg) no-repeat center center; background-size: cover;">
    <div style="position: absolute; left: 0; top: 50%; transform: translateY(-50%); color: white; font-weight: bold; animation: fadeInLeft 2s; font-size: 125px; font-family: 'Varela Round', sans-serif; text-align: left; margin-left: 50px; line-height: 100px;">
        <div>Au</div>
        <div>Temps</div>
        <div>Donné</div>
    </div>
    <style>
@keyframes fadeInLeft {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
</style>
</div>
<main class="center-content">
    <div class="row">
        <div class="col-lg-12 text-left">
            <h2>Qui Nous Sommes</h2>
            <p>Au temps donnée est une association humanitaire dédiée à aider ceux qui en ont le plus besoin. Nous croyons en la force de la communauté pour apporter un changement positif, et notre équipe est composée de bénévoles dévoués prêts à faire la différence.</p>
        </div>
    </div> 
    <div class="row">
        <div class="col-lg-12 text-right">
            <h2>Nous Rejoindre</h2>
            <p>Vous pouvez nous aider de plusieurs façons. Vous pouvez faire un don ou vous pouvez nous rejoindre et aider directement dans nos efforts. Chaque personne compte, et votre engagement peut faire une grande différence dans la vie de ceux que nous servons. Rejoignez-nous dans notre mission humanitaire!</p>
        </div>
    </div>
    <div class="row1">
    <div class="col-lg-12 text-left">
        <h2>Nos services</h2>
        <p>
            Nous proposons les services suivants :
            <ul>
    <li>
        <div>
            <strong>Maraude</strong>
            <p>C'est une action qui consiste à aller à la rencontre des personnes en situation de grande précarité, pour leur apporter une aide directe.</p>
        </div>
    </li>
    <li>
        <div>
            <strong>Distribution alimentaire</strong>
            <p>Nous organisons des distributions de nourriture pour les personnes dans le besoin.</p>
        </div>
    </li>
    <li>
        <div>
            <strong>Aides aux devoirs</strong>
            <p>Nous offrons un soutien scolaire pour aider les enfants à réussir à l'école.</p>
        </div>
    </li>
    <li>
        <div>
            <strong>Cours d'alphabetisation</strong>
            <p>Nous proposons des cours pour aider les adultes à apprendre à lire et à écrire.</p>
        </div>
    </li>
    <li>
        <div>
            <strong>Assistances administratives</strong>
            <p>Nous aidons les personnes à gérer leurs documents et formalités administratives.</p>
        </div>
    </li>
    <li>
        <div>
            <strong>Collecte de dons</strong>
            <p>Nous collectons des dons pour financer nos actions et aider les personnes dans le besoin.</p>
        </div>
    </li>
</ul>
        </p>
    </div>
</div>

</main>


<div class="footer-section" id="footer">
    <footer data-aos="fade-down" style="color: white; color-size">
        <p style="text-align: center;font-size: 22px;">© 2022 Votre Entreprise. Tous les droits sont réservés.</p>
    </footer>
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script scr="/js/welcome.js"></script>

<script>
    AOS.init();
</script>

</body>

</html>


