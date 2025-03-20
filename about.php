<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="relative bg-cover bg-center h-96 flex items-center justify-center" style="background-image: url('assets/images/about-bg.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="text-center text-white z-10 px-6">
        <h1 class="text-5xl font-extrabold">About <span class="text-blue-400">Prakash Photography</span></h1>
        <p class="text-lg mt-2 max-w-2xl mx-auto">Capturing memories, one frame at a time.</p>
    </div>
</section>

<!-- About Content -->
<section class="container mx-auto px-6 py-12 text-center">
    <h2 class="text-4xl font-bold mb-6">Our Story</h2>
    <p class="text-lg text-gray-700 max-w-3xl mx-auto">
        Prakash Photography was founded with a passion for storytelling through stunning visuals. 
        From weddings and portraits to commercial photography, we aim to capture moments that last a lifetime. 
        Our team of skilled photographers brings creativity and expertise to every shot.
    </p>
</section>

<!-- Meet the Team (Optional) -->
<section class="bg-gray-100 py-12">
    <div class="container mx-auto text-center">
        <h2 class="text-4xl font-bold mb-8">Meet Our Team</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <img src="assets/images/team1.jpeg" alt="Photographer 1" class="rounded-full w-32 h-32 mx-auto mb-4">
                <h3 class="text-xl font-semibold">Prakash Pawar</h3>
                <p class="text-gray-700">Founder</p>
            </div>
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <img src="assets/images/team2.jpeg" alt="Photographer 2" class="rounded-full w-32 h-32 mx-auto mb-4">
                <h3 class="text-xl font-semibold">Ganraj Pawar</h3>
                <p class="text-gray-700">Owner & Lead Photographher </p>
            </div>
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <img src="assets/images/team3.jpeg" alt="Photographer 3" class="rounded-full w-32 h-32 mx-auto mb-4">
                <h3 class="text-xl font-semibold">Trupti Bhujbal</h3>
                <p class="text-gray-700">Creative Director</p>
            </div>
        </div>
    </div>
</section>

<!-- Call-to-Action -->
<section class="bg-gradient-to-r from-blue-500 to-purple-600 py-12 text-white text-center">
    <h2 class="text-4xl font-bold mb-4">Let’s Capture Your Special Moments</h2>
    <p class="text-lg mb-6">Get in touch today to book your next photoshoot.</p>
    <a href="contact.php" class="bg-white text-blue-500 px-6 py-3 text-lg font-semibold rounded-lg shadow-md hover:bg-gray-200 transition">
        Contact Us
    </a>
</section>

<?php include 'includes/footer.php'; ?>
