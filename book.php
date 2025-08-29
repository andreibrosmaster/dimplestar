<?php
    include 'php_includes/connection.php';
    include 'php_includes/book.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dimple Star Transport - Book Now</title>
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

        /* Date picker styles */
        .calendar {
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            background-color: #f8fafc;
            color: #1f2937;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 1rem;
            width: 12rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .calendar .months {
            background: linear-gradient(to right, #1e40af, #f97316);
            border: 1px solid #1e40af;
            border-radius: 0.5rem;
            color: #ffffff;
            padding: 0.5rem;
            text-align: center;
            font-weight: 600;
        }
        
        .calendar .prev-month,
        .calendar .next-month {
            padding: 0;
        }
        
        .calendar .prev-month {
            float: left;
        }
        
        .calendar .next-month {
            float: right;
        }
        
        .calendar .current-month {
            margin: 0 auto;
        }
        
        .calendar .months .prev-month,
        .calendar .months .next-month {
            color: #ffffff;
            text-decoration: none;
            padding: 0 0.5rem;
            border-radius: 0.25rem;
            cursor: pointer;
        }
        
        .calendar .months .prev-month:hover,
        .calendar .months .next-month:hover {
            background-color: #fefce8;
            color: #b45309;
        }
        
        .calendar table {
            border-collapse: collapse;
            font-size: 0.85rem;
            width: 100%;
        }
        
        .calendar th {
            text-align: center;
            color: #4b5563;
            font-weight: 600;
        }
        
        .calendar td {
            text-align: right;
            padding: 2px;
            width: 14.3%;
        }
        
        .calendar td span {
            display: block;
            color: #1e40af;
            background-color: #f9fafb;
            border: 1px solid #d1d5db;
            text-decoration: none;
            padding: 0.25rem;
            border-radius: 0.25rem;
            cursor: pointer;
        }
        
        .calendar td span:hover {
            color: #b45309;
            background-color: #fefce8;
            border: 1px solid #facc15;
        }
        
        .calendar td.today span {
            background-color: #fefce8;
            border: 1px solid #facc15;
            color: #1f2937;
            font-weight: 600;
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
                    <a href="routeschedule.php" class="nav-link px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:text-transport-blue hover:bg-blue-50 transition-all duration-300">Routes & Schedules</a>
                    <a href="contact.php" class="nav-link px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:text-transport-blue hover:bg-blue-50 transition-all duration-300">Contact</a>
                    <div class="ml-6 pl-6 border-l border-gray-200">
                        <a href="book.php" class="nav-link nav-active bg-gradient-to-r from-transport-orange to-orange-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg hover:shadow-orange-200 transform hover:scale-105 transition-all duration-300 flex items-center space-x-2">
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
                    <a href="routeschedule.php" class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-transport-blue hover:border-l-4 hover:border-transport-blue hover:rounded-r-lg transition-all duration-300">Routes & Schedules</a>
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
        <!-- Booking Form Section -->
        <section class="py-20 bg-gradient-to-br from-transport-blue via-blue-600 to-transport-orange">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 animate-fadeInUp">
                    <h2 class="text-4xl md:text-6xl font-bold text-white mb-6">
                        Book Your <span class="text-yellow-300">Trip</span>
                    </h2>
                    <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                        Reserve your seat with Dimple Star Transport for a comfortable and reliable journey.
                    </p>
                </div>

                <div class="animate-slideIn">
                    <div class="bg-white p-8 rounded-xl shadow-xl card-hover max-w-2xl mx-auto">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Book Now</h3>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Trip Type</label>
                                <div class="flex space-x-4 mt-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="way" value="1" onclick="document.getElementById('datepick2').disabled=true" checked class="h-4 w-4 text-transport-blue focus:ring-transport-blue border-gray-300">
                                        <span class="ml-2 text-gray-700">One Way</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="way" value="2" onclick="document.getElementById('datepick2').disabled=false" class="h-4 w-4 text-transport-blue focus:ring-transport-blue border-gray-300">
                                        <span class="ml-2 text-gray-700">Two Way</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label for="Origin" class="block text-sm font-medium text-gray-700">Origin</label>
                                <select name="Origin" id="Origin" class="mt-1 block w-full border border-gray-300 rounded-lg p-3 focus:ring-transport-blue focus:border-transport-blue" required>
                                    <option value="0">Select</option>
                                    <option value="San Lazaro">San Lazaro</option>
                                    <option value="Espana">Espana</option>
                                    <option value="Alabang">Alabang</option>
                                    <option value="Cabuyao">Cabuyao</option>
                                    <option value="Naujan">Naujan</option>
                                    <option value="Victoria">Victoria</option>
                                    <option value="Pinamalayan">Pinamalayan</option>
                                    <option value="Gloria">Gloria</option>
                                    <option value="Bongabong">Bongabong</option>
                                    <option value="Roxas">Roxas</option>
                                    <option value="Mansalay">Mansalay</option>
                                    <option value="Bulalacao">Bulalacao</option>
                                    <option value="Magsaysay">Magsaysay</option>
                                    <option value="San Jose">San Jose</option>
                                    <option value="Pola">Pola</option>
                                    <option value="Soccoro">Soccoro</option>
                                </select>
                            </div>
                            <div>
                                <label for="Destination" class="block text-sm font-medium text-gray-700">Destination</label>
                                <select name="Destination" id="Destination" class="mt-1 block w-full border border-gray-300 rounded-lg p-3 focus:ring-transport-blue focus:border-transport-blue" required>
                                    <option value="0">Select</option>
                                    <option value="San Lazaro">San Lazaro</option>
                                    <option value="Espana">Espana</option>
                                    <option value="Alabang">Alabang</option>
                                    <option value="Cabuyao">Cabuyao</option>
                                    <option value="Naujan">Naujan</option>
                                    <option value="Victoria">Victoria</option>
                                    <option value="Pinamalayan">Pinamalayan</option>
                                    <option value="Gloria">Gloria</option>
                                    <option value="Bongabong">Bongabong</option>
                                    <option value="Roxas">Roxas</option>
                                    <option value="Mansalay">Mansalay</option>
                                    <option value="Bulalacao">Bulalacao</option>
                                    <option value="Magsaysay">Magsaysay</option>
                                    <option value="San Jose">San Jose</option>
                                    <option value="Pola">Pola</option>
                                    <option value="Soccoro">Soccoro</option>
                                </select>
                            </div>
                            <div>
                                <label for="no_of_pass" class="block text-sm font-medium text-gray-700">Number of Passengers</label>
                                <input type="number" name="no_of_pass" id="no_of_pass" class="mt-1 block w-full border border-gray-300 rounded-lg p-3 focus:ring-transport-blue focus:border-transport-blue" min="1" required />
                            </div>
                            <div>
                                <label for="datepick1" class="block text-sm font-medium text-gray-700">Departure Date</label>
                                <input id="datepick1" name="Departure" class="mt-1 block w-full border border-gray-300 rounded-lg p-3 focus:ring-transport-blue focus:border-transport-blue" required />
                            </div>
                            <div>
                                <label for="datepick2" class="block text-sm font-medium text-gray-700">Return Date</label>
                                <input id="datepick2" name="Return" class="mt-1 block w-full border border-gray-300 rounded-lg p-3 focus:ring-transport-blue focus:border-transport-blue" disabled />
                            </div>
                            <div>
                                <label for="bustype" class="block text-sm font-medium text-gray-700">Bus Type</label>
                                <select name="bustype" id="bustype" class="mt-1 block w-full border border-gray-300 rounded-lg p-3 focus:ring-transport-blue focus:border-transport-blue" required>
                                    <option value="0">Select</option>
                                    <option value="Air Conditioned">Air Conditioned</option>
                                    <option value="Ordinary">Ordinary</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" name="submit" id="submit" class="w-full bg-gradient-to-r from-transport-blue to-transport-orange text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                                    Submit Booking
                                </button>
                            </div>
                        </form>
                    </div>
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

    <script src="js/datepickr.js"></script>
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

        // Initialize date pickers
        new datepickr('datepick1', {
            'dateFormat': 'y-m-d'
        });
        
        new datepickr('datepick2', {
            'dateFormat': 'y-m-d'
        });
    </script>
</body>
</html>