<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>JobPlatform - Plateforme emploi Sénégal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-orange: #FF8C42;
            --secondary-orange: #FF6B1A;
            --primary-brown: #8B4513;
            --secondary-brown: #A0522D;
            --dark-bg: #0a0a0a;
            --medium-dark: #1a1a1a;
            --light-gray: #f8f9fa;
            --medium-gray: #6c757d;
            --text-light: #ffffff;
            --text-dark: #212529;
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--dark-bg);
            color: var(--text-light);
            line-height: 1.6;
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--dark-bg);
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
            border-radius: 10px;
        }

        /* Animated Background */
        .bg-animated {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--dark-bg) 0%, var(--medium-dark) 50%, #2d1810 100%);
            z-index: -2;
        }

        /* Floating particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: var(--primary-orange);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
            opacity: 0.6;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Navigation */
        .navbar-custom {
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 140, 66, 0.2);
            box-shadow: 0 5px 30px rgba(0,0,0,0.3);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            margin: 0 0.3rem;
            padding: 0.6rem 1.2rem !important;
            border-radius: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-orange), var(--secondary-orange));
            transition: width 0.3s ease;
        }

        .navbar-nav .nav-link:hover::after,
        .navbar-nav .nav-link.active::after {
            width: 100%;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: white !important;
        }

        .btn-signin {
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.7rem 1.8rem;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(255, 140, 66, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-signin:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 140, 66, 0.4);
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            background: linear-gradient(rgba(10, 10, 10, 0.7), rgba(10, 10, 10, 0.7)),
                        url('https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
            background-attachment: fixed;
            transition: background-position 0.5s ease;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: var(--text-light);
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            padding: 2rem;
            animation: fadeInUp 1s ease-out;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            background: linear-gradient(45deg, var(--primary-orange), var(--text-light), var(--secondary-orange));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .hero-subtitle {
            font-size: 1.3rem;
            font-weight: 400;
            margin-bottom: 2.5rem;
            opacity: 0.9;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .btn-hero {
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
            border: none;
            color: white;
            font-weight: 600;
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            border-radius: 8px;
            box-shadow: 0 8px 30px rgba(255, 140, 66, 0.4);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .btn-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(255, 140, 66, 0.6);
        }

        /* Améliorations pour les transitions d'accueil */
        #transition-text {
            position: relative;
            height: 120px;
            margin-bottom: 2rem;
            overflow: hidden;
            perspective: 1000px;
        }

        .transition-item {
            position: absolute;
            width: 100%;
            left: 0;
            top: 0;
            opacity: 0;
            transform: translateY(50px) rotateX(20deg);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            backface-visibility: hidden;
            padding: 1rem;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .transition-item.active {
            opacity: 1;
            transform: translateY(0) rotateX(0deg);
            box-shadow: 0 20px 60px rgba(255, 140, 66, 0.1);
        }

        .transition-item.exit {
            opacity: 0;
            transform: translateY(-50px) rotateX(-20deg);
            transition: all 0.6s cubic-bezier(0.55, 0.085, 0.68, 0.53);
        }

        .transition-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg,
                rgba(255, 140, 66, 0.1) 0%,
                rgba(255, 107, 26, 0.05) 50%,
                rgba(255, 140, 66, 0.1) 100%);
            border-radius: 15px;
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: -1;
        }

        .transition-item.active::before {
            opacity: 1;
        }

        /* Indicateurs de progression */
        .transition-indicators {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 2rem;
            z-index: 3;
            position: relative;
        }

        .indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .indicator.active {
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
            transform: scale(1.2);
            box-shadow: 0 0 20px rgba(255, 140, 66, 0.5);
        }

        .indicator::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s ease;
        }

        .indicator.active::after {
            left: 100%;
        }

        /* Effet de particules pendant les transitions */
        .transition-particle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: var(--primary-orange);
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
            animation: particleFloat 2s ease-out forwards;
        }

        @keyframes particleFloat {
            0% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
            100% {
                opacity: 0;
                transform: scale(0.5) translateY(-100px);
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInFromLeft {
            from {
                opacity: 0;
                transform: translateX(-100px) rotateY(-30deg);
            }
            to {
                opacity: 1;
                transform: translateX(0) rotateY(0deg);
            }
        }

        @keyframes slideInFromRight {
            from {
                opacity: 0;
                transform: translateX(100px) rotateY(30deg);
            }
            to {
                opacity: 1;
                transform: translateX(0) rotateY(0deg);
            }
        }

        @keyframes slideInFromTop {
            from {
                opacity: 0;
                transform: translateY(-100px) rotateX(30deg);
            }
            to {
                opacity: 1;
                transform: translateY(0) rotateX(0deg);
            }
        }

        /* Sections */
        .section-padding {
            padding: 6rem 0;
            position: relative;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
            color: var(--text-light);
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
            border-radius: 2px;
        }

        /* Job Cards */
        .job-card {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .job-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
        }

        .job-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 50px rgba(255, 140, 66, 0.3);
            border-color: var(--primary-orange);
        }

        .job-card .card-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 20px rgba(255, 140, 66, 0.3);
            transition: all 0.3s ease;
        }

        .job-card:hover .card-icon {
            transform: rotate(5deg) scale(1.1);
        }

        .job-card .card-icon i {
            color: white;
            font-size: 1.5rem;
        }

        .job-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .job-description {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .job-info {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }

        .job-tag {
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .btn-apply {
            background: linear-gradient(45deg, var(--primary-brown), var(--secondary-brown));
            border: none;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-apply:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 69, 19, 0.3);
        }

        /* Stats Section */
        .stats-section {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border-top: 1px solid var(--glass-border);
            border-bottom: 1px solid var(--glass-border);
        }

        .stat-card {
            text-align: center;
            padding: 2.5rem 1.5rem;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-orange);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-light);
        }

        /* Footer */
        .footer {
            background: var(--dark-bg);
            color: var(--text-light);
            padding: 3rem 0;
            text-align: center;
            border-top: 1px solid var(--glass-border);
        }

        .footer a {
            color: var(--primary-orange);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--secondary-orange);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.8rem;
            }
            .hero-subtitle {
                font-size: 1.1rem;
            }
            #transition-text {
                height: 140px;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.2rem;
            }
            .section-title {
                font-size: 2rem;
            }
            .job-card {
                padding: 1.5rem;
            }
            .stat-card {
                padding: 2rem 1rem;
            }
            #transition-text {
                height: 160px;
            }
        }

        /* Animation for cards */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .animate-on-scroll.animate {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-animated"></div>

    <!-- Floating Particles -->
    <div class="particles"></div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <i class="fas fa-briefcase me-2"></i>JobPlatform
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#offers">Offres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-signin">
                        <i class="fas fa-user me-1"></i>Connexion
                    </a>
                    <a href="{{ route('company.login') }}" class="btn btn-signin">
                        <i class="fas fa-building me-1"></i>Espace Entreprise
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">Votre plateforme de recrutement spécialisée</h1>

                    <!-- Transition Container amélioré -->
                    <div id="transition-text">
                        <p class="lead mb-4 transition-item active">
                            Trouvez les meilleurs talents ou l'opportunité idéale grâce à notre plateforme intuitive et performante.
                        </p>
                        <p class="lead mb-4 transition-item">
                            Pour les étudiants, c'est l'accès privilégié à des offres adaptées et des entreprises qui recrutent activement dans leur domaine.
                        </p>
                        <p class="lead mb-4 transition-item">
                            Pour les entreprises, c'est la solution pour cibler des profils qualifiés et trouver les compétences dont elles ont besoin.
                        </p>
                    </div>

                    <!-- Indicateurs de progression -->
                    <div class="transition-indicators">
                        <div class="indicator active" data-index="0"></div>
                        <div class="indicator" data-index="1"></div>
                        <div class="indicator" data-index="2"></div>
                    </div>

                    <!-- Boutons -->
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <button class="btn btn-hero">
                            <i class="fas fa-search me-2"></i>Chercher un emploi
                        </button>
                        <button class="btn btn-hero">
                            <i class="fas fa-bullhorn me-2"></i>Publier une offre
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Job Offers Section -->
    <section id="offers" class="section-padding">
        <div class="container">
            <h2 class="section-title">Offres d'emploi récentes</h2>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="job-card animate-on-scroll">
                        <div class="card-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <h3 class="job-title">Développeur Web</h3>
                        <p class="job-description">Recherchons développeur web expérimenté pour rejoindre notre équipe dynamique à Dakar.</p>
                        <div class="job-info">
                            <span class="job-tag">CDI</span>
                            <span class="job-tag">Temps plein</span>
                            <span class="job-tag">Dakar</span>
                        </div>
                        <button class="btn btn-apply">
                            <i class="fas fa-paper-plane me-2"></i>Postuler
                        </button>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="job-card animate-on-scroll">
                        <div class="card-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3 class="job-title">Commercial Junior</h3>
                        <p class="job-description">Une opportunité pour jeunes diplômés ambitieux dans le domaine commercial, à Saint-Louis.</p>
                        <div class="job-info">
                            <span class="job-tag">CDD</span>
                            <span class="job-tag">6 mois</span>
                            <span class="job-tag">Saint-Louis</span>
                        </div>
                        <button class="btn btn-apply">
                            <i class="fas fa-paper-plane me-2"></i>Postuler
                        </button>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="job-card animate-on-scroll">
                        <div class="card-icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <h3 class="job-title">Assistant Marketing</h3>
                        <p class="job-description">Supportez notre équipe marketing pour la mise en œuvre des campagnes digitales.</p>
                        <div class="job-info">
                            <span class="job-tag">Stage</span>
                            <span class="job-tag">3 mois</span>
                            <span class="job-tag">Thiès</span>
                        </div>
                        <button class="btn btn-apply">
                            <i class="fas fa-paper-plane me-2"></i>Postuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section section-padding">
        <div class="container">
            <h2 class="section-title">Notre impact</h2>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card animate-on-scroll">
                        <div class="stat-number">1,250+</div>
                        <div class="stat-label">Entreprises partenaires</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card animate-on-scroll">
                        <div class="stat-number">10,000+</div>
                        <div class="stat-label">Candidats actifs</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card animate-on-scroll">
                        <div class="stat-number">5,800+</div>
                        <div class="stat-label">Offres d'emploi</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Équipe JOBPLATFORM" class="img-fluid rounded-3 shadow animate-on-scroll" style="animation-delay: 0.2s;">
                </div>
                <div class="col-lg-6">
                    <h2 class="section-title text-start animate-on-scroll">À propos de nous</h2>
                    <p class="text-white mb-4 animate-on-scroll" style="animation-delay: 0.1s;">
                        JOBPLATFORM est la première plateforme de recrutement spécialisée pour le marché sénégalais,
                        connectant les talents locaux avec les meilleures opportunités professionnelles.
                    </p>
                    <ul class="list-unstyled text-white animate-on-scroll" style="animation-delay: 0.2s;">
                        <li class="mb-3"><i class="fas fa-check-circle text-primary-orange me-2"></i> Solution adaptée aux besoins spécifiques du marché local</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-primary-orange me-2"></i> Interface intuitive et facile à utiliser</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-primary-orange me-2"></i> Accompagnement personnalisé pour candidats et recruteurs</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-primary-orange me-2"></i> Technologies avancées pour des matchings pertinents</li>
                    </ul>
                    <div class="mt-4 animate-on-scroll" style="animation-delay: 0.3s;">
                        <a href="#contact" class="btn btn-hero">
                            <i class="fas fa-envelope me-2"></i>Nous contacter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section-padding">
        <div class="container">
            <h2 class="section-title">Contactez-nous</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="job-card">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label text-white">Nom complet</label>
                                    <input type="text" class="form-control bg-transparent text-white" id="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label text-white">Email</label>
                                    <input type="email" class="form-control bg-transparent text-white" id="email" required>
                                </div>
                                <div class="col-12">
                                    <label for="subject" class="form-label text-white">Sujet</label>
                                    <input type="text" class="form-control bg-transparent text-white" id="subject" required>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label text-white">Message</label>
                                    <textarea class="form-control bg-transparent text-white" id="message" rows="5" required></textarea>
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-hero">
                                        <i class="fas fa-paper-plane me-2"></i>Envoyer
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h3 class="text-white mb-4">JOBPLATFORM</h3>
                    <p>La plateforme de recrutement leader au Sénégal, connectant talents et opportunités depuis 2023.</p>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h4 class="text-white mb-4">Liens rapides</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#home">Accueil</a></li>
                        <li class="mb-2"><a href="#offers">Offres</a></li>
                        <li class="mb-2"><a href="#about">À propos</a></li>
                        <li class="mb-2"><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h4 class="text-white mb-4">Contact</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2 text-primary-orange"></i> Dakar, Sénégal</li>
                        <li class="mb-2"><i class="fas fa-phone me-2 text-primary-orange"></i> +221 33 123 45 67</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2 text-primary-orange"></i> contact@jobplatform.sn</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Réseaux sociaux</h4>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white fs-4"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white fs-4"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white fs-4"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-white fs-4"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 bg-glass-border">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; 2023 JOBPLATFORM. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-white me-3">Politique de confidentialité</a>
                    <a href="#" class="text-white">Conditions d'utilisation</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        // Animation for particles
        function createParticles() {
            const particlesContainer = document.querySelector('.particles');
            const particleCount = 30;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                // Random position
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;

                // Random size
                const size = Math.random() * 5 + 2;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;

                // Random animation duration
                particle.style.animationDuration = `${Math.random() * 10 + 5}s`;
                particle.style.animationDelay = `${Math.random() * 5}s`;

                particlesContainer.appendChild(particle);
            }
        }

        // Text transition animation
        function setupTextTransition() {
            const transitionItems = document.querySelectorAll('.transition-item');
            const indicators = document.querySelectorAll('.indicator');
            let currentIndex = 0;

            function changeText(index) {
                // Remove active class from all items and indicators
                transitionItems.forEach(item => item.classList.remove('active'));
                indicators.forEach(ind => ind.classList.remove('active'));

                // Add exit class to current item
                transitionItems[currentIndex].classList.add('exit');

                // After exit animation completes, remove exit class and set new active item
                setTimeout(() => {
                    transitionItems[currentIndex].classList.remove('exit');
                    currentIndex = index;
                    transitionItems[currentIndex].classList.add('active');
                    indicators[currentIndex].classList.add('active');
                }, 600);
            }

            // Set click event for indicators
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    if (index !== currentIndex) {
                        changeText(index);
                    }
                });
            });

            // Auto transition every 5 seconds
            setInterval(() => {
                const nextIndex = (currentIndex + 1) % transitionItems.length;
                changeText(nextIndex);
            }, 5000);
        }

        // Animate on scroll
        function animateOnScroll() {
            const elements = document.querySelectorAll('.animate-on-scroll');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            elements.forEach(element => {
                observer.observe(element);
            });
        }

        // Initialize all animations when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
            setupTextTransition();
            animateOnScroll();
        });
    </script>
</body>
</html>
