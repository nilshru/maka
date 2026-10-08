<header class="navbar" id="navbar">
    <div class="container nav-inner">
        <a href="{{ route('home') }}" class="brand">
            <img src="{{ asset('images/login/brand_logo.png') }}" alt="Rivanair logo">
            <span><strong>Rivanair</strong><small>Bihar's Superfood</small></span>
        </a>
        <nav class="desktop-nav">
            <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
            <a class="{{ request()->routeIs('shop') ? 'active' : '' }}" href="{{ route('shop') }}">Shop</a>
            <a class="{{ request()->routeIs('story') ? 'active' : '' }}" href="{{ route('story') }}">Our Story</a>
            <a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
            <a class="{{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
        </nav>
        <div class="nav-actions">
            <button class="icon-btn" type="button" data-search-toggle aria-label="Search">⌕</button>
            <a class="icon-btn" href="{{ route('login') }}" aria-label="Account">♙</a>
            <a class="icon-btn cart-link" href="{{ route('cart') }}" aria-label="Cart">🛒<span
                    id="cart-count">0</span></a>
            <button class="menu-btn" type="button" data-menu-toggle>☰</button>
        </div>
    </div>
    <div class="search-panel" data-search-panel>
        <form action="{{ route('shop') }}" method="GET" class="container search-form">
            <input name="search" type="search" placeholder="Search makhana..." value="{{ request('search') }}">
            <button type="submit">Search</button>
        </form>
    </div>
    <nav class="mobile-nav" data-mobile-menu>
        <a href="{{ route('home') }}">Home</a><a href="{{ route('shop') }}">Shop</a><a href="{{ route('story') }}">Our
            Story</a><a href="{{ route('about') }}">About Us</a><a href="{{ route('contact') }}">Contact</a>
    </nav>
</header>