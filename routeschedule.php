<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dimple Star Transport - Routes & Schedules</title>
    <link rel="icon" href="images/icon.ico" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'transport-blue': '#1e40af',
                        'transport-orange': '#f97316',
                        'transport-gray': '#64748b'
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom animations */
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
        
        @keyframes slideIn {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        .animate-slideIn {
            animation: slideIn 0.8s ease-out forwards;
        }
        
        /* Glassmorphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Hover effects */
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        /* Navigation styles */
        .nav-link {
            position: relative;
            overflow: hidden;
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #1e40af, #3b82f6);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::before {
            width: 100%;
        }
        
        .nav-active {
            color: #1e40af;
            font-weight: 600;
            background: rgba(30, 64, 175, 0.05);
        }
        
        .nav-active::before {
            width: 100%;
            background: linear-gradient(90deg, #1e40af, #f97316);
        }
        
        /* Mobile menu animation */
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        
        .mobile-menu.active {
            max-height: 400px;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Header -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="index.php" class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-transport-blue to-transport-orange rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-xl">DS</span>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">Dimple Star Transport</h1>
                            <p class="text-sm text-gray-600">Your Trusted Travel Partner</p>
                        </div>
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-2">
                    <a href="index.php" class="nav-link px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:text-transport-blue hover:bg-blue-50 transition-all duration-300">Home</a>
                    <a href="about.php" class="nav-link px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:text-transport-blue hover:bg-blue-50 transition-all duration-300">About Us</a>
                    <a href="terminal.php" class="nav-link px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:text-transport-blue hover:bg-blue-50 transition-all duration-300">Terminals</a>
                    <a href="routeschedule.php" class="nav-link nav-active px-4 py-3 rounded-lg text-sm font-medium transition-all duration-300">Routes & Schedules</a>
                    <a href="contact.php" class="nav-link px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:text-transport-blue hover:bg-blue-50 transition-all duration-300">Contact</a>
                    <div class="ml-6 pl-6 border-l border-gray-200">
                        <a href="book.php" class="bg-gradient-to-r from-transport-orange to-orange-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg hover:shadow-orange-200 transform hover:scale-105 transition-all duration-300 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4h4m4 0V9a2 2 0 00-2-2h-2m-4 0H6a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2h-2z"></path>
                            </svg>
                            <span>Book Now</span>
                        </a>
                    </div>
                </nav>
                
                <!-- User Account & Mobile Menu Button -->
                <div class="flex items-center space-x-4">
                    <!-- User Account -->
                    <div class="hidden sm:block">
                        <div id="userAccount" class="text-right">
                            <div class="text-sm text-gray-600">Welcome, Guest!</div>
                            <a href="signlog.php" class="text-sm text-transport-blue hover:text-transport-orange transition-colors">Sign Up / Login</a>
                        </div>
                    </div>
                    
                    <!-- Mobile menu button -->
                    <button id="mobileMenuBtn" class="lg:hidden p-2 rounded-lg hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Navigation -->
            <div id="mobileMenu" class="mobile-menu lg:hidden border-t border-gray-200">
                <div class="py-4 space-y-2">
                    <a href="index.php" class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-transport-blue hover:border-l-4 hover:border-transport-blue hover:rounded-r-lg transition-all duration-300">Home</a>
                    <a href="about.php" class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-transport-blue hover:border-l-4 hover:border-transport-blue hover:rounded-r-lg transition-all duration-300">About Us</a>
                    <a href="terminal.php" class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-transport-blue hover:border-l-4 hover:border-transport-blue hover:rounded-r-lg transition-all duration-300">Terminals</a>
                    <a href="routeschedule.php" class="block px-4 py-3 text-sm font-semibold bg-blue-50 text-transport-blue border-l-4 border-transport-blue rounded-r-lg">Routes & Schedules</a>
                    <a href="contact.php" class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-transport-blue hover:border-l-4 hover:border-transport-blue hover:rounded-r-lg transition-all duration-300">Contact</a>
                    <div class="pt-4 mt-4 border-t border-gray-200">
                        <a href="book.php" class="block mx-4 px-6 py-4 text-sm font-semibold bg-gradient-to-r from-transport-orange to-orange-600 text-white rounded-xl text-center shadow-md hover:shadow-lg transition-all duration-300">
                            📋 Book Your Trip Now
                        </a>
                    </div>
                    <div class="pt-2 border-t border-gray-200 sm:hidden">
                        <div class="px-4 py-2 text-sm text-gray-600">Welcome, Guest!</div>
                        <a href="signlog.php" class="block px-4 py-2 text-sm text-transport-blue hover:text-transport-orange transition-colors">Sign Up / Login</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen">
        <!-- Routes & Schedules Section -->
        <section class="py-20 bg-gradient-to-br from-transport-blue via-blue-600 to-transport-orange">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 animate-fadeInUp">
                    <h2 class="text-4xl md:text-6xl font-bold text-white mb-6">
                        Routes & <span class="text-yellow-300">Schedules</span>
                    </h2>
                    <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                        Plan your journey with our reliable schedules. All trips are vice versa.
                    </p>
                </div>

                <div class="animate-slideIn">
                    <div class="bg-white p-8 rounded-xl shadow-xl card-hover mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Routes We Are Serving</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="flex items-center space-x-3 p-4 bg-blue-50 rounded-lg">
                                <svg class="w-6 h-6 text-transport-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                                <p class="text-gray-700">Alimall Cubao - San Jose</p>
                            </div>
                            <div class="flex items-center space-x-3 p-4 bg-blue-50 rounded-lg">
                                <svg class="w-6 h-6 text-transport-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                                <p class="text-gray-700">Alabang - San Jose</p>
                            </div>
                            <div class="flex items-center space-x-3 p-4 bg-blue-50 rounded-lg">
                                <svg class="w-6 h-6 text-transport-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                                <p class="text-gray-700">Cabuyao - San Jose</p>
                            </div>
                            <div class="flex items-center space-x-3 p-4 bg-blue-50 rounded-lg">
                                <svg class="w-6 h-6 text-transport-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                                <p class="text-gray-700">Espana - San Jose</p>
                            </div>
                            <div class="flex items-center space-x-3 p-4 bg-blue-50 rounded-lg">
                                <svg class="w-6 h-6 text-transport-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                                <p class="text-gray-700">San Lazaro - San Jose</p>
                            </div>
                            <div class="flex items-center space-x-3 p-4 bg-blue-50 rounded-lg">
                                <svg class="w-6 h-6 text-transport-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                                <p class="text-gray-700">Pasay - San Jose</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-8 rounded-xl shadow-xl card-hover">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Bus Schedules</h3>
                        <p class="text-gray-600 mb-6 text-center">All trips are vice versa</p>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gradient-to-r from-transport-blue to-transport-orange text-white">
                                        <th class="p-4 font-semibold">Origin</th>
                                        <th class="p-4 font-semibold">Regular Schedule</th>
                                        <th class="p-4 font-semibold">Destination</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b border-gray-200 hover:bg-blue-50">
                                        <td class="p-4">Ali Mall Cubao Terminal</td>
                                        <td class="p-4">9:00 AM / 10:00 AM / 1:00 PM / 4:00 PM</td>
                                        <td class="p-4">San Jose</td>
                                    </tr>
                                    <tr class="border-b border-gray-200 hover:bg-blue-50">
                                        <td class="p-4">Alabang Terminal</td>
                                        <td class="p-4">6:00 AM / 7:00 AM / 2:00 PM / 6:00 PM / 10:00 PM</td>
                                        <td class="p-4">San Jose</td>
                                    </tr>
                                    <tr class="border-b border-gray-200 hover:bg-blue-50">
                                        <td class="p-4">Cabuyao Terminal</td>
                                        <td class="p-4">8:00 AM / 9:00 AM / 4:00 PM / 8:00 PM</td>
                                        <td class="p-4">San Jose</td>
                                    </tr>
                                    <tr class="border-b border-gray-200 hover:bg-blue-50">
                                        <td class="p-4">Espana Terminal</td>
                                        <td class="p-4">4:30 AM / 5:30 AM / 12:00 PM / 4:00 PM / 8:00 PM</td>
                                        <td class="p-4">San Jose</td>
                                    </tr>
                                    <tr class="border-b border-gray-200 hover:bg-blue-50">
                                        <td class="p-4">San Lazaro Terminal</td>
                                        <td class="p-4">3:00 AM / 4:30 AM / 11:00 AM / 3:00 PM / 7:00 PM</td>
                                        <td class="p-4">San Jose</td>
                                    </tr>
                                    <tr class="border-b border-gray-200 hover:bg-blue-50">
                                        <td class="p-4">Pasay Terminal</td>
                                        <td class="p-4">5:00 AM / 6:00 AM / 1:00 PM / 3:00 PM</td>
                                        <td class="p-4">San Jose</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="py-20 bg-gradient-to-r from-gray-50 to-blue-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center animate-fadeInUp">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Ready to Travel?</h2>
                    <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">Book your trip with our convenient schedules today!</p>
                    <a href="book.php" class="inline-block bg-gradient-to-r from-transport-blue to-transport-orange text-white px-8 py-4 rounded-lg font-semibold text-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                        Book Your Journey Now
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center space-x-3 mb-4 md:mb-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-transport-blue to-transport-orange rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-xl">DS</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">Dimple Star Transport</h3>
                        <p class="text-gray-400 text-sm">Your Trusted Travel Partner</p>
                    </div>
                </div>
                
                <div class="text-center md:text-right">
                    <p class="text-gray-400">&copy; 2025 Dimple Star Transport. All rights reserved.</p>
                    <p class="text-sm text-gray-500">Connecting communities, one journey at a time.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
        });

        // Smooth scrolling for anchor links
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

        // Add scroll effect to navigation
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 100) {
                header.classList.add('shadow-2xl');
            } else {
                header.classList.remove('shadow-2xl');
            }
        });

        // Simulate user session (replace with actual PHP session handling)
        function updateUserAccount() {
            const userAccount = document.getElementById('userAccount');
            // This would be replaced with actual PHP session data
            const isLoggedIn = false; // This would come from PHP
            const userEmail = ''; // This would come from PHP session
            
            if (isLoggedIn && userEmail) {
                userAccount.innerHTML = `
                    <div class="text-sm text-gray-600">Welcome, ${userEmail}!</div>
                    <a href="logout.php" class="text-sm text-red-600 hover:text-red-800 transition-colors">Logout</a>
                `;
            } else {
                userAccount.innerHTML = `
                    <div class="text-sm text-gray-600">Welcome, Guest!</div>
                    <a href="signlog.php" class="text-sm text-transport-blue hover:text-transport-orange transition-colors">Sign Up / Login</a>
                `;
            }
        }

        updateUserAccount();
    </script>
</body>
</html>