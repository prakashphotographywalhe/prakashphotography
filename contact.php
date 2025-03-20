<?php include 'includes/header.php'; ?>

<main class="container mx-auto px-6 py-8">
    <h1 class="text-4xl font-bold text-center mb-8">Contact Us</h1>
    <form class="max-w-lg mx-auto">
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" id="name" class="w-full px-4 py-2 border rounded-lg">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" id="email" class="w-full px-4 py-2 border rounded-lg">
        </div>
        <div class="mb-4">
            <label for="message" class="block text-gray-700">Message</label>
            <textarea id="message" class="w-full px-4 py-2 border rounded-lg"></textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Submit</button>
    </form>
</main>

<?php include 'includes/footer.php'; ?>
