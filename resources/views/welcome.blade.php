<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Madiina Dental - Professional Dental Care</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
            <style>
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            @keyframes pulse-glow {
                0%, 100% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.3); }
                50% { box-shadow: 0 0 40px rgba(99, 102, 241, 0.6); }
            }
            @keyframes slideInLeft {
                from { transform: translateX(-100px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideInRight {
                from { transform: translateX(100px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes fadeInUp {
                from { transform: translateY(30px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }
            @keyframes rotate {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
            .float-animation { animation: float 6s ease-in-out infinite; }
            .pulse-glow { animation: pulse-glow 2s ease-in-out infinite; }
            .slide-in-left { animation: slideInLeft 1s ease-out; }
            .slide-in-right { animation: slideInRight 1s ease-out; }
            .fade-in-up { animation: fadeInUp 1s ease-out; }
            .rotate-slow { animation: rotate 20s linear infinite; }
            .gradient-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
            .glass-effect {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            </style>
    </head>
    <body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 overflow-x-hidden">
        <!-- Animated Background Elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-32 h-32 bg-blue-200 rounded-full opacity-20 float-animation"></div>
            <div class="absolute top-40 right-20 w-24 h-24 bg-purple-200 rounded-full opacity-20 float-animation" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-20 left-1/4 w-16 h-16 bg-indigo-200 rounded-full opacity-20 float-animation" style="animation-delay: 4s;"></div>
            <div class="absolute top-1/2 right-1/3 w-20 h-20 bg-pink-200 rounded-full opacity-20 float-animation" style="animation-delay: 1s;"></div>
        </div>

        <!-- Navigation -->
        <nav class="relative z-50 bg-white/80 backdrop-blur-md shadow-lg border-b border-white/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center pulse-glow">
                            <i class="fas fa-tooth text-white text-xl"></i>
                        </div>
                        <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            Madiina Dental
                        </h1>
                    </div>
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#home" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300">Home</a>
                        <a href="#services" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300">Services</a>
                        <a href="#about" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300">About</a>
                        <a href="#contact" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300">Contact</a>
                        <a href="{{ route('login') }}" 
                           class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300">
                            Log in
                        </a>
                        <a href="{{ route('register') }}" 
                           class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                            Register
                        </a>
                    </div>
                </div>
            </div>
                </nav>

        <!-- Hero Section -->
        <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <div class="slide-in-left">
                    <h1 class="text-6xl md:text-8xl font-black mb-8">
                        <span class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                            Professional
                                </span>
                        <br>
                        <span class="text-gray-800">Dental Care</span>
                    </h1>
                </div>
                
                <div class="fade-in-up" style="animation-delay: 0.5s;">
                    <p class="text-xl md:text-2xl text-gray-600 mb-12 max-w-4xl mx-auto leading-relaxed">
                        Experience world-class dental care with cutting-edge technology and compassionate professionals. 
                        Your smile is our priority.
                    </p>
                </div>

                <div class="fade-in-up" style="animation-delay: 1s;">
                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                        <a href="{{ route('dashboard') }}" 
                           class="group bg-gradient-to-r from-blue-500 to-purple-600 text-white px-12 py-4 rounded-full text-xl font-bold hover:shadow-2xl transform hover:scale-110 transition-all duration-300 pulse-glow">
                            <span class="flex items-center space-x-3">
                                <i class="fas fa-rocket"></i>
                                <span>Get Started</span>
                            </span>
                        </a>
                        <a href="#services" 
                           class="group bg-white/80 backdrop-blur-md text-gray-800 px-12 py-4 rounded-full text-xl font-bold hover:bg-white hover:shadow-xl transform hover:scale-105 transition-all duration-300 border-2 border-blue-200">
                            <span class="flex items-center space-x-3">
                                <i class="fas fa-star"></i>
                                <span>Our Services</span>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Floating Dental Icons -->
                <div class="absolute top-20 right-20 w-16 h-16 text-blue-400 opacity-60 float-animation">
                    <i class="fas fa-tooth text-6xl"></i>
                </div>
                <div class="absolute bottom-40 left-20 w-12 h-12 text-purple-400 opacity-60 float-animation" style="animation-delay: 2s;">
                    <i class="fas fa-heartbeat text-4xl"></i>
                </div>
            </div>

            <!-- Hero Background Animation -->
            <div class="absolute inset-0 -z-10">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-100/50 via-purple-100/50 to-pink-100/50"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-blue-400/20 to-purple-400/20 rounded-full blur-3xl rotate-slow"></div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="py-24 bg-white relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <div class="slide-in-left">
                        <h2 class="text-5xl md:text-6xl font-bold text-gray-800 mb-6">
                            Our <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Services</span>
                        </h2>
                    </div>
                    <div class="fade-in-up" style="animation-delay: 0.3s;">
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            Comprehensive dental solutions tailored to your needs with state-of-the-art technology
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Service Card 1 -->
                    <div class="group bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-2xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 border border-blue-200/50">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-tooth text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">General Dentistry</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Regular checkups, cleanings, and preventive care to maintain optimal oral health.
                        </p>
                    </div>

                    <!-- Service Card 2 -->
                    <div class="group bg-gradient-to-br from-purple-50 to-purple-100 p-8 rounded-2xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 border border-purple-200/50">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-smile text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Cosmetic Dentistry</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Transform your smile with veneers, whitening, and other cosmetic procedures.
                        </p>
                    </div>

                    <!-- Service Card 3 -->
                    <div class="group bg-gradient-to-br from-pink-50 to-pink-100 p-8 rounded-2xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 border border-pink-200/50">
                        <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-braces text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Orthodontics</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Straighten teeth and improve alignment with modern braces and aligners.
                        </p>
                    </div>

                    <!-- Service Card 4 -->
                    <div class="group bg-gradient-to-br from-indigo-50 to-indigo-100 p-8 rounded-2xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 border border-indigo-200/50">
                        <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-stethoscope text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Surgery</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Advanced surgical procedures including wisdom teeth removal and dental implants.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-24 bg-gradient-to-br from-blue-50 to-purple-50 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div class="slide-in-left">
                        <h2 class="text-5xl font-bold text-gray-800 mb-8">
                            Why Choose <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Madiina Dental</span>?
                        </h2>
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Expert Team</h3>
                                    <p class="text-gray-600">Highly qualified and experienced dental professionals</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Modern Technology</h3>
                                    <p class="text-gray-600">State-of-the-art equipment and latest dental innovations</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-pink-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Comfortable Environment</h3>
                                    <p class="text-gray-600">Relaxing atmosphere designed for your comfort</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="slide-in-right">
                        <div class="relative">
                            <div class="w-96 h-96 bg-gradient-to-br from-blue-400 to-purple-600 rounded-full mx-auto flex items-center justify-center pulse-glow">
                                <div class="w-80 h-80 bg-white rounded-full flex items-center justify-center">
                                    <i class="fas fa-tooth text-8xl text-blue-600"></i>
                                </div>
                            </div>
                            <!-- Floating elements around the main circle -->
                            <div class="absolute top-10 left-10 w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center float-animation">
                                <i class="fas fa-star text-white text-xl"></i>
                            </div>
                            <div class="absolute bottom-10 right-10 w-12 h-12 bg-pink-400 rounded-full flex items-center justify-center float-animation" style="animation-delay: 2s;">
                                <i class="fas fa-heart text-white text-lg"></i>
                            </div>
                            <div class="absolute top-1/2 -left-8 w-10 h-10 bg-green-400 rounded-full flex items-center justify-center float-animation" style="animation-delay: 4s;">
                                <i class="fas fa-leaf text-white text-sm"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 bg-gradient-to-r from-blue-600 to-purple-600 relative overflow-hidden">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="fade-in-up">
                    <h2 class="text-5xl md:text-6xl font-bold text-white mb-8">
                        Ready to Transform Your Smile?
                    </h2>
                    <p class="text-xl text-blue-100 mb-12 max-w-2xl mx-auto">
                        Join thousands of satisfied patients who trust us with their dental care. 
                        Book your appointment today and experience the difference.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6 justify-center">
                        <a href="{{ route('dashboard') }}" 
                           class="group bg-white text-blue-600 px-12 py-4 rounded-full text-xl font-bold hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                            <span class="flex items-center justify-center space-x-3">
                                <i class="fas fa-rocket group-hover:animate-bounce"></i>
                                <span>Get Started Now</span>
                            </span>
                        </a>
                        <a href="#contact" 
                           class="group border-2 border-white text-white px-12 py-4 rounded-full text-xl font-bold hover:bg-white hover:text-blue-600 transition-all duration-300">
                            <span class="flex items-center justify-center space-x-3">
                                <i class="fas fa-phone"></i>
                                <span>Contact Us</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Animated background elements -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
                <div class="absolute top-20 left-20 w-32 h-32 bg-white/10 rounded-full float-animation"></div>
                <div class="absolute bottom-20 right-20 w-24 h-24 bg-white/10 rounded-full float-animation" style="animation-delay: 3s;"></div>
                <div class="absolute top-1/2 left-1/3 w-16 h-16 bg-white/10 rounded-full float-animation" style="animation-delay: 1s;"></div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-16 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-tooth text-white text-xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold">Madiina Dental</h3>
                        </div>
                        <p class="text-gray-400 mb-6 max-w-md">
                            Professional dental care for you and your family. We're committed to providing the highest quality dental services in a comfortable and welcoming environment.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors duration-300">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center hover:bg-purple-700 transition-colors duration-300">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors duration-300">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Services</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-white transition-colors duration-300">General Dentistry</a></li>
                            <li><a href="#" class="hover:text-white transition-colors duration-300">Cosmetic Dentistry</a></li>
                            <li><a href="#" class="hover:text-white transition-colors duration-300">Orthodontics</a></li>
                            <li><a href="#" class="hover:text-white transition-colors duration-300">Surgery</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Contact</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-map-marker-alt text-blue-400"></i>
                                <span>123 Dental Street, City</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-phone text-blue-400"></i>
                                <span>+1 (555) 123-4567</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-envelope text-blue-400"></i>
                                <span>info@madiinadental.com</span>
                        </li>
                    </ul>
                    </div>
                </div>
                
                <div class="border-t border-gray-800 pt-8 text-center">
                    <p class="text-gray-400">&copy; 2024 Madiina Dental. All rights reserved.</p>
                </div>
        </div>
        </footer>

        <!-- Scroll to Top Button -->
        <button id="scrollToTop" class="fixed bottom-8 right-8 w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-full shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300 opacity-0 pointer-events-none">
            <i class="fas fa-arrow-up"></i>
        </button>

        <script>
            // Scroll to top functionality
            const scrollToTopBtn = document.getElementById('scrollToTop');
            
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    scrollToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
                } else {
                    scrollToTopBtn.classList.add('opacity-0', 'pointer-events-none');
                }
            });
            
            scrollToTopBtn.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

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

            // Intersection Observer for animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all animated elements
            document.querySelectorAll('.slide-in-left, .slide-in-right, .fade-in-up').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                observer.observe(el);
            });
        </script>
    </body>
</html>
