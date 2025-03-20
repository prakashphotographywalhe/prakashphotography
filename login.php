<?php include 'includes/header.php'; ?>

<?php
include 'db.php';

$error = ""; // Variable to store error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: booking.php");
            }
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    }
}
?><main class="container flex justify-center items-center h-screen">
<div class="bg-white p-8 rounded-lg shadow-md w-96">
    <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

    <?php if (!empty($error)): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-4">
            <input type="email" name="email" placeholder="Email" required
                class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-400"
                value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
        </div>

        <div class="mb-4">
            <input type="password" name="password" placeholder="Password" required
                class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-400">
        </div>

        <button type="submit"
            class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
            Login
        </button>
    </form>

    <p class="text-center text-gray-600 mt-4">
        Don't have an account? <a href="register.php" class="text-blue-500">Register</a>
    </p>
</div>
</main>

<?php include 'includes/footer.php'; ?>
