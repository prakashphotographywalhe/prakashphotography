<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="relative bg-cover bg-center h-screen flex items-center justify-center" style="background-image: url('assets/images/images.JPG');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="text-center text-white z-10 px-6">
        <h1 class="text-5xl font-extrabold mb-4">Welcome to <span class="text-blue-400">Prakash Photography</span></h1>
        <p class="text-lg mb-6 max-w-xl mx-auto">Discover breathtaking photos, share your own, and book exclusive photoshoot slots.</p>
        <a href="gallery.php" class="bg-blue-500 px-6 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-blue-600 transition">
            Explore Gallery
        </a>
    </div>
</section>

<!-- About Us Section -->
<section class="container mx-auto px-6 py-12 text-center">
    <h2 class="text-4xl font-bold mb-6">About Us</h2>
    <p class="text-lg text-gray-700 max-w-3xl mx-auto">
        Prakash Photography is dedicated to capturing life’s most beautiful moments with artistic precision. Our passion is to create lasting memories through stunning photography.
    </p>
    <a href="about.php" class="mt-4 inline-block bg-blue-500 px-6 py-3 text-white rounded-lg shadow-md hover:bg-blue-600 transition">
        Learn More
    </a>
</section>

<!-- Features Section -->
<section class="container mx-auto px-6 py-12 text-center">
    <h2 class="text-4xl font-bold mb-8">Why Choose Prakash Photography?</h2>
    <div class="grid md:grid-cols-3 gap-8">
        <div class="p-6 bg-white shadow-lg rounded-lg">
            <i class="fas fa-camera-retro text-blue-500 text-5xl mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">High-Quality Images</h3>
            <p class="text-gray-700">Explore a collection of professional and user-submitted high-resolution photos.</p>
        </div>
        <div class="p-6 bg-white shadow-lg rounded-lg">
            <i class="fas fa-user-friends text-blue-500 text-5xl mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">Community of Creatives</h3>
            <p class="text-gray-700">Join photographers and artists from all over the world.</p>
        </div>
        <div class="p-6 bg-white shadow-lg rounded-lg">
            <i class="fas fa-calendar-check text-blue-500 text-5xl mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">Book a Photoshoot</h3>
            <p class="text-gray-700">Reserve a slot with top photographers and get stunning photoshoots.</p>
        </div>
    </div>
</section>

<!-- Featured Gallery Preview -->
<section class="bg-gray-100 py-12">
    <div class="container mx-auto text-center">
        <h2 class="text-4xl font-bold mb-8">Featured Photos</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <img src="assets/images/IMG_3.JPG" alt="Featured Photo 1" class="rounded-lg shadow-md">
            <img src="assets/images/IMG_2.JPG" alt="Featured Photo 2" class="rounded-lg shadow-md">
            <img src="assets/images/IMG_1.JPG" alt="Featured Photo 3" class="rounded-lg shadow-md">
        </div>
        <a href="gallery.php" class="mt-6 inline-block bg-blue-500 px-6 py-3 text-white rounded-lg shadow-md hover:bg-blue-600 transition">
            View Full Gallery
        </a>
    </div>
</section>

<!-- Testimonials Section -->
<section class="container mx-auto px-6 py-12 text-center">
    <h2 class="text-4xl font-bold mb-8">What Our Clients Say</h2>
    <div class="grid md:grid-cols-2 gap-8">
        <div class="p-6 bg-white shadow-lg rounded-lg">
            <p class="text-gray-700 italic">"I had an incredible experience with Prakash Photography. They made me feel so comfortable during the shoot, and the final photos turned out absolutely stunning. Highly recommend for anyone looking for professional and beautiful photography."</p>
            <h4 class="mt-4 font-semibold">- Shivanjali Gaikwad</h4>
        </div>
        <div class="p-6 bg-white shadow-lg rounded-lg">
            <p class="text-gray-700 italic">"We hired Prakash Photography for our wedding, and I couldn't be happier! They captured every moment beautifully, from the little candid shots to the grand ceremony. The photos are memories we’ll cherish forever."</p>
            <h4 class="mt-4 font-semibold">- Sourabh Pawar</h4>
        </div>
    </div>
</section>

<!-- Call-to-Action Section -->
<section class="bg-gradient-to-r from-blue-500 to-purple-600 py-12 text-white text-center">
    <h2 class="text-4xl font-bold mb-4">Join Our Community Today</h2>
    <p class="text-lg mb-6">Sign up and start exploring, sharing, and booking photoshoots.</p>
    <a href="register.php" class="bg-white text-blue-500 px-6 py-3 text-lg font-semibold rounded-lg shadow-md hover:bg-gray-200 transition">
        Get Started
    </a>
</section>

<?php include 'includes/footer.php'; ?>
