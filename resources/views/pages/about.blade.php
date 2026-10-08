@extends('layouts.app')
@section('title', 'About Us | Rivanair')
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

        .two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center
        }

        .content-image {
            width: 100%;
            height: 520px;
            object-fit: cover
        }

        .two-col h2 {
            font-family: Georgia, serif;
            font-size: 42px;
            line-height: 1.15
        }

        @media(max-width:900px) {
            .two-col {
                grid-template-columns: 1fr
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

            .content-image {
                height: 350px
            }
        }
    </style>
    <section class="page-hero">
        <div class="container"><span class="eyebrow dark">ABOUT RIVANAIR</span>
            <h1>Rooted in Bihar. Made for the world.</h1>
            <p>We are building a contemporary identity for one of Bihar's most remarkable ingredients.</p>
        </div>
    </section>
    <section class="section">
        <div class="container two-col"><img class="content-image" src="{{ asset('images/home/b2b.png') }}"
                alt="Bihar makhana">
            <div><span class="eyebrow dark">OUR PURPOSE</span>
                <h2>A simple ingredient. A bigger purpose.</h2>
                <p>Makhana has been enjoyed in homes across India for generations. Rivanair brings that heritage into modern
                    routines with carefully selected, roasted and flavoured makhana.</p>
                <p>Our work is connected to the people, farmers and communities behind the ingredient.</p>
            </div>
        </div>
    </section>
@endsection