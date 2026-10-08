@extends('layouts.app')
@section('title', 'Rivanair Makhana | Bihar\'s Superfood')
@section('content')
    <style>
        .hero {
            min-height: 620px;
            background-position: center;
            background-size: cover;
            position: relative;
            color: #fff;
            display: flex;
            align-items: center
        }

        .hero-overlay,
        .story-banner-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(0, 0, 0, .62), rgba(0, 0, 0, .12))
        }

        .hero-content,
        .story-banner .container {
            position: relative;
            z-index: 1
        }

        .hero h1 {
            font-family: Georgia, serif;
            font-size: clamp(48px, 7vw, 86px);
            line-height: 1.02;
            margin: 12px 0 20px
        }

        .hero p {
            max-width: 570px;
            font-size: 19px
        }

        .hero-buttons {
            display: flex;
            gap: 12px;
            margin-top: 28px
        }

        .btn-primary {
            background: #3b5240;
            color: #fff
        }

        .btn-light {
            background: #fff;
            color: #253329
        }

        .benefits {
            background: #f7f3e9;
            border-bottom: 1px solid #e5e2d9
        }

        .benefit-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr)
        }

        .benefit-grid div {
            padding: 24px;
            border-right: 1px solid #e5e2d9
        }

        .benefit-grid div:last-child {
            border: 0
        }

        .benefit-grid b,
        .benefit-grid span {
            display: block
        }

        .benefit-grid span {
            font-size: 13px;
            color: #777
        }

        .section {
            padding: 80px 0
        }

        .section-head {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 35px
        }

        .section h2 {
            font-family: Georgia, serif;
            font-size: 42px;
            line-height: 1.15;
            margin: 8px 0 15px
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px
        }

        .product-card {
            border: 1px solid #e5e2d9;
            background: #fff
        }

        .product-image {
            height: 280px;
            background: #f1e8d9;
            overflow: hidden
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s
        }

        .product-card:hover img {
            transform: scale(1.04)
        }

        .product-info {
            padding: 18px
        }

        .product-info>span {
            font-size: 12px;
            color: #7c837e
        }

        .product-info h3 {
            font-family: Georgia, serif;
            margin: 5px 0 15px;
            font-size: 21px
        }

        .product-info>div {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px
        }

        .product-info strong {
            font-size: 18px
        }

        .add-cart {
            border: 1px solid #3b5240;
            background: #fff;
            color: #3b5240;
            padding: 8px 12px;
            cursor: pointer
        }

        .add-cart:hover {
            background: #3b5240;
            color: #fff
        }

        .split-section {
            background: #f7f5ef;
            padding: 80px 0
        }

        .split-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center
        }

        .split-image img {
            width: 100%;
            height: 520px;
            object-fit: cover
        }

        .split-copy p {
            color: #626962
        }

        .check-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin: 25px 0
        }

        .check-list span {
            color: #3b5240;
            font-weight: 600
        }

        .process {
            background: #fff;
            border-top: 1px solid #e5e2d9;
            border-bottom: 1px solid #e5e2d9;
            padding: 80px 0
        }

        .process-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 18px
        }

        .process-item {
            text-align: center
        }

        .step-number {
            width: 54px;
            height: 54px;
            border: 1px solid #3b5240;
            border-radius: 50%;
            display: grid;
            place-items: center;
            margin: auto;
            color: #3b5240;
            font-weight: 800
        }

        .process-item h3 {
            font-size: 13px;
            letter-spacing: 1.5px;
            margin: 13px 0 5px
        }

        .process-item p {
            font-size: 12px;
            color: #777
        }

        .story-banner {
            min-height: 500px;
            background-size: cover;
            background-position: center;
            position: relative;
            color: #fff;
            display: flex;
            align-items: center
        }

        .story-banner h2 {
            position: relative;
            font-family: Georgia, serif;
            font-size: 52px;
            max-width: 650px;
            margin: 10px 0
        }

        .story-banner p {
            position: relative;
            max-width: 570px;
            font-size: 18px
        }

        .story-banner .btn {
            position: relative;
            margin-top: 20px
        }

        .newsletter-box {
            background: #fff6dc;
            padding: 55px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px
        }

        .newsletter-box form {
            display: flex;
            gap: 10px;
            min-width: 420px
        }

        .newsletter-box input {
            border: 1px solid #d8d4c8;
            padding: 13px 15px;
            background: #fff;
            width: 100%
        }

        @media(max-width:900px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr)
            }

            .process-grid {
                grid-template-columns: repeat(3, 1fr)
            }

            .benefit-grid {
                grid-template-columns: repeat(2, 1fr)
            }

            .split-grid {
                grid-template-columns: 1fr
            }

            .newsletter-box {
                display: block
            }

            .newsletter-box form {
                min-width: 0;
                margin-top: 20px
            }
        }

        @media(max-width:600px) {
            .hero {
                min-height: 560px
            }

            .hero h1 {
                font-size: 46px
            }

            .section {
                padding: 55px 0
            }

            .section h2 {
                font-size: 34px
            }

            .benefit-grid,
            .product-grid,
            .process-grid {
                grid-template-columns: 1fr
            }

            .benefit-grid div {
                border-right: 0;
                border-bottom: 1px solid #e5e2d9
            }

            .newsletter-box {
                padding: 30px
            }

            .newsletter-box form {
                display: grid
            }

            .split-image img {
                height: 350px
            }
        }
    </style>
    <section class="hero" style="background-image:url('{{ asset('images/home/herobg.png') }}')">
        <div class="hero-overlay"></div>
        <div class="container hero-content"><span class="eyebrow">FROM BIHAR'S HEART</span>
            <h1>Crunch that comes<br>from Bihar.</h1>
            <p>Roasted makhana made with simple ingredients, thoughtful flavours and a whole lot of Bihar.</p>
            <div class="hero-buttons"><a class="btn btn-primary" href="{{ route('shop') }}">Shop Makhana</a><a
                    class="btn btn-light" href="{{ route('story') }}">Our Story</a></div>
        </div>
    </section>
    <section class="benefits">
        <div class="container benefit-grid">
            <div><b>100% Natural</b><span>Simple ingredients</span></div>
            <div><b>No Preservatives</b><span>Clean and honest</span></div>
            <div><b>Rich in Protein</b><span>Smart everyday snacking</span></div>
            <div><b>From Bihar</b><span>Rooted in tradition</span></div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="section-head">
                <div><span class="eyebrow dark">OUR FLAVOURS</span>
                    <h2>Something for every mood.</h2>
                </div><a class="text-link" href="{{ route('shop') }}">View all products →</a>
            </div>
            <div class="product-grid">
                @foreach($products ?? [['name' => 'Classic Roasted', 'desc' => 'Light & Pure', 'price' => 229, 'image' => 'product1.png'], ['name' => 'Peri Peri Makhana', 'desc' => 'Bold & Spicy', 'price' => 249, 'image' => 'product2.png'], ['name' => 'Pudina Makhana', 'desc' => 'Fresh & Aromatic', 'price' => 249, 'image' => 'product3.png'], ['name' => 'Himalayan Salt', 'desc' => 'Simple & Wholesome', 'price' => 229, 'image' => 'product4.png']] as $product)
                    <article class="product-card">
                        <div class="product-image"><img src="{{ asset('images/home/' . $product['image']) }}"
                                alt="{{ $product['name'] }}"></div>
                        <div class="product-info"><span>{{ $product['desc'] }}</span>
                            <h3>{{ $product['name'] }}</h3>
                            <div><strong>₹{{ $product['price'] }}</strong><button class="add-cart"
                                    data-name="{{ $product['name'] }}" data-price="{{ $product['price'] }}">Add to cart</button>
                            </div>
                        </div>
                </article>@endforeach
            </div>
        </div>
    </section>
    <section class="split-section">
        <div class="container split-grid">
            <div class="split-image"><img src="{{ asset('images/home/whychoosebg.png') }}" alt="Why choose Rivanair"></div>
            <div class="split-copy"><span class="eyebrow dark">WHY RIVANAIR</span>
                <h2>Traditional ingredient. Modern everyday snack.</h2>
                <p>We keep the goodness of Bihar's makhana at the centre and bring it to you through careful sourcing,
                    roasting, seasoning and packing.</p>
                <div class="check-list"><span>✓ Carefully selected makhana</span><span>✓ Thoughtful flavours</span><span>✓
                        Freshly packed</span><span>✓ Made for everyday snacking</span></div><a class="btn btn-green"
                    href="{{ route('about') }}">Why choose us</a>
            </div>
        </div>
    </section>
    <section class="process">
        <div class="container">
            <div class="section-head centered">
                <div><span class="eyebrow dark">OUR PROCESS</span>
                    <h2>From Bihar's waters to your table.</h2>
                </div>
            </div>
            <div class="process-grid">
                @foreach([['01', 'GROW', 'Grown in Bihar\'s water-rich regions.'], ['02', 'HARVEST', 'Collected through a traditional process.'], ['03', 'SELECT', 'Selected for quality, size and texture.'], ['04', 'ROAST', 'Roasted for a satisfying crunch.'], ['05', 'FLAVOUR', 'Finished with thoughtful flavours.'], ['06', 'PACK', 'Packed to preserve freshness.']] as $step)
                    <div class="process-item"><span class="step-number">{{ $step[0] }}</span>
                        <h3>{{ $step[1] }}</h3>
                        <p>{{ $step[2] }}</p>
                </div>@endforeach
            </div>
        </div>
    </section>
    <section class="story-banner" style="background-image:url('{{ asset('images/home/herobg2.png') }}')">
        <div class="story-banner-overlay"></div>
        <div class="container"><span class="eyebrow">ROOTED IN BIHAR</span>
            <h2>A taste that begins here.</h2>
            <p>Bihar is at the heart of our story. Generations of knowledge, cultivation and hard work go into every pack.
            </p><a class="btn btn-light" href="{{ route('story') }}">Explore our story</a>
        </div>
    </section>
    <section class="section newsletter-section">
        <div class="container newsletter-box">
            <div><span class="eyebrow dark">STAY IN THE LOOP</span>
                <h2>Good snacks. Good stories.</h2>
                <p>Get new flavour launches, offers and stories from Bihar.</p>
            </div>
            <form><input type="email" placeholder="Your email address"><button class="btn btn-green"
                    type="button">Subscribe</button></form>
        </div>
    </section>
@endsection