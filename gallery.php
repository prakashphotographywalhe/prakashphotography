<?php
include 'db.php';

$stmt = $pdo->query("SELECT * FROM photos ORDER BY uploaded_at DESC");
$photos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/header.php'; ?>

<main class="container mx-auto px-6 py-8">
    <h1 class="text-4xl font-bold text-center mb-8">Photo Gallery</h1>

    <?php if (empty($photos)): ?>
        <p class="text-center text-gray-500">No photos available yet. Check back later!</p>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php foreach ($photos as $photo): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <a href="<?= htmlspecialchars($photo['image_url']) ?>" target="_blank">
                        <img src="<?= htmlspecialchars($photo['image_url']) ?>" 
                             alt="<?= htmlspecialchars($photo['title']) ?>" 
                             class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300"
                             loading="lazy">
                    </a>
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2 text-gray-800"><?= htmlspecialchars($photo['title']) ?></h2>
                        <p class="text-gray-600"><?= nl2br(htmlspecialchars($photo['description'])) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>
