<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Page d’Accueil Entreprise - JOBPLATFORM</title>
    <style>
        /* === RESET & BASE === */
        *, *::before, *::after {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #d9e6f7 100%);
            color: #003366;
            line-height: 1.6;
            scroll-behavior: smooth;
        }
        a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        a:hover, a:focus {
            color: #0056b3;
            outline: none;
        }
        h1, h2, h3, h4 {
            margin: 0 0 1rem 0;
            font-weight: 700;
            color: #002244;
        }
        p {
            margin: 0 0 1rem 0;
        }
        button {
            cursor: pointer;
        }

        /* === CONTAINER === */
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 2rem;
        }

        /* === HEADER - NAVIGATION + HERO === */
        header {
            position: sticky;
            top: 0;
            background: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            max-width: 1200px;
            margin: auto;
        }
        .logo {
            font-size: 1.8rem;
            font-weight: 900;
            color: #007bff;
            letter-spacing: 2px;
            user-select: none;
        }
        nav ul {
            list-style: none;
            display: flex;
            gap: 2rem;
            margin: 0;
            padding: 0;
        }
        nav ul li {
            font-weight: 600;
            font-size: 1rem;
        }
        nav ul li a {
            padding: 0.3rem 0.5rem;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }
        nav ul li a:hover,
        nav ul li a:focus {
            background-color: #007bff;
            color: white;
        }
        .btn-signin {
            background-color: #007bff;
            color: white;
            padding: 0.6rem 1.3rem;
            border: none;
            border-radius: 15px;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: 0 6px 15px rgba(0,123,255,0.6);
            transition: background-color 0.3s ease, transform 0.2s ease;
            user-select: none;
        }
        .btn-signin:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* HERO */
        .hero {
            background: url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
            height: 500px;
            border-radius: 0 0 50px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 0 1rem;
            box-shadow: inset 0 0 80px rgba(0,0,0,0.7);
            margin-bottom: 4rem;
            position: relative;
        }
        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.8);
            letter-spacing: 2px;
        }
        .hero p {
            font-size: 1.4rem;
            max-width: 700px;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 6px rgba(0,0,0,0.6);
        }
        .btn-primary {
            background: linear-gradient(90deg, #007bff, #66d9ff);
            border: none;
            padding: 1rem 2.5rem;
            font-size: 1.3rem;
            font-weight: 700;
            border-radius: 30px;
            color: white;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(0,123,255,0.8);
            transition: background 0.3s ease, transform 0.2s ease;
            user-select: none;
            text-transform: uppercase;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #0056b3, #3399ff);
            transform: scale(1.1);
        }

        /* === SECTIONS === */
        section {
            margin-bottom: 5rem;
        }

        /* OFFRES */
        .offers h2 {
            text-align: center;
            margin-bottom: 3rem;
            color: #004080;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-size: 2.3rem;
        }
        .offers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit,minmax(320px,1fr));
            gap: 2.5rem;
        }
        .offer-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        .offer-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: -60%;
            width: 200%;
            height: 100%;
            background: linear-gradient(120deg, transparent, #007bff33, transparent);
            transform: skewX(-20deg);
            transition: left 0.7s ease;
            pointer-events: none;
        }
        .offer-card:hover::after {
            left: 100%;
        }
        .offer-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        }
        .offer-title {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #0056b3;
            user-select: none;
        }
        .offer-desc {
            flex-grow: 1;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            color: #333;
            line-height: 1.4;
            user-select: text;
        }
        .offer-info {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1.5rem;
            user-select: none;
        }
        .offer-btn {
            background: linear-gradient(90deg, #007bff, #66d9ff);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            font-weight: 700;
            border-radius: 15px;
            text-align: center;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(0,123,255,0.8);
            user-select: none;
            transition: background 0.3s ease, transform 0.3s ease;
        }
        .offer-btn:hover {
            background: linear-gradient(90deg, #0056b3, #3399ff);
            transform: scale(1.05);
        }

        /* STATS */
        .stats {
            background: white;
            padding: 4rem 2rem;
            border-radius: 25px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            margin-bottom: 5rem;
            text-align: center;
        }
        .stats h2 {
            margin-bottom: 3rem;
            color: #004080;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-size: 2.4rem;
            user-select: none;
        }
        .stats-grid {
            display: flex;
            justify-content: center;
            gap: 4rem;
            flex-wrap: wrap;
        }
        .stat-item {
            flex: 1 1 150px;
            font-weight: 700;
            font-size: 3rem;
            color: #007bff;
            user-select: text;
        }
        .stat-label {
            font-weight: 600;
            font-size: 1rem;
            color: #444;
            margin-top: 0.5rem;
            user-select: none;
        }

        /* FOOTER */
        footer {
            background-color: #003366;
            color: white;
            text-align: center;
            padding: 1rem 0;
            user-select: none;
        }
        footer a {
            color: #66ccff;
            text-decoration: underline;
        }
        footer a:hover,
        footer a:focus {
            color: #cceeff;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            .hero p {
                font-size: 1.1rem;
            }
            nav ul {
                gap: 1rem;
            }
            .stats-grid {
                flex-direction: column;
                gap: 2rem;
            }
        }
    </style>
</head>
<body>
    <header role="banner">
        <nav role="navigation" aria-label="Menu principal">
            <div class="logo" tabindex="0" aria-label="Logo JobPlatform">JOBPLATFORM</div>
            <ul>
                <li><a href="{{ url('/') }}" tabindex="0" aria-label="Accueil">Accueil</a></li>
                <li><a href="{{ url('/offers') }}" tabindex="0" aria-label="Offres d'emploi">Offres d'emploi</a></li>
                <li><a href="{{ url('/about') }}" tabindex="0" aria-label="À propos">À propos</a></li>
                <li><a href="{{ url('/contact') }}" tabindex="0" aria-label="Contact">Contact</a></li>
            </ul>
            <a href="{{ route('login') }}" class="btn-signin" tabindex="0" aria-label="Se connecter">Se connecter</a>
        </nav>
    </header>

    <main role="main" class="container">
        <section class="hero" aria-label="Section d’introduction">
            <h1 tabindex="0">Trouvez votre job idéal, dès maintenant</h1>
            <p tabindex="0">Rejoignez des milliers d’entreprises et candidats sur notre plateforme simple, rapide et efficace.</p>
            <a href="{{ url('/offers') }}" class="btn-primary" tabindex="0" aria-label="Voir les offres d'emploi">Voir les offres</a>
        </section>

        <section class="offers" aria-labelledby="offers-title">
            <h2 id="offers-title">Offres d’emploi récentes</h2>
            <div class="offers-grid" role="list">
                <article class="offer-card" role="listitem" tabindex="0" aria-label="Offre d’emploi Développeur Web à Dakar">
                    <h3 class="offer-title">Développeur Web</h3>
                    <p class="offer-desc">Recherchons développeur web expérimenté pour rejoindre notre équipe dynamique à Dakar.</p>
                    <p class="offer-info">CDI - Temps plein - Dakar</p>
                    <button class="offer-btn" aria-label="Postuler à l’offre Développeur Web">Postuler</button>
                </article>
                <article class="offer-card" role="listitem" tabindex="0" aria-label="Offre d’emploi Commercial Junior à Saint-Louis">
                    <h3 class="offer-title">Commercial Junior</h3>
                    <p class="offer-desc">Une opportunité pour jeunes diplômés ambitieux dans le domaine commercial, à Saint-Louis.</p>
                    <p class="offer-info">CDD - 6 mois - Saint-Louis</p>
                    <button class="offer-btn" aria-label="Postuler à l’offre Commercial Junior">Postuler</button>
                </article>
                <article class="offer-card" role="listitem" tabindex="0" aria-label="Offre d’emploi Assistant Marketing à Thiès">
                    <h3 class="offer-title">Assistant Marketing</h3>
                    <p class="offer-desc">Supportez notre équipe marketing pour la mise en œuvre des campagnes digitales.</p>
                    <p class="offer-info">Stage - 3 mois - Thiès</p>
                    <button class="offer-btn" aria-label="Postuler à l’offre Assistant Marketing">Postuler</button>
                </article>
            </div>
        </section>

        <section class="stats" aria-label="Statistiques de la plateforme">
            <h2 tabindex="0">Statistiques clés</h2>
            <div class="stats-grid">
                <div>
                    <div class="stat-item" aria-live="polite">1,250+</div>
                    <div class="stat-label">Entreprises</div>
                </div>
                <div>
                    <div class="stat-item" aria-live="polite">10,000+</div>
                    <div class="stat-label">Candidats</div>
                </div>
                <div>
                    <div class="stat-item" aria-live="polite">5,800+</div>
                    <div class="stat-label">Offres d’emploi</div>
                </div>
            </div>
        </section>
    </main>

    <footer role="contentinfo">
        <p tabindex="0">&copy; 2025 JOBPLATFORM — <a href="{{ url('/privacy') }}" aria-label="Politique de confidentialité">Politique de confidentialité</a></p>
    </footer>
</body>
</html>
