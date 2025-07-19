<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Citimed Hospital - Premier Healthcare in Thika, Kenya</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=dm-sans:400,500,600" rel="stylesheet" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #0066CC;
            --secondary-blue: #4A90E2;
            --light-blue: #E8F4FD;
            --accent-green: #28A745;
            --text-dark: #1A1A1A;
            --text-gray: #6B7280;
            --text-light: #9CA3AF;
            --white: #FFFFFF;
            --light-gray: #F8FAFC;
            --border-gray: #E5E7EB;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background: var(--white);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-gray);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-blue);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            background: var(--primary-blue);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-gray);
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--primary-blue);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-blue);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .cta-button {
            background: var(--primary-blue);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid var(--primary-blue);
        }

        .cta-button:hover {
            background: transparent;
            color: var(--primary-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--white) 100%);
            padding: 8rem 0 6rem;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="%23E8F4FD"/><circle cx="80" cy="40" r="1.5" fill="%234A90E2"/><circle cx="40" cy="60" r="1" fill="%230066CC"/><circle cx="70" cy="80" r="2.5" fill="%23E8F4FD"/></svg>') repeat;
            opacity: 0.6;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-text h1 {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
        }

        .hero-text .highlight {
            color: var(--primary-blue);
        }

        .hero-text p {
            font-size: 1.25rem;
            color: var(--text-gray);
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: var(--primary-blue);
            color: white;
            padding: 1rem 2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background: var(--secondary-blue);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 102, 204, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: var(--primary-blue);
            padding: 1rem 2rem;
            border: 2px solid var(--primary-blue);
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: var(--primary-blue);
            color: white;
            transform: translateY(-2px);
        }

        .hero-image {
            position: relative;
            display: flex;
            justify-content: center;
        }

        .hero-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            transform: rotate(2deg);
            transition: transform 0.3s ease;
        }

        .hero-card:hover {
            transform: rotate(0deg) scale(1.05);
        }

        /* Services Section */
        .services {
            padding: 6rem 0;
            background: var(--white);
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .section-header p {
            font-size: 1.125rem;
            color: var(--text-gray);
            max-width: 600px;
            margin: 0 auto;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .service-card {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid var(--border-gray);
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .service-icon {
            width: 60px;
            height: 60px;
            background: var(--light-blue);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }

        .service-card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .service-card p {
            color: var(--text-gray);
            line-height: 1.6;
        }

        /* About Section */
        .about {
            padding: 6rem 0;
            background: var(--light-gray);
        }

        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .about-text h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
        }

        .about-text p {
            color: var(--text-gray);
            margin-bottom: 1.5rem;
            font-size: 1.125rem;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
            margin-top: 2rem;
        }

        .stat {
            text-align: center;
            padding: 1.5rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-blue);
            display: block;
        }

        .stat-label {
            color: var(--text-gray);
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        /* Contact Section */
        .contact {
            padding: 6rem 0;
            background: var(--primary-blue);
            color: white;
        }

        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .contact-text h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .contact-text p {
            font-size: 1.125rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .contact-info {
            display: grid;
            gap: 1rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            backdrop-filter: blur(10px);
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Footer */
        .footer {
            background: var(--text-dark);
            color: white;
            padding: 3rem 0;
            text-align: center;
        }

        .footer p {
            opacity: 0.8;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero {
                padding: 6rem 0 4rem;
            }

            .hero-content,
            .about-content,
            .contact-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-text h1 {
                font-size: 2.5rem;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .hero-buttons {
                justify-content: center;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-on-scroll {
            animation: fadeInUp 0.8s ease forwards;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
<!-- Header -->
<header class="header">
    <div class="container">
        <nav class="nav">
            <a href="#home" class="logo">
                <div class="logo-icon">C</div>
                Citimed Hospital
            </a>

            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>

            <a href="{{route('login')}}" class="cta-button">Login</a>
        </nav>
    </div>
</header>

<!-- Hero Section -->
<section id="home" class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Premier <span class="highlight">Healthcare</span> in Thika, Kenya</h1>
                <p>Experience world-class medical care with compassionate service. At Citimed Hospital, your health and well-being are our top priority.</p>

                <div class="hero-buttons">
                    <a href="#contact" class="btn-primary">
                        📞 Book Appointment
                    </a>
                    <a href="#services" class="btn-secondary">Our Services</a>
                </div>
            </div>

            <div class="hero-image">
                <div class="hero-card">
                    <div style="width: 300px; height: 200px; background: linear-gradient(135deg, #E8F4FD 0%, #4A90E2 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 3rem;">
                        🏥
                    </div>
                    <h3 style="text-align: center; margin-top: 1rem; color: var(--primary-blue); font-weight: 600;">Modern Healthcare Facility</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="services">
    <div class="container">
        <div class="section-header">
            <h2>Our Medical Services</h2>
            <p>Comprehensive healthcare solutions delivered with expertise and compassion by our dedicated medical professionals.</p>
        </div>

        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">🩺</div>
                <h3>General Medicine</h3>
                <p>Comprehensive primary healthcare services for all ages, including routine checkups, diagnosis, and treatment of common medical conditions.</p>
            </div>

            <div class="service-card">
                <div class="service-icon">🚑</div>
                <h3>Emergency Care</h3>
                <p>24/7 emergency medical services with fully equipped emergency department and trained emergency medicine specialists.</p>
            </div>

            <div class="service-card">
                <div class="service-icon">🧪</div>
                <h3>Laboratory Services</h3>
                <p>State-of-the-art laboratory facilities offering comprehensive diagnostic testing with accurate and timely results.</p>
            </div>

            <div class="service-card">
                <div class="service-icon">📱</div>
                <h3>Radiology & Imaging</h3>
                <p>Advanced imaging services including X-ray, ultrasound, and CT scan for accurate diagnosis and treatment planning.</p>
            </div>

            <div class="service-card">
                <div class="service-icon">👶</div>
                <h3>Maternity Care</h3>
                <p>Complete maternal and child healthcare services from prenatal care through delivery and postnatal support.</p>
            </div>

            <div class="service-card">
                <div class="service-icon">⚕️</div>
                <h3>Specialist Care</h3>
                <p>Access to various medical specialists including cardiology, orthopedics, dermatology, and other specialized treatments.</p>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="about">
    <div class="container">
        <div class="about-content">
            <div class="about-text">
                <h2>Why Choose Citimed Hospital?</h2>
                <p>Located in the heart of Thika, Citimed Hospital has been serving the community with exceptional healthcare services for over a decade. Our commitment to excellence, combined with cutting-edge medical technology and a compassionate approach, makes us the preferred choice for healthcare in the region.</p>

                <p>We believe in treating not just the condition, but the whole person. Our multidisciplinary team of healthcare professionals works together to provide personalized care that meets your unique needs.</p>

                <div class="stats">
                    <div class="stat">
                        <span class="stat-number">10,000+</span>
                        <span class="stat-label">Patients Served</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">50+</span>
                        <span class="stat-label">Medical Professionals</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">15+</span>
                        <span class="stat-label">Years of Excellence</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">24/7</span>
                        <span class="stat-label">Emergency Care</span>
                    </div>
                </div>
            </div>

            <div class="hero-image">
                <div class="hero-card" style="transform: rotate(-2deg);">
                    <div style="width: 300px; height: 250px; background: linear-gradient(135deg, #28A745 0%, #E8F4FD 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 3rem;">
                        👩‍⚕️
                    </div>
                    <h3 style="text-align: center; margin-top: 1rem; color: var(--accent-green); font-weight: 600;">Expert Medical Team</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact">
    <div class="container">
        <div class="contact-content">
            <div class="contact-text">
                <h2>Get in Touch</h2>
                <p>Ready to experience exceptional healthcare? Contact us today to schedule an appointment or for any inquiries about our services.</p>

                <a href="tel:+254700000000" class="btn-primary" style="background: white; color: var(--primary-blue); display: inline-flex; margin-top: 1rem;">
                    📞 Call Now: +254 700 000 000
                </a>
            </div>

            <div class="contact-info">
                <div class="contact-item">
                    <div class="contact-icon">📍</div>
                    <div>
                        <h4>Location</h4>
                        <p>Thika Town, Kiambu County<br>Kenya</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">⏰</div>
                    <div>
                        <h4>Operating Hours</h4>
                        <p>24/7 Emergency Care<br>Mon-Fri: 8AM-8PM (Regular)</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">📧</div>
                    <div>
                        <h4>Email</h4>
                        <p>info@citimed.co.ke<br>appointments@citimed.co.ke</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">🚨</div>
                    <div>
                        <h4>Emergency</h4>
                        <p>24/7 Emergency Hotline<br>+254 700 000 911</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <p>&copy; 2025 Citimed Hospital. All rights reserved. | Thika, Kenya</p>
    </div>
</footer>

<script>
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Header background on scroll
    window.addEventListener('scroll', function() {
        const header = document.querySelector('.header');
        if (window.scrollY > 100) {
            header.style.background = 'rgba(255, 255, 255, 0.98)';
            header.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
        } else {
            header.style.background = 'rgba(255, 255, 255, 0.95)';
            header.style.boxShadow = 'none';
        }
    });

    // Simple animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-on-scroll');
            }
        });
    }, observerOptions);

    // Observe all service cards and stat items
    document.querySelectorAll('.service-card, .stat, .contact-item').forEach(el => {
        observer.observe(el);
    });
</script>
</body>
</html>
