<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <meta name="description" content="Système de gestion scolaire moderne pour la consultation des relevés de notes et la gestion académique">
    <meta name="theme-color" content="#2563eb">
    <title>{{ config('school.school_name', 'Système de Gestion Scolaire') }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.0.0/css/flag-icons.min.css">
    
    @include('components.public-styles')
    
    <style>
        /* Remove navbar styles as they're now in public-styles */
        
        .hero {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: linear-gradient(135deg, transparent 0%, rgba(37, 99, 235, 0.03) 100%);
            pointer-events: none;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .hero p {
            font-size: 1.25rem;
            color: #4b5563;
            margin-bottom: 2rem;
            max-width: 600px;
        }
        
        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .btn-large {
            padding: 0.875rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }
        
        .btn-large-primary {
            background: #2563eb;
            color: white;
        }
        
        .btn-large-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            color: white;
        }
        
        .btn-large-secondary {
            background: white;
            color: #1a1a1a;
            border: 1px solid #e5e7eb;
        }
        
        .btn-large-secondary:hover {
            background: #f9fafb;
            border-color: #d1d5db;
            color: #1a1a1a;
        }
        
        .search-section {
            padding: 4rem 0;
            background: white;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.75rem;
        }
        
        .section-subtitle {
            font-size: 1.125rem;
            color: #6b7280;
        }
        
        .search-card {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.9375rem;
        }
        
        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s;
            font-family: inherit;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        /* Prevent zoom on input focus for iOS */
        @media screen and (max-width: 576px) {
            .form-control,
            .form-label,
            .btn-submit {
                font-size: 16px;
            }
        }
        
        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .btn-submit:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        
        .info-box {
            margin-top: 1.5rem;
            padding: 1rem 1.25rem;
            background: #f0f9ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }
        
        .info-box i {
            color: #2563eb;
            margin-top: 0.125rem;
        }
        
        .info-box p {
            margin: 0;
            color: #1e40af;
            font-size: 0.9375rem;
        }
        
        .features-section {
            padding: 4rem 0;
            background: #f8fafc;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            border-color: #d1d5db;
        }
        
        .feature-icon {
            width: 56px;
            height: 56px;
            background: #eff6ff;
            color: #2563eb;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
        }
        
        .feature-card h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 0.75rem;
        }
        
        .feature-card p {
            color: #6b7280;
            font-size: 0.9375rem;
            margin: 0;
            line-height: 1.6;
        }
        
        .footer {
            background: #1a1a1a;
            color: #9ca3af;
            padding: 3rem 0 1.5rem;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .footer-section h4 {
            color: white;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .footer-section p,
        .footer-section a {
            color: #9ca3af;
            text-decoration: none;
            font-size: 0.9375rem;
            display: block;
            margin-bottom: 0.5rem;
            transition: color 0.2s;
        }
        
        .footer-section a:hover {
            color: #2563eb;
        }
        
        .footer-bottom {
            border-top: 1px solid #374151;
            padding-top: 1.5rem;
            text-align: center;
            font-size: 0.875rem;
        }
        
        .alert {
            padding: 1rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }
        
        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }
        
        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }
        
        .alert .btn-close {
            margin-left: auto;
            background: transparent;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            opacity: 0.5;
        }
        
        .alert .btn-close:hover {
            opacity: 1;
        }
        
        /* Responsive Design - Mobile First Approach */
        
        /* Small devices (landscape phones, 576px and up) */
        @media (max-width: 576px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            .hero {
                padding: 2.5rem 0;
            }
            
            .hero h1 {
                font-size: 1.75rem;
                margin-bottom: 1rem;
            }
            
            .hero p {
                font-size: 1rem;
                margin-bottom: 1.5rem;
            }
            
            .btn-large {
                padding: 0.75rem 1.5rem;
                font-size: 0.9375rem;
                width: 100%;
                justify-content: center;
            }
            
            .hero-actions {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .section-subtitle {
                font-size: 1rem;
            }
            
            .search-card {
                padding: 1.5rem;
            }
            
            .features-section,
            .search-section {
                padding: 2.5rem 0;
            }
            
            .section-header {
                margin-bottom: 2rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                margin-top: 2rem;
            }
            
            .feature-card {
                padding: 1.5rem;
            }
            
            .footer {
                padding: 2rem 0 1rem;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .footer-section {
                text-align: center;
            }
        }
        
        /* Medium devices (tablets, 768px and up) */
        @media (min-width: 577px) and (max-width: 768px) {
            .hero {
                padding: 3.5rem 0;
            }
            
            .hero h1 {
                font-size: 2.25rem;
            }
            
            .hero p {
                font-size: 1.125rem;
            }
            
            .btn-large {
                padding: 0.75rem 1.75rem;
            }
            
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.75rem;
            }
            
            .search-card {
                padding: 2rem;
            }
            
            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        /* Large devices (desktops, 992px and up) */
        @media (min-width: 769px) and (max-width: 992px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 1.125rem;
            }
            
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        /* Extra large devices (large desktops, 1200px and up) */
        @media (min-width: 1200px) {
            .container {
                max-width: 1140px;
            }
            
            .hero h1 {
                font-size: 3.25rem;
            }
            
            .features-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        /* Ultra large devices (extra large desktops, 1400px and up) */
        @media (min-width: 1400px) {
            .container {
                max-width: 1320px;
            }
        }
        
        /* Landscape orientation fixes */
        @media (max-height: 600px) and (orientation: landscape) {
            .hero {
                padding: 2rem 0;
            }
            
            .hero h1 {
                font-size: 1.75rem;
                margin-bottom: 0.75rem;
            }
            
            .hero p {
                font-size: 1rem;
                margin-bottom: 1rem;
            }
            
            .search-section,
            .features-section {
                padding: 2rem 0;
            }
        }
        
        /* Print styles */
        @media print {
            .navbar,
            .hero-actions,
            .search-section,
            .footer {
                display: none;
            }
            
            .hero {
                padding: 1rem 0;
            }
        }
        
        /* RTL Support for Arabic */
        html[dir="rtl"] {
            text-align: right;
        }
        
        html[dir="rtl"] .navbar-brand {
            flex-direction: row-reverse;
        }
        
        html[dir="rtl"] .lang-switcher {
            margin-left: 0;
            margin-right: auto;
        }
        
        html[dir="rtl"] .lang-switcher .dropdown-toggle::after {
            margin-left: 0;
            margin-right: 0.5rem;
        }
        
        html[dir="rtl"] .lang-switcher .dropdown-menu {
            text-align: right;
        }
        
        html[dir="rtl"] .lang-switcher .dropdown-item {
            flex-direction: row-reverse;
        }
        
        html[dir="rtl"] .lang-switcher .dropdown-item .fi {
            margin-right: 0;
            margin-left: 0.5rem;
        }
        
        /* Hero Section RTL */
        html[dir="rtl"] .hero::before {
            right: auto;
            left: 0;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.03) 0%, transparent 100%);
        }
        
        html[dir="rtl"] .hero-content {
            text-align: right;
        }
        
        html[dir="rtl"] .hero h1 {
            text-align: right;
        }
        
        html[dir="rtl"] .hero p {
            text-align: right;
        }
        
        html[dir="rtl"] .btn-large {
            flex-direction: row-reverse;
        }
        
        html[dir="rtl"] .btn-large i {
            margin-right: 0;
            margin-left: 0.5rem;
        }
        
        html[dir="rtl"] .hero-actions {
            justify-content: flex-start;
        }
        
        /* Search Section RTL */
        html[dir="rtl"] .section-header {
            text-align: right;
        }
        
        html[dir="rtl"] .form-label {
            text-align: right;
        }
        
        html[dir="rtl"] .form-control {
            text-align: right;
        }
        
        html[dir="rtl"] .btn-submit {
            flex-direction: row-reverse;
        }
        
        html[dir="rtl"] .btn-submit i {
            margin-right: 0;
            margin-left: 0.5rem;
        }
        
        html[dir="rtl"] .info-box,
        html[dir="rtl"] .alert {
            flex-direction: row-reverse;
            text-align: right;
        }
        
        html[dir="rtl"] .info-box i,
        html[dir="rtl"] .alert i {
            margin-right: 0;
            margin-left: 0.75rem;
        }
        
        html[dir="rtl"] .alert .btn-close {
            margin-left: 0;
            margin-right: auto;
        }
        
        /* Features Section RTL */
        html[dir="rtl"] .feature-card {
            text-align: right;
        }
        
        html[dir="rtl"] .feature-icon {
            margin-left: auto;
            margin-right: 0;
        }
        
        /* Footer RTL */
        html[dir="rtl"] .footer-section {
            text-align: right;
        }
        
        html[dir="rtl"] .footer-bottom {
            text-align: center;
        }
        
        @media (max-width: 576px) {
            html[dir="rtl"] .navbar .d-flex {
                align-items: flex-end !important;
            }
            
            html[dir="rtl"] .footer-section {
                text-align: center;
            }
            
            html[dir="rtl"] .section-header {
                text-align: center;
            }
            
            html[dir="rtl"] .hero-actions {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    @include('components.public-nav')

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>{{ __('app.systeme_de_Gestion') }}<br>{{ __('app.Scolaire_Moderne') }}</h1>
                <p>{{ __('app.system_management_description') }}</p>
                <div class="hero-actions">
                    <a href="#search-transcript" class="btn-large btn-large-primary">
                        <i class="fas fa-file-alt"></i>
                        {{ __('app.consulter_un_releve') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="search-section" id="search-transcript">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">{{ __('app.consulter_un_releve') }}</h2>
                <p class="section-subtitle">{{ __('app.enter_matricule') }}</p>
            </div>
            
            <div class="search-card">
                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ session('error') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button>
                    </div>
                @endif
                
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button>
                    </div>
                @endif
                
                <form action="{{ route('public.transcript.search') }}" method="GET">
                    <div class="form-group">
                        <label for="matricule" class="form-label">{{ __('app.numero_matricule') }}</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="matricule" 
                            name="matricule" 
                            placeholder="Ex: ETU0001"
                            required
                            autocomplete="off"
                        >
                    </div>
                    
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-search"></i>
                        {{ __('app.rechercher') }}
                    </button>
                </form>
                
                <div class="info-box">
                    <i class="fas fa-info-circle"></i>
                    <p>{{ __('app.matricule_info') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="features-section" id="features">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">{{ __('app.fonctionnalites_principales') }}</h2>
                <p class="section-subtitle">{{ __('app.fonctionnalites_principales_description') }}</p>
            </div>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>{{ __('app.gestion_etudiants') }}</h3>
                    <p>{{ __('app.gestion_etudiants_description') }}</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3>{{ __('app.gestion_enseignants') }}</h3>
                    <p>{{ __('app.gestion_enseignants_description') }}</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>{{ __('app.suivi_notes') }}</h3>
                    <p>{{ __('app.suivi_notes_description') }}</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3>{{ __('app.gestion_trimestres') }}</h3>
                    <p>{{ __('app.gestion_trimestres_description') }}</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>{{ env('APP_NAME') }}</h4>
                    <p>{{ __('app.footer_description') }}</p>
                </div>
                
                <div class="footer-section">
                    <h4>{{ __('app.navigation') }}</h4>
                    <a href="#search-transcript">{{ __('app.consulter_releve') }}</a>
                    <a href="#features">{{ __('app.fonctionnalites') }}</a>
                    <a href="#contact">{{ __('app.contact') }}</a>
                </div>
                
                <div class="footer-section">
                    <h4>{{ __('app.contact') }}</h4>
                    <p>{{ __('app.email') }}: {{ env('CONTACT_EMAIL') }}</p>
                    <p>{{ __('app.telephone') }}: {{ env('CONTACT_PHONE') }}</p>
                    <p>{{ __('app.adresse') }}: {{ env('CONTACT_ADDRESS') }}</p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ env('APP_NAME') }}. {{ __('app.tous_droits_reserves') }}</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
