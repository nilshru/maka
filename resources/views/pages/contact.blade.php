@extends('layouts.app')
@section('title', 'Contact Us | Rivanair')
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

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 70px
        }

        .contact-grid h2 {
            font-family: Georgia, serif;
            font-size: 42px
        }

        .contact-form {
            display: grid;
            gap: 14px
        }

        .contact-form input,
        .contact-form textarea {
            border: 1px solid #d8d4c8;
            padding: 13px 15px;
            background: #fff;
            width: 100%;
            outline: none
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            border-color: #3b5240
        }

        .contact-form textarea {
            resize: vertical
        }

        @media(max-width:900px) {
            .contact-grid {
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
        }
    </style>
    <section class="page-hero">
        <div class="container"><span class="eyebrow dark">GET IN TOUCH</span>
            <h1>We'd love to hear from you.</h1>
            <p>Questions, partnerships or just want to say hello?</p>
        </div>
    </section>
    <section class="section">
        <div class="container contact-grid">
            <div>
                <h2>Contact Rivanair</h2>
                <p>Email: hello@rivanair.com</p>
                <p>Phone: +91 00000 00000</p>
                <p>Bihar, India</p>
            </div>
            <form class="contact-form"><input type="text" placeholder="Your name"><input type="email"
                    placeholder="Email address"><input type="text" placeholder="Subject"><textarea rows="6"
                    placeholder="Your message"></textarea><button class="btn btn-green" type="button">Send message</button>
            </form>
        </div>
    </section>
@endsection