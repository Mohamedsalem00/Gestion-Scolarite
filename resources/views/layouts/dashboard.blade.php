<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gestion Scolaire') }} - @yield('title', 'Dashboard')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Flag Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />

    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
            --header-height: 70px;
        }
        
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8f9fa;
        }
        
        .main-wrapper {
            display: flex;
            min-height: 100vh;
            position: relative;
        }
        
        /* Mobile Header */
        .mobile-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            background: white;
            border-bottom: 1px solid #dee2e6;
            z-index: 1050;
            display: none;
            align-items: center;
            padding: 0 1rem;
        }
        
        .mobile-header .navbar-brand {
            font-size: 1.2rem;
            font-weight: 600;
            color: #0d6efd;
            text-decoration: none;
        }
        
        .sidebar-toggle {
            background: none;
            border: none;
            color: #6c757d;
            font-size: 1.25rem;
            padding: 0.5rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
        }
        
        .sidebar-toggle:hover {
            background-color: #f8f9fa;
            color: #495057;
        }
        
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }
        
        .content-header {
            background: white;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 1.5rem;
            position: sticky;
            top: 0;
            z-index: 1020;
        }
        
        .content-body {
            padding: 0 1.5rem 1.5rem;
        }
        
        .page-title {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: #495057;
        }
        
        .breadcrumb {
            margin: 0;
            background: none;
            padding: 0;
            font-size: 0.875rem;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            color: #6c757d;
        }
        
        /* Language Switcher */
        .lang-switcher .dropdown-toggle {
            background: none;
            border: none;
            color: #6c757d;
            padding: 0.5rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
        }
        
        .lang-switcher .dropdown-toggle:hover {
            background-color: #f8f9fa;
            color: #495057;
        }
        
        .lang-switcher .dropdown-menu {
            min-width: 8rem;
        }
        
        .lang-switcher .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
        }
        
        .lang-switcher .dropdown-item.active {
            background-color: #e7f1ff;
            color: #0d6efd;
        }
        
        /* Flag Icons Styling */
        .fi {
            width: 20px;
            height: 15px;
            border-radius: 2px;
            display: inline-block;
            vertical-align: middle;
        }
        
        /* Sidebar Responsive */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }
        
        .sidebar-overlay.show {
            display: block;
        }
        
        /* Tablet Styles */
        @media (max-width: 1199.98px) {
            :root {
                --sidebar-width: 260px;
            }
            
            .content-header {
                padding: 0.75rem 1rem;
            }
            
            .content-body {
                padding: 0 1rem 1rem;
            }
        }
        
        /* Tablet Portrait */
        @media (max-width: 991.98px) {
            .mobile-header {
                display: flex;
            }
            
            .main-content {
                margin-left: 0;
                padding-top: var(--header-height);
            }
            
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 1045;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .content-header {
                position: static;
                margin-bottom: 1rem;
            }
            
            .page-title {
                font-size: 1.25rem;
            }
        }
        
        /* Mobile Styles */
        @media (max-width: 767.98px) {
            .content-header {
                padding: 0.5rem 0.75rem;
            }
            
            .content-body {
                padding: 0 0.75rem 0.75rem;
            }
            
            .page-title {
                font-size: 1.1rem;
            }
            
            .breadcrumb {
                font-size: 0.8rem;
            }
            
            .d-flex.justify-content-between {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 0.5rem;
            }
            
            .header-actions {
                align-self: stretch;
            }
            
            .header-actions .btn {
                font-size: 0.875rem;
                padding: 0.375rem 0.75rem;
            }
        }
        
        /* Small Mobile */
        @media (max-width: 575.98px) {
            .mobile-header {
                padding: 0 0.75rem;
            }
            
            .mobile-header .navbar-brand {
                font-size: 1rem;
            }
            
            .content-header {
                padding: 0.5rem;
            }
            
            .content-body {
                padding: 0 0.5rem 0.5rem;
            }
            
            .page-title {
                font-size: 1rem;
            }
        }
        
        /* RTL Support */
        [dir="rtl"] .main-content {
            margin-left: 0;
            margin-right: var(--sidebar-width);
        }
        
        [dir="rtl"] .breadcrumb-item + .breadcrumb-item::before {
            content: "‹";
        }
        
        [dir="rtl"] .sidebar {
            left: auto;
            right: 0;
        }
        
        [dir="rtl"] .sidebar-overlay {
            right: 0;
        }
        
        [dir="rtl"] @media (max-width: 991.98px) {
            .main-content {
                margin-right: 0;
            }
            
            .sidebar {
                transform: translateX(100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
        }
        
        /* Animations */
        .sidebar, .main-content {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Focus states for accessibility */
        .sidebar-toggle:focus,
        .lang-switcher .dropdown-toggle:focus {
            outline: 2px solid #0d6efd;
            outline-offset: 2px;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Mobile Header -->
    <header class="mobile-header">
        <button class="sidebar-toggle me-3" type="button" aria-label="Toggle sidebar">
            <i class="fas fa-bars"></i>
        </button>
        
        <a href="{{ route('tableau-bord') }}" class="navbar-brand">
            <i class="fas fa-school me-2"></i>
            <span class="d-none d-sm-inline">{{ config('app.name', 'Gestion Scolaire') }}</span>
            <span class="d-sm-none">École</span>
        </a>
        
        <div class="ms-auto d-flex align-items-center gap-2">
            <!-- Language Switcher -->
            <div class="lang-switcher dropdown">
                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-label="Change language">
                    @if(app()->getLocale() === 'fr')
                        <span class="fi fi-fr"></span>
                    @elseif(app()->getLocale() === 'ar')
                        <span class="fi fi-sa"></span>
                    @else
                        <span class="fi fi-us"></span>
                    @endif
                    <span class="d-none d-sm-inline ms-1">{{ strtoupper(app()->getLocale()) }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item {{ app()->getLocale() === 'fr' ? 'active' : '' }}" 
                           href="{{ route('lang.switch', 'fr') }}">
                            <span class="fi fi-fr me-2"></span> Français
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ app()->getLocale() === 'ar' ? 'active' : '' }}" 
                           href="{{ route('lang.switch', 'ar') }}">
                            <span class="fi fi-sa me-2"></span> العربية
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ app()->getLocale() === 'en' ? 'active' : '' }}" 
                           href="{{ route('lang.switch', 'en') }}">
                            <span class="fi fi-us me-2"></span> English
                        </a>
                    </li>
                </ul>


            </div>
            
            <!-- User Menu -->
            <div class="dropdown">
                <button class="sidebar-toggle" type="button" data-bs-toggle="dropdown" aria-label="User menu">
                    <i class="fas fa-user-circle"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-header">
                        <div class="fw-semibold">{{ auth()->user()->name ?? 'User' }}</div>
                        <small class="text-muted">{{ auth()->user()->email ?? 'user@example.com' }}</small>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('enseignant.profil') }}"><i class="fas fa-user-cog me-2"></i>{{ __('app.profile') }}</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>{{ __('app.settings') }}</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('deconnexion') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt me-2"></i>{{ __('app.logout') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay"></div>

    <div class="main-wrapper">
        <!-- Sidebar -->
        <x-navigation.sidebar />
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Content Header -->
            <div class="content-header">
                <div class="d-flex justify-content-between align-items-start align-items-md-center">
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <h1 class="page-title">@yield('title', 'Dashboard')</h1>
                            
                            <!-- Desktop Language Switcher -->
                            <div class="lang-switcher dropdown d-none d-lg-block">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-label="Change language">
                                    @if(app()->getLocale() === 'fr')
                        <span class="fi fi-fr"></span>
                    @elseif(app()->getLocale() === 'ar')
                        <span class="fi fi-sa"></span>
                    @else
                        <span class="fi fi-us"></span>
                    @endif
                                    <span class="ms-1">{{ strtoupper(app()->getLocale()) }}</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item {{ app()->getLocale() === 'fr' ? 'active' : '' }}" 
                                           href="{{ route('lang.switch', 'fr') }}">
                                            <span class="fi fi-fr me-2"></span> Français
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item {{ app()->getLocale() === 'ar' ? 'active' : '' }}" 
                                           href="{{ route('lang.switch', 'ar') }}">
                                            <span class="fi fi-sa me-2"></span> العربية
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item {{ app()->getLocale() === 'en' ? 'active' : '' }}" 
                                           href="{{ route('lang.switch', 'en') }}">
                                            <span class="fi fi-us me-2"></span> English
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        @hasSection('breadcrumb')
                            <nav aria-label="breadcrumb" class="mt-1">
                                <ol class="breadcrumb">
                                    @yield('breadcrumb')
                                </ol>
                            </nav>
                        @endif
                    </div>
                    
                    <!-- Header Actions -->
                    @hasSection('header-actions')
                        <div class="header-actions ms-3">
                            @yield('header-actions')
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Content Body -->
            <div class="content-body">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ __(session('success')) }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ __(session('error')) }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ __(session('warning')) }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('info'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ __(session('info')) }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                <!-- Main Content -->
                @yield('content')
            </div>
        </main>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        // Enhanced Sidebar Management
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const sidebarOverlay = document.querySelector('.sidebar-overlay');
            const toggleBtns = document.querySelectorAll('.sidebar-toggle');
            
            // Toggle sidebar function
            function toggleSidebar() {
                const isShowing = sidebar.classList.contains('show');
                
                if (isShowing) {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                    document.body.style.overflow = '';
                } else {
                    sidebar.classList.add('show');
                    sidebarOverlay.classList.add('show');
                    if (window.innerWidth <= 991) {
                        document.body.style.overflow = 'hidden';
                    }
                }
            }
            
            // Attach toggle functionality to all toggle buttons
            toggleBtns.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    toggleSidebar();
                });
            });
            
            // Close button functionality
            const closeBtn = document.querySelector('.sidebar-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                    document.body.style.overflow = '';
                });
            }
            
            // Close sidebar when clicking overlay
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                    document.body.style.overflow = '';
                });
            }
            
            // Close sidebar on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                    document.body.style.overflow = '';
                }
            });
            
            // Handle window resize
            let resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function() {
                    if (window.innerWidth > 991) {
                        sidebar.classList.remove('show');
                        sidebarOverlay.classList.remove('show');
                        document.body.style.overflow = '';
                    }
                }, 250);
            });
            
            // Smooth scroll to top on page navigation (for mobile)
            const navLinks = sidebar.querySelectorAll('.nav-link');
            navLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 991) {
                        setTimeout(function() {
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                        }, 100);
                    }
                });
            });
        });
        
        // Language Switcher Enhancement
        document.addEventListener('DOMContentLoaded', function() {
            const langSwitchers = document.querySelectorAll('.lang-switcher .dropdown-item');
            
            langSwitchers.forEach(function(item) {
                item.addEventListener('click', function(e) {
                    // Add loading state
                    const originalContent = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Chargement...';
                    
                    // Let the navigation proceed naturally
                    setTimeout(function() {
                        item.innerHTML = originalContent;
                    }, 2000);
                });
            });
        });
        
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    if (alert.parentNode) {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }
                }, 5000);
            });
        });
        
        // Enhanced accessibility
        document.addEventListener('DOMContentLoaded', function() {
            // Focus management for sidebar
            const sidebar = document.querySelector('.sidebar');
            const firstFocusableElement = sidebar.querySelector('a, button, input, textarea, select');
            
            sidebar.addEventListener('transitionend', function() {
                if (sidebar.classList.contains('show') && firstFocusableElement) {
                    firstFocusableElement.focus();
                }
            });
            
            // Trap focus in sidebar when open on mobile
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Tab' && sidebar.classList.contains('show') && window.innerWidth <= 991) {
                    const focusableElements = sidebar.querySelectorAll(
                        'a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])'
                    );
                    const firstElement = focusableElements[0];
                    const lastElement = focusableElements[focusableElements.length - 1];
                    
                    if (e.shiftKey) {
                        if (document.activeElement === firstElement) {
                            e.preventDefault();
                            lastElement.focus();
                        }
                    } else {
                        if (document.activeElement === lastElement) {
                            e.preventDefault();
                            firstElement.focus();
                        }
                    }
                }
            });
        });
        
        // Performance optimization: Debounced scroll handler
        let ticking = false;
        function updateScrollState() {
            const scrollTop = window.pageYOffset;
            const header = document.querySelector('.content-header');
            
            if (header) {
                if (scrollTop > 10) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }
            ticking = false;
        }
        
        window.addEventListener('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(updateScrollState);
                ticking = true;
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
