@extends('layouts.app')
@section('title', 'Shop | Rivanair')
@section('content')
    <style>
        .page-hero {
            background: #f7f3e9;
            padding: 90px 0
        }

        .page-hero h1 {
            font-family: Georgia, serif;
            font-size: 58px;
            line-height: 1.1;
            margin: 10px 0
        }

        .page-hero p {
            max-width: 650px;
            color: #626962;
            font-size: 18px
        }

        .section {
            padding: 80px 0
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
            object-fit: cover
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

        .add-cart {
            border: 1px solid #3b5240;
            background: #fff;
            color: #3b5240;
            padding: 8px 12px;
            cursor: pointer
        }

        @media(max-width:900px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr)
            }
        }

        @media(max-width:600px) {
            .product-grid {
                grid-template-columns: 1fr
            }

            .page-hero {
                padding: 60px 0
            }

            .page-hero h1 {
                font-size: 42px
            }
        }
    </style>
    <section class="page-hero">
        <div class="container"><span class="eyebrow dark">OUR STORE</span>
            <h1>Shop Makhana</h1>
            <p>Choose your favourite flavour and bring Bihar home.</p>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="product-grid">
                @foreach([['name' => 'Classic Roasted Makhana', 'desc' => 'Light & Pure', 'price' => 229, 'image' => 'product1.png'], ['name' => 'Peri Peri Makhana', 'desc' => 'Bold & Spicy', 'price' => 249, 'image' => 'product2.png'], ['name' => 'Pudina Makhana', 'desc' => 'Fresh & Aromatic', 'price' => 249, 'image' => 'product3.png'], ['name' => 'Himalayan Salt Makhana', 'desc' => 'Simple & Wholesome', 'price' => 229, 'image' => 'product4.png'], ['name' => 'Cheese Makhana', 'desc' => 'Rich & Savoury', 'price' => 249, 'image' => 'product5.png']] as $product)
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
@endsection