<footer class="footer">
    <div class="container footer-grid">
        <div>
            <div class="footer-brand">Rivanair</div>
            <p>Bihar's superfood, carefully roasted and packed for everyday snacking.</p>
        </div>
        <div>
            <h4>Explore</h4><a href="{{ route('shop') }}">Shop</a><a href="{{ route('story') }}">Our Story</a><a
                href="{{ route('about') }}">About Us</a>
        </div>
        <div>
            <h4>Support</h4><a href="{{ route('contact') }}">Contact</a><a href="#">Track Order</a><a href="#">Help
                Center</a>
        </div>
        <div>
            <h4>Stay connected</h4>
            <p>Get product updates and offers.</p>
            <form class="newsletter"><input type="email" placeholder="Your email"><button type="button">→</button>
            </form>
        </div>
    </div>
    <div class="container footer-bottom"><span>© {{ date('Y') }} Rivanair. All rights reserved.</span><span>Made with
            Bihar's spirit.</span></div>
</footer>