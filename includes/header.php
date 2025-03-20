<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prakash Photography</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">

<header class="bg-gradient-to-r from-blue-500 to-purple-600 p-4 shadow-lg">
    <nav class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="index.php" class="text-3xl font-bold text-white tracking-wide">Prakash Photography</a>

        <!-- Navigation Links -->
        <div class="hidden md:flex space-x-6 items-center">
            <a href="index.php" class="text-white hover:text-gray-300 transition">Home</a>
            <a href="gallery.php" class="text-white hover:text-gray-300 transition">Gallery</a>
            <a href="booking.php" class="text-white hover:text-gray-300 transition">Book a Slot</a>
            <a href="my_bookings.php" class="text-white hover:text-gray-300 transition">My Bookings</a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Admin Panel Link (Only for Admins) -->
                <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <a href="admin.php" class="bg-yellow-500 px-4 py-2 text-white rounded-lg shadow-md hover:bg-yellow-600 transition">
                        Admin Panel
                    </a>
                <?php endif; ?>

                <span class="text-white font-semibold">
                    Welcome, <?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?> 
                    (<?= isset($_SESSION['role']) ? ucfirst($_SESSION['role']) : 'Guest' ?>)
                </span>
                <a href="logout.php" class="bg-red-500 px-4 py-2 text-white rounded-lg shadow-md hover:bg-red-600 transition">
                    Logout
                </a>
            <?php else: ?>
                <a href="login.php" class="bg-green-500 px-4 py-2 text-white rounded-lg shadow-md hover:bg-green-600 transition">
                    Login
                </a>
                <a href="register.php" class="bg-blue-700 px-4 py-2 text-white rounded-lg shadow-md hover:bg-blue-800 transition">
                    Register
                </a>
            <?php endif; ?>
        </div>

        <!-- Mobile Menu Button -->
        <button class="md:hidden text-white text-2xl focus:outline-none" id="menu-toggle">
            ☰
        </button>

        <!-- Mobile Dropdown -->
        <div id="mobile-menu" class="absolute top-16 right-4 bg-white shadow-lg rounded-lg p-4 hidden w-48 z-40">
            <a href="index.php" class="block py-2 text-gray-800 hover:text-gray-500">Home</a>
            <a href="gallery.php" class="block py-2 text-gray-800 hover:text-gray-500">Gallery</a>
            <a href="booking.php" class="block py-2 text-gray-800 hover:text-gray-500">Book a Slot</a>
            <a href="my_bookings.php" class="block py-2 text-gray-800 hover:text-gray-500">My Bookings</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Admin Panel Link (Only for Admins) -->
                <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <a href="admin.php" class="block py-2 text-yellow-600 hover:text-yellow-800">Admin Panel</a>
                <?php endif; ?>

             
                <a href="logout.php" class="block py-2 text-red-600 hover:text-red-800">Logout</a>
            <?php else: ?>
                <a href="login.php" class="block py-2 text-green-600 hover:text-green-800">Login</a>
                <a href="register.php" class="block py-2 text-blue-600 hover:text-blue-800">Register</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
