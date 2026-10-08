@extends('layouts.app')
@section('title', 'Cart | Rivanair')
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

        .cart-layout {
            display: grid;
            grid-template-columns: 1.6fr .8fr;
            gap: 40px
        }

        .cart-item {
            display: flex;
            gap: 18px;
            padding: 18px 0;
            border-bottom: 1px solid #e5e2d9
        }

        .cart-item img {
            width: 110px;
            height: 110px;
            object-fit: cover;
            background: #f1e8d9
        }

        .cart-item h3 {
            margin: 0;
            font-family: Georgia, serif
        }

        .cart-item-actions {
            margin-top: 15px;
            display: flex;
            gap: 10px
        }

        .cart-item button {
            border: 1px solid #ddd;
            background: #fff;
            padding: 5px 10px;
            cursor: pointer
        }

        .cart-summary {
            border: 1px solid #e5e2d9;
            padding: 25px;
            height: max-content
        }

        .summary-row,
        .summary-total {
            display: flex;
            justify-content: space-between;
            padding: 12px 0
        }

        .summary-total {
            border-top: 1px solid #e5e2d9;
            margin-top: 10px;
            font-size: 20px
        }

        .full {
            width: 100%
        }

        @media(max-width:900px) {
            .cart-layout {
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

            .cart-item img {
                width: 85px;
                height: 85px
            }
        }
    </style>
    <section class="page-hero">
        <div class="container"><span class="eyebrow dark">YOUR BAG</span>
            <h1>Your cart</h1>
            <p>Wholesome, crunchy and always a good idea.</p>
        </div>
    </section>
    <section class="section">
        <div class="container cart-layout">
            <div>
                <div id="cart-items"></div><a class="text-link" href="{{ route('shop') }}">← Continue shopping</a>
            </div>
            <aside class="cart-summary">
                <h2>Order summary</h2>
                <div class="summary-row"><span>Subtotal</span><strong id="cart-subtotal">₹0</strong></div>
                <div class="summary-row"><span>Shipping</span><strong id="cart-shipping">₹0</strong></div>
                <div class="summary-total"><span>Total</span><strong id="cart-total">₹0</strong></div><button
                    class="btn btn-green full" id="checkout-btn" type="button">Checkout</button>
            </aside>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        (function () {
            const key = 'rivanair_cart';
            let items = JSON.parse(localStorage.getItem(key) || '[]');
            if (!items.length) { items = [{ name: 'Peri Peri Makhana', price: 249, qty: 2, image: 'product1.png' }, { name: 'Pudina Makhana', price: 249, qty: 1, image: 'product2.png' }]; }
            const money = n => '₹' + Number(n).toLocaleString('en-IN');
            const render = () => { const box = document.getElementById('cart-items'); if (!box) return; if (!items.length) { box.innerHTML = '<p>Your cart is empty.</p>'; document.getElementById('cart-subtotal').textContent = '₹0'; document.getElementById('cart-shipping').textContent = '₹0'; document.getElementById('cart-total').textContent = '₹0'; return; } box.innerHTML = items.map((i, index) => `<div class="cart-item"><img src="${window.location.origin}/images/home/${i.image}" alt="${i.name}"><div style="flex:1"><h3>${i.name}</h3><p>₹${i.price}</p><div class="cart-item-actions"><button data-action="minus" data-index="${index}">−</button><strong>${i.qty}</strong><button data-action="plus" data-index="${index}">+</button><button data-action="remove" data-index="${index}">Remove</button></div></div></div>`).join(''); const sub = items.reduce((s, i) => s + i.price * i.qty, 0); const ship = sub >= 499 ? 0 : 49; document.getElementById('cart-subtotal').textContent = money(sub); document.getElementById('cart-shipping').textContent = money(ship); document.getElementById('cart-total').textContent = money(sub + ship); localStorage.setItem(key, JSON.stringify(items)); };
            document.addEventListener('click', e => { const b = e.target.closest('[data-action]'); if (!b) return; const i = +b.dataset.index, a = b.dataset.action; if (a === 'plus') items[i].qty++; if (a === 'minus') items[i].qty = Math.max(1, items[i].qty - 1); if (a === 'remove') items.splice(i, 1); render(); });
            render();
        })();
    </script>
@endpush