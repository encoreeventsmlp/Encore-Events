<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://unpkg.com/lucide@latest"></script>

<style>
/* Global Search */
#global-search {
    background: #FFFFFF;
    border: 1px solid #E6E3DC;
    border-radius: 8px;
    color: #20211F;
    transition: all 0.2s ease;
}

#global-search:focus {
    border-color: #B9975B;
    box-shadow: 0 0 0 3px rgba(185, 151, 91, 0.15);
    outline: none;
}

#search-results {
    border: 1px solid #E6E3DC;
    border-radius: 8px;
    box-shadow: 0 8px 24px rgba(32, 33, 31, 0.08);
    background: #FFFFFF;
}

#search-results a:hover {
    background-color: #FAF8F5;
}

/* Theme Accents */
:root {
    --bs-primary: #263D32;
    --bs-primary-rgb: 38, 61, 50;
}

.btn-primary {
    background-color: #263D32 !important;
    border-color: #263D32 !important;
    color: #FFFFFF !important;
}

.btn-primary:hover {
    background-color: #1C2D25 !important;
    border-color: #1C2D25 !important;
}

.bg-label-primary {
    background-color: rgba(38, 61, 50, 0.1) !important;
    color: #263D32 !important;
}

.bg-label-success {
    background-color: rgba(38, 115, 77, 0.1) !important;
    color: #26734D !important;
}

.bg-label-warning {
    background-color: rgba(183, 121, 31, 0.1) !important;
    color: #B7791F !important;
}

.bg-label-danger {
    background-color: rgba(194, 65, 65, 0.1) !important;
    color: #C24141 !important;
}

.card {
    background: #FFFFFF !important;
    border: 1px solid #E6E3DC !important;
    border-radius: 12px !important;
    box-shadow: 0 2px 6px rgba(32, 33, 31, 0.04) !important;
}

.card-header {
    background: transparent !important;
    border-bottom: 1px solid #F0EDE6 !important;
}
</style>

<link rel="stylesheet" href="{{ asset(mix('assets/vendor/fonts/materialdesignicons.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/node-waves/node-waves.css')) }}" />

<link rel="stylesheet" href="{{ asset(mix('assets/vendor/css/core.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/css/theme-default.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/css/demo.css')) }}" />

<link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')) }}" />

@yield('vendor-style')

@yield('page-style')
