<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Page d'Accueil Entreprise - JOBPLATFORM</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-orange: #FF8C42;
            --secondary-orange: #FF6B1A;
            --primary-brown: #8B4513;
            --secondary-brown: #A0522D;
            --dark-bg: #1a1a1a;
            --medium-dark: #2d2d2d;
            --light-gray: #f8f9fa;
            --medium-gray: #6c757d;
            --text-light: #ffffff;
            --text-dark: #212529;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--light-gray) 0%, #e9ecef 100%);
            color: var(--text-dark);
            line-height: 1.6;
            scroll-behavior: smooth;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--light-gray);
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
            border-radius: 10px;
        }

        /* Navigation */
        .navbar-custom {
            background: linear-gradient(135deg, var(--dark-bg) 0%, var(--medium-dark) 100%);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 2px;
        }

        .navbar-nav .nav-link {
            color: var(--text-light) !important;
            font-weight: 600;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
            transition: all 0.3s ease;
            z-index: -1;
        }

        .navbar-nav .nav-link:hover::before {
            left: 0;
        }

        .btn-signin {
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
            border: none;
            color: white;
            font-weight: 700;
            padding: 0.7rem 1.5rem;
            border-radius: 30px;
            box-shadow: 0 6px 20px rgba(255, 140, 66, 0.4);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-signin:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 140, 66, 0.6);
            background: linear-gradient(45deg, var(--secondary-orange), var(--primary-orange));
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--dark-bg) 0%, var(--medium-dark) 50%, var(--primary-brown) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=1600&q=80') center/cover;
            opacity: 0.1;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: var(--text-light);
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            background: linear-gradient(45deg, var(--primary-orange), var(--text-light), var(--secondary-orange));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero-subtitle {
            font-size: 1.4rem;
            font-weight: 400;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .btn-hero {
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
            border: none;
            color: white;
            font-weight: 700;
            padding: 1rem 2.5rem;
            font-size: 1.2rem;
            border-radius: 50px;
            box-shadow: 0 8px 30px rgba(255, 140, 66, 0.5);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .btn-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(255, 140, 66, 0.7);
            background: linear-gradient(45deg, var(--secondary-orange), var(--primary-orange));
        }

        /* Floating Animation */
        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        /* Sections */
        .section-padding {
            padding: 5rem 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
            border-radius: 2px;
        }

        /* Job Cards */
        .job-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 140, 66, 0.1);
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
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }

        .job-card .card-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 20px rgba(255, 140, 66, 0.3);
        }

        .job-card .card-icon i {
            color: white;
            font-size: 1.5rem;
        }

        .job-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary-brown);
            margin-bottom: 1rem;
        }

        .job-description {
            color: var(--medium-gray);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .job-info {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .job-tag {
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .btn-apply {
            background: linear-gradient(45deg, var(--primary-brown), var(--secondary-brown));
            border: none;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-apply:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 69, 19, 0.4);
            background: linear-gradient(45deg, var(--secondary-brown), var(--primary-brown));
        }

        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, var(--dark-bg) 0%, var(--medium-dark) 100%);
            color: var(--text-light);
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 140, 66, 0.1);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(45deg, var(--primary-orange), var(--secondary-orange));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.1rem;
            font-weight: 600;
            opacity: 0.9;
        }

        /* Footer */
        .footer {
            background: var(--dark-bg);
            color: var(--text-light);
            padding: 2rem 0;
            text-align: center;
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
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-subtitle {
                font-size: 1.1rem;
            }
            .section-title {
                font-size: 2rem;
            }
        }

        /* Animation for cards */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .animate-on-scroll.animate {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#" tabindex="0">JOBPLATFORM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" tabindex="0">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#offers" tabindex="0">Offres d'emploi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about" tabindex="0">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact" tabindex="0">Contact</a>
                    </li>
                </ul>
                <button class="btn btn-signin" tabindex="0">
                    <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="hero-title floating">Trouvez votre job idéal</h1>
                        <p class="hero-subtitle">Rejoignez des milliers d'entreprises et candidats sur notre plateforme innovante, simple et efficace.</p>
                        <button class="btn btn-hero">
                            <i class="fas fa-search me-2"></i>Découvrir les offres
                        </button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center">
                        <i class="fas fa-briefcase" style="font-size: 15rem; color: rgba(255, 140, 66, 0.3);"></i>
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
            <h2 class="section-title text-white">Statistiques clés</h2>
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

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 JOBPLATFORM — <a href="#" aria-label="Politique de confidentialité">Politique de confidentialité</a></p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Navbar background change on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.style.background = 'linear-gradient(135deg, rgba(26, 26, 26, 0.95) 0%, rgba(45, 45, 45, 0.95) 100%)';
            } else {
                navbar.style.background = 'linear-gradient(135deg, var(--dark-bg) 0%, var(--medium-dark) 100%)';
            }
        });
    </script>
</body>
</html>
