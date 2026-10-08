<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Rivanair Makhana')</title>
<style>
*{box-sizing:border-box}html{scroll-behavior:smooth}body{margin:0;color:#1d241f;background:#fff;font-family:Arial,Helvetica,sans-serif;line-height:1.6}a{text-decoration:none;color:inherit}button,input,textarea{font:inherit}.btn{border:0;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;padding:12px 23px;border-radius:3px;font-weight:700}.btn-green{background:#3b5240;color:#fff}.btn-green:hover{background:#2a3c2e}.text-link{font-weight:700;color:#3b5240}.eyebrow{font-size:12px;letter-spacing:2px;font-weight:800;color:#f4c542}.eyebrow.dark{color:#6d786f}

/* Shared component styles */
.container{width:min(1200px,calc(100% - 40px));margin:auto}.topbar{background:#063b2a;color:#fff;font-size:12px}.topbar-inner{height:34px;display:flex;align-items:center;justify-content:space-between;gap:20px}.topbar-points,.topbar-links{display:flex;gap:22px}.topbar a:hover{color:#f4c542}.navbar{position:sticky;top:0;z-index:50;background:#fff6dc;border-bottom:1px solid #ece8dc}.nav-inner{height:74px;display:flex;align-items:center;justify-content:space-between;gap:25px}.brand{display:flex;align-items:center;gap:10px}.brand img{width:45px;height:45px;border-radius:50%;object-fit:contain;background:#fff}.brand strong{display:block;color:#0b3d2e;font-size:21px;line-height:1}.brand small{display:block;color:#0b3d2e99;font-size:11px;margin-top:5px}.desktop-nav{display:flex;gap:30px}.desktop-nav a{height:74px;display:flex;align-items:center;font-weight:600;color:#626962;border-bottom:3px solid transparent}.desktop-nav a:hover,.desktop-nav a.active{color:#0b3d2e;border-bottom-color:#f4c542}.nav-actions{display:flex;align-items:center;gap:7px}.icon-btn,.menu-btn{border:0;background:transparent;cursor:pointer;width:40px;height:40px;border-radius:50%;font-size:20px;display:grid;place-items:center}.icon-btn:hover,.menu-btn:hover{background:#f5f7f3;color:#0b3d2e}.cart-link{position:relative}.cart-link span{position:absolute;right:0;top:0;min-width:17px;height:17px;border-radius:50%;background:#0b3d2e;color:#fff;font-size:10px;display:grid;place-items:center}.menu-btn{display:none}.mobile-nav{display:none}.mobile-nav.open{display:grid}.mobile-nav a{padding:12px 0}.site-footer{background:#063b2a;color:#fff;padding:50px 0 25px}.footer-grid{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:35px}.site-footer a{color:#dce9df}.site-footer h3{margin-top:0}.footer-bottom{margin-top:35px;padding-top:20px;border-top:1px solid #ffffff25;font-size:13px;color:#cddbd2}

@media(max-width:900px){.topbar-points,.topbar-links{display:none}.desktop-nav{display:none}.menu-btn{display:grid}.nav-inner{height:64px}.footer-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.container{width:min(100% - 28px,1200px)}.footer-grid{grid-template-columns:1fr}}
</style>
@stack('styles')
</head>
<body>
@include('components.topbar')
@include('components.navbar')
<main>@yield('content')</main>
@include('components.footer')
@stack('scripts')
</body>
</html>