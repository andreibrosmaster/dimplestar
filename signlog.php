<?php
    $con = mysqli_connect("localhost", "root", "", "users_db");
    
    $errors = array();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_type'])) {
        if ($_POST['form_type'] === 'signup') {
            if (preg_match("/\S+/", $_POST['fname']) === 0) {
                $errors['fname'] = "* First Name is required.";
            }
            if (preg_match("/\S+/", $_POST['lname']) === 0) {
                $errors['lname'] = "* Last Name is required.";
            }
            if (preg_match("/.+@.+\..+/", $_POST['email']) === 0) {
                $errors['email'] = "* Not a valid e-mail address.";
            }
            if (preg_match("/.{8,}/", $_POST['password']) === 0) {
                $errors['password'] = "* Password must contain at least 8 characters.";
            }
            if (strcmp($_POST['password'], $_POST['confirm_password'])) {
                $errors['confirm_password'] = "* Passwords do not match.";
            }
            
            if (count($errors) === 0) {
                $fname = mysqli_real_escape_string($con, $_POST['fname']);
                $lname = mysqli_real_escape_string($con, $_POST['lname']);
                $email = mysqli_real_escape_string($con, $_POST['email']);
                
                $password = hash('sha256', $_POST['password']);
                function createSalt() {
                    $string = md5(uniqid(rand(), true));
                    return substr($string, 0, 3);
                }
                $salt = createSalt();
                $password = hash('sha256', $salt . $password);
                
                $search_query = mysqli_query($con, "SELECT * FROM members WHERE email = '$email'");
                $num_row = mysqli_num_rows($search_query);
                if ($num_row >= 1) {
                    $errors['email'] = "Email address is unavailable.";
                } else {
                    $sql = "INSERT INTO members(`fname`, `lname`, `email`, `salt`, `password`) VALUES ('$fname', '$lname', '$email', '$salt', '$password')";
                    $query = mysqli_query($con, $sql);
                    $_POST['fname'] = '';
                    $_POST['lname'] = '';
                    $_POST['email'] = '';
                    
                    $successful = "<p class='text-green-600 font-semibold'>You are successfully registered.</p>";
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dimple Star Transport - Sign Up / Login</title>
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

        /* Form toggle styles */
        .carousel-container {
            position: relative;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .carousel-item {
            transition: opacity 0.5s ease-in-out;
        }

        .carousel-button {
            transition: all 0.3s ease;
        }

        .carousel-button.active {
            background: linear-gradient(to right, #1e40af, #f97316);
            color: white;
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
        <!-- Sign Up / Login Section -->
        <section class="py-20 bg-gradient-to-br from-transport-blue via-blue-600 to-transport-orange">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 animate-fadeInUp">
                    <h2 class="text-4xl md:text-6xl font-bold text-white mb-6">
                        Sign Up or <span class="text-yellow-300">Login</span>
                    </h2>
                    <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                        Create an account or log in to book your trips with Dimple Star Transport.
                    </p>
                </div>

                <div class="animate-slideIn">
                    <div class="flex justify-center mb-6">
                        <button id="loginBtn" class="carousel-button px-6 py-3 mx-2 rounded-lg font-semibold text-gray-700 bg-white hover:bg-gray-100 transition-all duration-300 active">Login</button>
                        <button id="signupBtn" class="carousel-button px-6 py-3 mx-2 rounded-lg font-semibold text-gray-700 bg-white hover:bg-gray-100 transition-all duration-300">Sign Up</button>
                    </div>
                    <div class="carousel-container bg-white p-8 rounded-xl shadow-xl card-hover">
                        <!-- Login Form -->
                        <div class="carousel-item" id="loginForm">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Login</h3>
                            <form method="post" action="login.php" class="space-y-6">
                                <input type="hidden" name="form_type" value="login">
                                <?php if (isset($_GET['message'])): ?>
                                    <p class="text-red-600 font-semibold text-center"><?php echo htmlspecialchars($_GET['message']); ?></p>
                                <?php endif; ?>
                                <div>
                                    <label for="login_email" class="block text-sm font-medium text-gray-700">E-mail</label>
                                    <input type="email" name="login_email" id="login_email" class="mt-1 block w-full border border-gray-300 rounded-lg p-3 focus:ring-transport-blue focus:border-transport-blue" required />
                                </div>
                                <div>
                                    <label for="login_password" class="block text-sm font-medium text-gray-700">Password</label>
                                    <input type="password" name="login_password" id="login_password" class="mt-1 block w-full border border-gray-300 rounded-lg p-3 focus:ring-transport-blue focus:border-transport-blue" required />
                                </div>
                                <div>
                                    <button type="submit" name="submit" class="w-full bg-gradient-to-r from-transport-blue to-transport-orange text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- Sign Up Form -->
                        <div class="carousel-item" id="signupForm" style="display: none;">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Sign Up</h3>
                            <form method="post" action="signlog.php" class="space-y-6">
                                <input type="hidden" name="form_type" value="signup">
                                <?php if (isset($successful)): ?>
                                    <?php echo $successful; ?>
                                <?php endif; ?>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="fname" class="block text-sm font-medium text-gray-700">First Name</label>
                                        <input type="text" name="fname" id="fname" placeholder="First Name" value="<?php if (isset($_POST['fname'])) echo htmlspecialchars($_POST['fname']); ?>" class="mt-1 block w-full border border-gray-300 rounded-lg p-3 focus:ring-transport-blue focus:border-transport-blue" required />
                                        <?php if (isset($errors['fname'])): ?>
                                            <p class="text-red-600 text-sm mt-1"><?php echo $errors['fname']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <label for="lname" class="block text-sm font-medium text-gray-700">Last Name</label>
                                        <input type="text" name="lname" id="lname" placeholder="Last Name" value="<?php if (isset($_POST['lname'])) echo htmlspecialchars($_POST['lname']); ?>" class="mt-1 block w-full border border-gray-300 rounded-lg p-3 focus:ring-transport-blue focus:border-transport-blue" required />
                                        <?php if (isset($errors['lname'])): ?>
                                            <p class="text-red-600 text-sm mt-1"><?php echo $errors['lname']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">E-mail Address</label>
                                    <input type="email" name="email" id="email" placeholder="E-mail Address" value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>" class="mt-1 block w-full border border-gray-300 rounded-lg p-3 focus:ring-transport-blue focus:border-transport-blue" required />
                                    <?php if (isset($errors['email'])): ?>
                                        <p class="text-red-600 text-sm mt-1"><?php echo $errors['email']; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <label for="pw" class="block text-sm font-medium text-gray-700">Password</label>
                                    <input type="password" name="password" id="pw" placeholder="Password" class="mt-1 block w-full border border-gray-300 rounded-lg p-3 focus:ring-transport-blue focus:border-transport-blue" required />
                                    <?php if (isset($errors['password'])): ?>
                                        <p class="text-red-600 text-sm mt-1"><?php echo $errors['password']; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <label for="cpw" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="cpw" placeholder="Confirm Password" class="mt-1 block w-full border border-gray-300 rounded-lg p-3 focus:ring-transport-blue focus:border-transport-blue" required />
                                    <?php if (isset($errors['confirm_password'])): ?>
                                        <p class="text-red-600 text-sm mt-1"><?php echo $errors['confirm_password']; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <button type="submit" name="submit" class="w-full bg-gradient-to-r from-transport-blue to-transport-orange text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                                        Sign Up
                                    </button>
                                </div>
                            </form>
                        </div>
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

        // Form toggle functionality
        const loginBtn = document.getElementById('loginBtn');
        const signupBtn = document.getElementById('signupBtn');
        const loginForm = document.getElementById('loginForm');
        const signupForm = document.getElementById('signupForm');

        loginBtn.addEventListener('click', () => {
            loginBtn.classList.add('active');
            signupBtn.classList.remove('active');
            loginForm.style.display = 'block';
            signupForm.style.display = 'none';
        });

        signupBtn.addEventListener('click', () => {
            signupBtn.classList.add('active');
            loginBtn.classList.remove('active');
            loginForm.style.display = 'none';
            signupForm.style.display = 'block';
        });

        // Initialize with login form visible
        loginBtn.classList.add('active');

        // Simulate user session (replace with actual PHP session handling)
        function updateUserAccount() {
            const userAccount = document.getElementById('userAccount');
            <?php
                $isLoggedIn = isset($_SESSION['email']);
                $userEmail = $isLoggedIn ? $_SESSION['email'] : '';
            ?>
            const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
            const userEmail = <?php echo json_encode($userEmail); ?>;
            
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