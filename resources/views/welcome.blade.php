<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Système de Gestion Scolaire</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #ff6b6b 0%, #feca57 100%);
            --success-gradient: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
            --info-gradient: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: var(--primary-gradient);
            position: relative;
            overflow-x: hidden;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="white" opacity="0.1"/><circle cx="80" cy="80" r="1" fill="white" opacity="0.1"/><circle cx="40" cy="60" r="1" fill="white" opacity="0.05"/><circle cx="60" cy="40" r="1" fill="white" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            z-index: -1;
        }
        
        .welcome-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        
        .auth-navigation {
            position: fixed;
            top: 2rem;
            right: 2rem;
            z-index: 1000;
        }
        
        .auth-navigation .btn {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            margin-left: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
            font-weight: 500;
        }
        
        .auth-navigation .btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            color: white;
        }
        
        .welcome-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            max-width: 1200px;
            width: 100%;
            animation: fadeInUp 0.8s ease-out;
        }
        
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
        
        .welcome-header {
            background: var(--primary-gradient);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
        }
        
        .welcome-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain2" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="25" cy="75" r="1" fill="white" opacity="0.05"/><circle cx="75" cy="25" r="1" fill="white" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain2)"/></svg>');
        }
        
        .welcome-header .logo {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            position: relative;
            z-index: 1;
        }
        
        .welcome-header h1 {
            margin: 0;
            font-weight: 700;
            font-size: 2.5rem;
            position: relative;
            z-index: 1;
            margin-bottom: 0.5rem;
        }
        
        .welcome-header p {
            margin: 0;
            opacity: 0.9;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }
        
        .welcome-body {
            padding: 3rem 2rem;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .feature-card {
            background: #f8f9fa;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .feature-card .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: white;
        }
        
        .feature-card:nth-child(1) .feature-icon {
            background: var(--info-gradient);
        }
        
        .feature-card:nth-child(2) .feature-icon {
            background: var(--success-gradient);
        }
        
        .feature-card:nth-child(3) .feature-icon {
            background: var(--secondary-gradient);
        }
        
        .feature-card:nth-child(4) .feature-icon {
            background: var(--primary-gradient);
        }
        
        .feature-card h3 {
            margin-bottom: 1rem;
            font-weight: 600;
            color: #212529;
        }
        
        .feature-card p {
            color: #6c757d;
            margin: 0;
            line-height: 1.6;
        }
        
        .cta-section {
            text-align: center;
            padding: 2rem;
            background: #f8f9fa;
            border-radius: 16px;
            margin-top: 2rem;
        }
        
        .cta-section h2 {
            margin-bottom: 1rem;
            font-weight: 600;
            color: #212529;
        }
        
        .cta-section p {
            color: #6c757d;
            margin-bottom: 2rem;
        }
        
        .btn-primary-gradient {
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            padding: 0.875rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            margin: 0 0.5rem;
        }
        
        .btn-primary-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        .btn-secondary-gradient {
            background: var(--secondary-gradient);
            border: none;
            border-radius: 12px;
            padding: 0.875rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            margin: 0 0.5rem;
        }
        
        .btn-secondary-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 107, 107, 0.4);
            color: white;
        }
        
        @media (max-width: 768px) {
            .welcome-header h1 {
                font-size: 2rem;
            }
            
            .welcome-header,
            .welcome-body {
                padding: 2rem 1.5rem;
            }
            
            .auth-navigation {
                position: static;
                text-align: center;
                margin-bottom: 2rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @if (Route::has('login'))
        <div class="auth-navigation">
            @auth
                <a href="{{ url('/tableau-bord') }}" class="btn">
                    <i class="fas fa-home me-1"></i>
                    Tableau de bord
                </a>
            @else
                <a href="{{ route('connexion') }}" class="btn">
                    <i class="fas fa-sign-in-alt me-1"></i>
                    Se connecter
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('inscription') }}" class="btn">
                        <i class="fas fa-user-plus me-1"></i>
                        S'inscrire
                    </a>
                @endif
            @endauth
        </div>
    @endif

    <div class="welcome-container">
        <div class="welcome-card">
            <div class="welcome-header">
                <div class="logo">
                    <i class="fas fa-graduation-cap fa-2x"></i>
                </div>
                <h1>Système de Gestion Scolaire</h1>
                <p>Plateforme moderne pour la gestion complète des établissements scolaires</p>
            </div>
            
            <div class="welcome-body">
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Gestion des Étudiants</h3>
                        <p>Gérez facilement les inscriptions, profils et informations académiques de tous vos étudiants avec un système intuitif et sécurisé.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h3>Gestion des Enseignants</h3>
                        <p>Organisez les plannings, matières et évaluations de votre corps enseignant avec des outils modernes et efficaces.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h3>Suivi des Performances</h3>
                        <p>Analysez les résultats scolaires, générez des rapports détaillés et suivez la progression académique en temps réel.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3>Planning & Organisation</h3>
                        <p>Planifiez les cours, examens et événements scolaires avec un système de calendrier intégré et collaboratif.</p>
                    </div>
                </div>
                
                <div class="cta-section">
                    <h2>Prêt à moderniser votre gestion scolaire ?</h2>
                    <p>Rejoignez notre plateforme et découvrez les outils qui transformeront votre établissement.</p>
                    
                    <div class="cta-buttons">
                        @guest
                            <a href="{{ route('inscription') }}" class="btn-primary-gradient">
                                <i class="fas fa-rocket"></i>
                                Commencer maintenant
                            </a>
                            <a href="{{ route('connexion') }}" class="btn-secondary-gradient">
                                <i class="fas fa-sign-in-alt"></i>
                                Se connecter
                            </a>
                        @else
                            <a href="{{ url('/tableau-bord') }}" class="btn-primary-gradient">
                                <i class="fas fa-tachometer-alt"></i>
                                Accéder au tableau de bord
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
