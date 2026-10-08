@extends('layouts.app')
@section('title', 'Our Story | Rivanair')
@section('content')
    <style>
        .page-hero {
            background: #f7f3e9;
            padding: 90px 0
        }

        .story-page-hero {
            background-image: url('/images/home/herobg2.png');
            background-size: cover;
            background-position: center;
            color: #fff
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

        .story-page-hero p {
            color: #fff
        }

        .section {
            padding: 80px 0
        }

        .timeline {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px
        }

        .timeline>div {
            border-top: 2px solid #3b5240;
            padding-top: 20px
        }

        .timeline .step-number {
            margin: 0
        }

        .timeline h2 {
            font-family: Georgia, serif
        }

        @media(max-width:900px) {
            .timeline {
                grid-template-columns: repeat(2, 1fr)
            }
        }

        @media(max-width:600px) {
            .page-hero {
                padding: 60px 0
            }

            .page-hero h1 {
                font-size: 42px
            }

            .section {
                padding: 55px 0
            }

            .timeline {
                grid-template-columns: 1fr
            }
        }
    </style>
    <section class="page-hero story-page-hero">
        <div class="container"><span class="eyebrow">OUR STORY</span>
            <h1>From Bihar's waters to your everyday snack.</h1>
            <p>Every pack begins with makhana and a journey of care.</p>
        </div>
    </section>
    <section class="section">
        <div class="container timeline">
            <div><span class="step-number">01</span>
                <h2>Grow</h2>
                <p>Makhana begins its journey in the water-rich regions of Bihar.</p>
            </div>
            <div><span class="step-number">02</span>
                <h2>Harvest</h2>
                <p>The seeds are carefully collected through traditional knowledge.</p>
            </div>
            <div><span class="step-number">03</span>
                <h2>Select & Roast</h2>
                <p>Quality makhana is selected and roasted for a light, satisfying crunch.</p>
            </div>
            <div><span class="step-number">04</span>
                <h2>Flavour & Pack</h2>
                <p>Thoughtful flavours and careful packing preserve freshness and taste.</p>
            </div>
        </div>
    </section>
@endsection