<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Fair Wind Garage</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
/* RESET */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:"Segoe UI",Tahoma,sans-serif;
}

html{
    scroll-behavior:smooth;
}

body{
    color:#fff;
    background:#000;
}

/* ================= NAVBAR ================= */
header{
    position:fixed;
    top:0;
    width:100%;
    z-index:1000;
    padding:20px 50px;
}

.navbar{
    background:rgba(0,0,0,0.55);
    backdrop-filter:blur(12px);
    border-radius:18px;
    padding:15px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.logo{
    font-size:22px;
    font-weight:800;
}

.logo span{
    color:#ff4d4d;
}

.nav-links{
    list-style:none;
    display:flex;
    gap:35px;
}

.nav-links a{
    text-decoration:none;
    color:#fff;
    font-weight:500;
}

.nav-links a:hover{
    color:#ff4d4d;
}

.nav-btn{
    background:#ff4d4d;
    color:#fff;
    padding:10px 22px;
    border-radius:30px;
    text-decoration:none;
    font-weight:600;
}

/* ================= HERO ================= */
.hero{
    height:100vh;
    background:url("https://images.unsplash.com/photo-1515922079442-0d8a23b7c6c8") center/cover no-repeat;
    display:flex;
    align-items:center;
    padding:0 80px;
    position:relative;
}

.hero::before{
    content:"";
    position:absolute;
    inset:0;
    background:rgba(0,0,0,0.55);
}

.hero-content{
    position:relative;
    max-width:600px;
}

.hero-content h1{
    font-size:55px;
    margin-bottom:20px;
}

.hero-content span{
    color:#ff4d4d;
}

.hero-content p{
    font-size:18px;
    opacity:.9;
    margin-bottom:30px;
}

.hero-buttons a{
    margin-right:15px;
    padding:14px 30px;
    border-radius:30px;
    text-decoration:none;
    font-weight:600;
}

.btn-main{
    background:#ff4d4d;
    color:#fff;
}

.btn-outline{
    border:2px solid #fff;
    color:#fff;
}

/* ================= ABOUT ================= */
#about{
    min-height:100vh;
    background:url("https://images.unsplash.com/photo-1503376780353-7e6692767b70") center/cover no-repeat;
    display:flex;
    align-items:center;
    justify-content:center;
    position:relative;
}

#about::before{
    content:"";
    position:absolute;
    inset:0;
    background:rgba(0,0,0,0.7);
}

.about-content{
    position:relative;
    max-width:700px;
    text-align:center;
    animation:slideDown 1.2s ease forwards;
    opacity:0;
}

.about-content h2{
    font-size:42px;
    margin-bottom:20px;
}

.about-content p{
    font-size:18px;
    line-height:1.7;
    opacity:.9;
}

/* ANIMATION */
@keyframes slideDown{
    from{
        transform:translateY(-60px);
        opacity:0;
    }
    to{
        transform:translateY(0);
        opacity:1;
    }
}

/* ================= CONTACT ================= */
#contact{
    min-height:70vh;
    background:#0c0c0c;
    padding:80px 20px;
    text-align:center;
}

#contact h2{
    font-size:38px;
    margin-bottom:20px;
}

#contact p{
    opacity:.8;
    margin-bottom:30px;
}

.contact-box{
    max-width:500px;
    margin:auto;
}

.contact-box input,
.contact-box textarea{
    width:100%;
    padding:14px;
    margin-bottom:15px;
    border:none;
    border-radius:8px;
}

.contact-box button{
    width:100%;
    padding:14px;
    background:#ff4d4d;
    border:none;
    color:#fff;
    font-weight:bold;
    border-radius:30px;
    cursor:pointer;
}

/* ================= RESPONSIVE ================= */
@media(max-width:900px){
    header{
        padding:15px;
    }

    .nav-links{
        display:none;
    }

    .hero{
        padding:0 20px;
        text-align:center;
    }

    .hero-content h1{
        font-size:40px;
    }
}
</style>
</head>

<body>

<header>
    <nav class="navbar">
        <div class="logo">FAIR<span>WIND</span></div>
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            @auth
                @if(auth()->user()->isAdmin())
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard (Admin)</a></li>
                @else
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;" id="logout-form">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #ff4d4d; font-weight: bold;">Logout</a>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @endauth
        </ul>
        <a href="#contact" class="nav-btn">Book Now</a>
    </nav>
</header>

<!-- HERO -->
<section class="hero" id="home">
    <div class="hero-content">
        <h1>Professional Garage<br><span>Trusted Experts</span></h1>
        <p>High-quality car repair services using modern tools and experienced technicians.</p>
        <div class="hero-buttons">
            <a href="#about" class="btn-main">About Us</a>
            <a href="#contact" class="btn-outline">Contact</a>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section id="about">
    <div class="about-content">
        <h2>About Fair Wind Garage</h2>
        <p>
            We are a professional garage specialized in engine repair,
            diagnostics and maintenance using advanced technology
            with years of trusted experience.
        </p>
    </div>
</section>

<!-- CONTACT -->
<section id="contact">
    <h2>Contact Us</h2>
    <p>Get in touch with our expert team</p>

    <div class="contact-box">
        <input type="text" placeholder="Your Name">
        <input type="email" placeholder="Email Address">
        <textarea rows="4" placeholder="Message"></textarea>
        <button>Send Message</button>
    </div>
</section>

</body>
</html>