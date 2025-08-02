<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Citimed Hospital - Premier Healthcare in Thika, Kenya</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&family=space-grotesk:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                        'space': ['Space Grotesk', 'sans-serif'],
                    },
                    colors: {
                        primary: '#0066FF',
                        secondary: '#4A90E2',
                        accent: {
                            purple: '#8B5CF6',
                            cyan: '#06B6D4',
                            green: '#10B981',
                            pink: '#EC4899',
                        }
                    },
                    animation: {
                        'float': 'float 6s infinite ease-in-out',
                        'float-delayed': 'float 6s infinite ease-in-out 2s',
                        'pulse-slow': 'pulse 4s infinite',
                        'bounce-slow': 'bounce 3s infinite',
                        'spin-slow': 'spin 8s linear infinite',
                        'fade-in-up': 'fadeInUp 0.8s ease forwards',
                        'fade-in-left': 'fadeInLeft 0.8s ease forwards',
                        'fade-in-right': 'fadeInRight 0.8s ease forwards',
                    },
                    backdropBlur: {
                        xs: '2px',
                    }
                }
            }
        }
    </script>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(120deg); }
            66% { transform: translateY(10px) rotate(240deg); }
        }

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

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-text {
            background: linear-gradient(135deg, #0F172A, #0066FF);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gradient-primary {
            background: linear-gradient(135deg, #0066FF, #8B5CF6);
        }

        .gradient-card {
            background: linear-gradient(135deg, rgba(0, 102, 255, 0.05), rgba(139, 92, 246, 0.05));
        }

        html {
            scroll-behavior: smooth;
        }

        .floating-particles::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(circle at 25% 25%, rgba(0, 102, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(6, 182, 212, 0.1) 0%, transparent 50%);
            animation: float 8s infinite ease-in-out;
        }
    </style>
</head>

<body class="font-inter text-slate-900 bg-white overflow-x-hidden">
<!-- Floating Particles Background -->
<div class="fixed inset-0 pointer-events-none z-0 floating-particles"></div>

<!-- Header -->
<header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 ease-out" id="header">
    <div class="glass-effect">
        <div class="max-w-7xl mx-auto px-6">
            <nav class="flex items-center justify-between py-6">
                <!-- Logo -->
                <a href="#home" class="flex items-center gap-3 font-space text-2xl font-bold text-primary hover:scale-105 transition-transform duration-300">
                    <div class="w-10 h-10 gradient-primary rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-primary/30">
                        C
                    </div>
                    Citimed Hospital
                </a>

                <!-- Navigation Links -->
                <ul class="hidden md:flex items-center gap-8">
                    <li><a href="#home" class="text-slate-600 hover:text-primary font-medium transition-all duration-300 relative group py-2">
                            Home
                            <span class="absolute bottom-0 left-1/2 w-0 h-0.5 gradient-primary group-hover:w-full group-hover:left-0 transition-all duration-300"></span>
                        </a></li>
                    <li><a href="#services" class="text-slate-600 hover:text-primary font-medium transition-all duration-300 relative group py-2">
                            Services
                            <span class="absolute bottom-0 left-1/2 w-0 h-0.5 gradient-primary group-hover:w-full group-hover:left-0 transition-all duration-300"></span>
                        </a></li>
                    <li><a href="#about" class="text-slate-600 hover:text-primary font-medium transition-all duration-300 relative group py-2">
                            About
                            <span class="absolute bottom-0 left-1/2 w-0 h-0.5 gradient-primary group-hover:w-full group-hover:left-0 transition-all duration-300"></span>
                        </a></li>
                    <li><a href="#contact" class="text-slate-600 hover:text-primary font-medium transition-all duration-300 relative group py-2">
                            Contact
                            <span class="absolute bottom-0 left-1/2 w-0 h-0.5 gradient-primary group-hover:w-full group-hover:left-0 transition-all duration-300"></span>
                        </a></li>
                </ul>

                <!-- CTA Button -->
                <a href="#contact" class="gradient-primary text-white px-6 py-3 rounded-xl font-semibold hover:scale-105 hover:shadow-xl hover:shadow-primary/30 transition-all duration-300 transform">
                    Book Appointment
                </a>
            </nav>
        </div>
    </div>
</header>

<!-- Hero Section -->
<section id="home" class="relative min-h-screen flex items-center pt-20 overflow-hidden">
    <!-- Background Gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-purple-50 to-cyan-50"></div>

    <!-- Floating Elements -->
    <div class="absolute top-1/4 right-1/4 w-16 h-16 gradient-primary rounded-2xl opacity-20 animate-float"></div>
    <div class="absolute bottom-1/3 left-1/4 w-12 h-12 bg-accent-cyan rounded-full opacity-20 animate-float-delayed"></div>
    <div class="absolute top-1/2 right-1/6 w-8 h-8 bg-accent-pink rounded-lg opacity-20 animate-bounce-slow"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Hero Text -->
            <div class="space-y-8">
                <div class="space-y-6">
                    <h1 class="font-space text-5xl lg:text-7xl font-bold leading-tight">
                        <span class="gradient-text">Premier</span>
                        <span class="text-primary block">Healthcare</span>
                        <span class="text-slate-800">in Thika, Kenya</span>
                    </h1>
                    <p class="text-xl text-slate-600 leading-relaxed max-w-lg">
                        Experience world-class medical care with compassionate service. At Citimed Hospital, your health and well-being are our top priority.
                    </p>
                </div>

                <!-- Hero Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#contact" class="gradient-primary text-white px-8 py-4 rounded-2xl font-semibold text-lg hover:scale-105 hover:shadow-2xl hover:shadow-primary/30 transition-all duration-300 transform flex items-center justify-center gap-3">
                        <span class="text-2xl">📞</span>
                        Book Appointment
                    </a>
                    <a href="#services" class="glass-effect text-primary px-8 py-4 rounded-2xl font-semibold text-lg hover:scale-105 hover:shadow-xl transition-all duration-300 transform border border-primary/20 backdrop-blur-sm">
                        Our Services
                    </a>
                </div>

                <!-- Hero Stats -->
                <div class="flex flex-wrap gap-6 pt-4">
                    <div class="glass-effect px-6 py-4 rounded-xl backdrop-blur-sm border border-white/30">
                        <div class="font-space text-2xl font-bold text-primary">10K+</div>
                        <div class="text-sm text-slate-600 font-medium">Patients Served</div>
                    </div>
                    <div class="glass-effect px-6 py-4 rounded-xl backdrop-blur-sm border border-white/30">
                        <div class="font-space text-2xl font-bold text-primary">24/7</div>
                        <div class="text-sm text-slate-600 font-medium">Emergency Care</div>
                    </div>
                    <div class="glass-effect px-6 py-4 rounded-xl backdrop-blur-sm border border-white/30">
                        <div class="font-space text-2xl font-bold text-primary">15+</div>
                        <div class="text-sm text-slate-600 font-medium">Years Experience</div>
                    </div>
                </div>
            </div>

            <!-- Hero Visual -->
            <div class="relative flex justify-center lg:justify-end">
                <div class="relative group">
                    <!-- Main Card -->
                    <div class="glass-effect p-8 rounded-3xl backdrop-blur-sm border border-white/30 transform hover:scale-105 transition-all duration-500 hover:rotate-0 rotate-2 shadow-2xl shadow-primary/10">
                        <div class="w-80 h-60 gradient-primary rounded-2xl flex items-center justify-center text-white text-6xl mb-6 shadow-xl">
                            🏥
                        </div>
                        <h3 class="text-center text-xl font-space font-semibold text-primary mb-2">Modern Healthcare Facility</h3>
                        <p class="text-center text-slate-600">State-of-the-art medical equipment and expert care</p>
                    </div>

                    <!-- Floating Badge -->
                    <div class="absolute -top-4 -right-4 glass-effect px-4 py-2 rounded-full backdrop-blur-sm border border-white/30 animate-bounce-slow">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-sm font-medium text-slate-700">Online 24/7</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-20 bg-gradient-to-b from-white to-slate-50 relative">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <h2 class="font-space text-4xl lg:text-5xl font-bold mb-6">
                <span class="gradient-text">Our Medical</span>
                <span class="text-primary">Services</span>
            </h2>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed">
                Comprehensive healthcare solutions delivered with expertise and compassion by our dedicated medical professionals.
            </p>
        </div>

        <!-- Services Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service Card 1 -->
            <div class="group glass-effect p-8 rounded-3xl backdrop-blur-sm border border-white/30 hover:scale-105 hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500 relative overflow-hidden">
                <div class="absolute inset-0 gradient-card opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 gradient-primary rounded-2xl flex items-center justify-center text-white text-3xl mb-6 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 shadow-lg">
                        🩺
                    </div>
                    <h3 class="font-space text-xl font-semibold mb-4 text-slate-800">General Medicine</h3>
                    <p class="text-slate-600 leading-relaxed">Comprehensive primary healthcare services for all ages, including routine checkups, diagnosis, and treatment of common medical conditions.</p>
                </div>
            </div>

            <!-- Service Card 2 -->
            <div class="group glass-effect p-8 rounded-3xl backdrop-blur-sm border border-white/30 hover:scale-105 hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500 relative overflow-hidden">
                <div class="absolute inset-0 gradient-card opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-pink-500 rounded-2xl flex items-center justify-center text-white text-3xl mb-6 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 shadow-lg">
                        🚑
                    </div>
                    <h3 class="font-space text-xl font-semibold mb-4 text-slate-800">Emergency Care</h3>
                    <p class="text-slate-600 leading-relaxed">24/7 emergency medical services with fully equipped emergency department and trained emergency medicine specialists.</p>
                </div>
            </div>

            <!-- Service Card 3 -->
            <div class="group glass-effect p-8 rounded-3xl backdrop-blur-sm border border-white/30 hover:scale-105 hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500 relative overflow-hidden">
                <div class="absolute inset-0 gradient-card opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center text-white text-3xl mb-6 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 shadow-lg">
                        🧪
                    </div>
                    <h3 class="font-space text-xl font-semibold mb-4 text-slate-800">Laboratory Services</h3>
                    <p class="text-slate-600 leading-relaxed">State-of-the-art laboratory facilities offering comprehensive diagnostic testing with accurate and timely results.</p>
                </div>
            </div>

            <!-- Service Card 4 -->
            <div class="group glass-effect p-8 rounded-3xl backdrop-blur-sm border border-white/30 hover:scale-105 hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500 relative overflow-hidden">
                <div class="absolute inset-0 gradient-card opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center text-white text-3xl mb-6 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 shadow-lg">
                        📱
                    </div>
                    <h3 class="font-space text-xl font-semibold mb-4 text-slate-800">Radiology & Imaging</h3>
                    <p class="text-slate-600 leading-relaxed">Advanced imaging services including X-ray, ultrasound, and CT scan for accurate diagnosis and treatment planning.</p>
                </div>
            </div>

            <!-- Service Card 5 -->
            <div class="group glass-effect p-8 rounded-3xl backdrop-blur-sm border border-white/30 hover:scale-105 hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500 relative overflow-hidden">
                <div class="absolute inset-0 gradient-card opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-rose-500 rounded-2xl flex items-center justify-center text-white text-3xl mb-6 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 shadow-lg">
                        👶
                    </div>
                    <h3 class="font-space text-xl font-semibold mb-4 text-slate-800">Maternity Care</h3>
                    <p class="text-slate-600 leading-relaxed">Complete maternal and child healthcare services from prenatal care through delivery and postnatal support.</p>
                </div>
            </div>

            <!-- Service Card 6 -->
            <div class="group glass-effect p-8 rounded-3xl backdrop-blur-sm border border-white/30 hover:scale-105 hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500 relative overflow-hidden">
                <div class="absolute inset-0 gradient-card opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-2xl flex items-center justify-center text-white text-3xl mb-6 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 shadow-lg">
                        ⚕️
                    </div>
                    <h3 class="font-space text-xl font-semibold mb-4 text-slate-800">Specialist Care</h3>
                    <p class="text-slate-600 leading-relaxed">Access to various medical specialists including cardiology, orthopedics, dermatology, and other specialized treatments.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-20 bg-slate-900 text-white relative overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900"></div>
    <div class="absolute top-0 left-0 w-full h-full opacity-10">
        <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-primary rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-accent-purple rounded-full blur-3xl animate-pulse-slow"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- About Text -->
            <div class="space-y-8">
                <h2 class="font-space text-4xl lg:text-5xl font-bold">
                    <span class="text-white">Why Choose</span>
                    <span class="bg-gradient-to-r from-cyan-400 to-blue-400 bg-clip-text text-transparent block">Citimed Hospital?</span>
                </h2>

                <div class="space-y-6">
                    <p class="text-xl text-slate-300 leading-relaxed">
                        Located in the heart of Thika, Citimed Hospital has been serving the community with exceptional healthcare services for over a decade. Our commitment to excellence, combined with cutting-edge medical technology and a compassionate approach, makes us the preferred choice for healthcare in the region.
                    </p>

                    <p class="text-lg text-slate-400 leading-relaxed">
                        We believe in treating not just the condition, but the whole person. Our multidisciplinary team of healthcare professionals works together to provide personalized care that meets your unique needs.
                    </p>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-2 gap-6 pt-8">
                    <div class="glass-effect p-6 rounded-2xl backdrop-blur-sm border border-white/10 text-center hover:scale-105 transition-all duration-300">
                        <div class="font-space text-3xl font-bold text-cyan-400 mb-2">10,000+</div>
                        <div class="text-slate-300 font-medium">Patients Served</div>
                    </div>
                    <div class="glass-effect p-6 rounded-2xl backdrop-blur-sm border border-white/10 text-center hover:scale-105 transition-all duration-300">
                        <div class="font-space text-3xl font-bold text-blue-400 mb-2">50+</div>
                        <div class="text-slate-300 font-medium">Medical Professionals</div>
                    </div>
                    <div class="glass-effect p-6 rounded-2xl backdrop-blur-sm border border-white/10 text-center hover:scale-105 transition-all duration-300">
                        <div class="font-space text-3xl font-bold text-purple-400 mb-2">15+</div>
                        <div class="text-slate-300 font-medium">Years of Excellence</div>
                    </div>
                    <div class="glass-effect p-6 rounded-2xl backdrop-blur-sm border border-white/10 text-center hover:scale-105 transition-all duration-300">
                        <div class="font-space text-3xl font-bold text-green-400 mb-2">24/7</div>
                        <div class="text-slate-300 font-medium">Emergency Care</div>
                    </div>
                </div>
            </div>

            <!-- About Visual -->
            <div class="relative flex justify-center">
                <div class="relative group">
                    <!-- Main Card -->
                    <div class="glass-effect p-8 rounded-3xl backdrop-blur-sm border border-white/20 transform hover:scale-105 transition-all duration-500 hover:rotate-0 -rotate-2 shadow-2xl">
                        <div class="w-80 h-64 bg-gradient-to-br from-green-500 via-emerald-500 to-cyan-500 rounded-2xl flex items-center justify-center text-white text-6xl mb-6 shadow-xl">
                            👩‍⚕️
                        </div>
                        <h3 class="text-center text-xl font-space font-semibold text-cyan-400 mb-2">Expert Medical Team</h3>
                        <p class="text-center text-slate-300">Dedicated professionals committed to your health</p>
                    </div>

                    <!-- Floating Awards -->
                    <div class="absolute -top-6 -left-6 glass-effect px-4 py-2 rounded-full backdrop-blur-sm border border-white/20 animate-float">
                        <div class="flex items-center gap-2">
                            <span class="text-yellow-400 text-xl">🏆</span>
                            <span class="text-sm font-medium text-white">Award Winning</span>
                        </div>
                    </div>

                    <div class="absolute -bottom-4 -right-6 glass-effect px-4 py-2 rounded-full backdrop-blur-sm border border-white/20 animate-float-delayed">
                        <div class="flex items-center gap-2">
                            <span class="text-green-400 text-xl">✓</span>
                            <span class="text-sm font-medium text-white">Certified</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20 bg-gradient-to-br from-primary to-accent-purple text-white relative overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-cyan-500/20 to-purple-500/20"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Contact Text -->
            <div class="space-y-8">
                <h2 class="font-space text-4xl lg:text-5xl font-bold">
                    Get in <span class="text-cyan-300">Touch</span>
                </h2>

                <p class="text-xl text-blue-100 leading-relaxed">
                    Ready to experience exceptional healthcare? Contact us today to schedule an appointment or for any inquiries about our services.
                </p>

                <a href="tel:+254700000000" class="inline-flex items-center gap-3 bg-white text-primary px-8 py-4 rounded-2xl font-semibold text-lg hover:scale-105 hover:shadow-2xl transition-all duration-300 transform">
                    <span class="text-2xl">📞</span>
                    Call Now: +254 700 000 000
                </a>
            </div>

            <!-- Contact Info -->
            <div class="space-y-6">
                <!-- Location -->
                <div class="glass-effect p-6 rounded-2xl backdrop-blur-sm border border-white/20 hover:scale-105 transition-all duration-300 flex items-start gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">
                        📍
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-2">Location</h4>
                        <p class="text-blue-100">Thika Town, Kiambu County<br>Kenya</p>
                    </div>
                </div>

                <!-- Hours -->
                <div class="glass-effect p-6 rounded-2xl backdrop-blur-sm border border-white/20 hover:scale-105 transition-all duration-300 flex items-start gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">
                        ⏰
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-2">Operating Hours</h4>
                        <p class="text-blue-100">24/7 Emergency Care<br>Mon-Fri: 8AM-8PM (Regular)</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="glass-effect p-6 rounded-2xl backdrop-blur-sm border border-white/20 hover:scale-105 transition-all duration-300 flex items-start gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">
                        📧
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-2">Email</h4>
                        <p class="text-blue-100">info@citimed.co.ke<br>appointments@citimed.co.ke</p>
                    </div>
                </div>

                <!-- Emergency -->
                <div class="glass-effect p-6 rounded-2xl backdrop-blur-sm border border-white/20 hover:scale-105 transition-all duration-300 flex items-start gap-4 bg-red-500/20">
                    <div class="w-12 h-12 bg-red-500/30 rounded-xl flex items-center justify-center text-2xl flex-shrink-0 animate-pulse">
                        🚨
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-2">Emergency</h4>
                        <p class="text-blue-100">24/7 Emergency Hotline<br>+254 700 000 911</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-slate-900 text-white py-12 relative">
    <div class="absolute inset-0 bg-gradient-to-r from-slate-900 to-slate-800"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="text-center">
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-10 h-10 gradient-primary rounded-xl flex items-center justify-center text-white font-bold text-lg">
                    C
                </div>
                <span class="font-space text-2xl font-bold">Citimed Hospital</span>
            </div>
            <p class="text-slate-400 mb-8 max-w-2xl mx-auto">
                Committed to providing exceptional healthcare services to the Thika community and beyond. Your health is our priority.
            </p>

            <!-- Social Links -->
            <div class="flex justify-center gap-6 mb-8">
                <a href="#" class="w-12 h-12 glass-effect rounded-xl flex items-center justify-center text-xl hover:scale-110 transition-all duration-300 backdrop-blur-sm border border-white/20">
                    📘
                </a>
                <a href="#" class="w-12 h-12 glass-effect rounded-xl flex items-center justify-center text-xl hover:scale-110 transition-all duration-300 backdrop-blur-sm border border-white/20">
                    📱
                </a>
                <a href="#" class="w-12 h-12 glass-effect rounded-xl flex items-center justify-center text-xl hover:scale-110 transition-all duration-300 backdrop-blur-sm border border-white/20">
                    📧
                </a>
                <a href="#" class="w-12 h-12 glass-effect rounded-xl flex items-center justify-center text-xl hover:scale-110 transition-all duration-300 backdrop-blur-sm border border-white/20">
                    🐦
                </a>
            </div>

            <div class="border-t border-slate-700 pt-8">
                <p class="text-slate-400">
                    &copy; 2025 Citimed Hospital. All rights reserved. | Thika, Kenya
                </p>
            </div>
        </div>
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

    // Header background on scroll with enhanced effects
    window.addEventListener('scroll', function() {
        const header = document.getElementById('header');
        const scrolled = window.scrollY;

        if (scrolled > 100) {
            header.style.background = 'rgba(255, 255, 255, 0.95)';
            header.style.backdropFilter = 'blur(20px)';
            header.style.boxShadow = '0 8px 32px rgba(0, 0, 0, 0.1)';
            header.style.borderBottom = '1px solid rgba(0, 102, 255, 0.1)';
        } else {
            header.style.background = 'rgba(255, 255, 255, 0.8)';
            header.style.backdropFilter = 'blur(20px)';
            header.style.boxShadow = 'none';
            header.style.borderBottom = '1px solid rgba(255, 255, 255, 0.2)';
        }
    });

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Add animation classes to elements
    document.addEventListener('DOMContentLoaded', function() {
        const animateElements = document.querySelectorAll('.glass-effect, .service-card, .stat');
        animateElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
            observer.observe(el);
        });
    });

    // Mobile menu toggle (if needed)
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenu) {
            mobileMenu.classList.toggle('hidden');
        }
    }

    // Add floating particles dynamically
    function createFloatingParticles() {
        const particleContainer = document.querySelector('.floating-particles');
        const colors = ['#0066FF', '#8B5CF6', '#06B6D4', '#10B981', '#EC4899'];

        for (let i = 0; i < 20; i++) {
            const particle = document.createElement('div');
            particle.className = 'absolute rounded-full opacity-20 animate-float';
            particle.style.background = colors[Math.floor(Math.random() * colors.length)];
            particle.style.width = Math.random() * 8 + 4 + 'px';
            particle.style.height = particle.style.width;
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 6 + 's';
            particle.style.animationDuration = (Math.random() * 4 + 4) + 's';
            particleContainer.appendChild(particle);
        }
    }

    // Initialize particles
    createFloatingParticles();

    // Add parallax effect to hero section
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.hero .absolute');

        parallaxElements.forEach((element, index) => {
            const speed = (index + 1) * 0.5;
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });

    // Add hover effects for service cards
    document.querySelectorAll('.group').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Add loading animation
    window.addEventListener('load', function() {
        document.body.style.opacity = '1';
        document.body.style.transform = 'translateY(0)';
    });

    // Initial page load animation
    document.body.style.opacity = '0';
    document.body.style.transform = 'translateY(20px)';
    document.body.style.transition = 'all 0.8s ease';
</script>
</body>
</html>
