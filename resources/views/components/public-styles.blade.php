<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    html {
        scroll-behavior: smooth;
    }
    
    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        background: #f8f9fa;
        color: #1a1a1a;
        line-height: 1.6;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    
    /* Improve touch targets for mobile */
    @media (hover: none) and (pointer: coarse) {
        .lang-btn,
        .lang-switcher .dropdown-toggle,
        .btn-large,
        .btn {
            min-height: 44px;
            min-width: 44px;
        }
    }
    
    .navbar {
        background: #ffffff;
        border-bottom: 1px solid #e5e7eb;
        padding: 1rem 0;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    
    .navbar-brand {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 600;
        color: #1a1a1a;
        text-decoration: none;
        font-size: 1.25rem;
    }
    
    .navbar-brand:hover {
        color: #2563eb;
    }
    
    .brand-icon {
        width: 36px;
        height: 36px;
        background: #2563eb;
        color: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.125rem;
    }
    
    /* Language Switcher */
    .lang-switcher {
        margin-left: auto;
    }
    
    .lang-switcher .dropdown-toggle {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        padding: 0.5rem 1rem;
        color: #1a1a1a;
        font-weight: 500;
        font-size: 0.9375rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
    }
    
    .lang-switcher .dropdown-toggle:hover {
        background: #f9fafb;
        border-color: #d1d5db;
    }
    
    .lang-switcher .dropdown-toggle::after {
        margin-left: 0.5rem;
    }
    
    .lang-switcher .dropdown-menu {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 0.5rem;
        min-width: 160px;
    }
    
    .lang-switcher .dropdown-item {
        border-radius: 6px;
        padding: 0.5rem 1rem;
        font-size: 0.9375rem;
        transition: all 0.2s;
        display: flex;
        align-items: center;
    }
    
    .lang-switcher .dropdown-item:hover {
        background: #f0f9ff;
        color: #2563eb;
    }
    
    .lang-switcher .dropdown-item.active {
        background: #eff6ff;
        color: #2563eb;
        font-weight: 500;
    }
    
    .lang-switcher .fi {
        font-size: 1.125rem;
        border-radius: 2px;
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
    
    html[dir="rtl"] .lang-switcher .dropdown-toggle {
        flex-direction: row-reverse;
    }
    
    html[dir="rtl"] .lang-switcher .dropdown-toggle .ms-1 {
        margin-left: 0 !important;
        margin-right: 0.25rem;
    }
    
    html[dir="rtl"] .lang-switcher .dropdown-toggle::after {
        margin-left: 0;
        margin-right: 0.5rem;
    }
    
    /* Responsive Design */
    @media (max-width: 576px) {
        .navbar {
            padding: 0.75rem 0;
        }
        
        .navbar-brand {
            font-size: 1rem;
        }
        
        .brand-icon {
            width: 32px;
            height: 32px;
            font-size: 1rem;
        }
        
        .lang-switcher .dropdown-toggle {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }
        
        .lang-switcher .fi {
            font-size: 1rem;
        }
    }
    
    @media (min-width: 577px) and (max-width: 768px) {
        .navbar-brand {
            font-size: 1.125rem;
        }
    }
</style>
