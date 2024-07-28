<?php
session_start();
$usersData = json_decode(file_get_contents("../data/users.json"), true);
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    foreach ($usersData['users'] as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $username;
            header('Location: ../device.php'); // Update the redirection path here
            exit;
        }
    }
    
    $errorMessage = 'Invalid username or password.';
}
?>

<?php include '../partials/header.php'; ?>
<style>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin-top: -56px; /* Adjust this value based on your header's height */
    }

    .login-box {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .login-box h2 {
        text-align: center;
        color: #007bff;
    }

    .login-box form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .login-box input[type="text"],
    .login-box input[type="password"] {
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .login-box button {
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .login-box button:hover {
        background-color: #0056b3;
    }

    .login-box p {
        text-align: center;
    }

    .login-box a {
        color: #007bff;
        text-decoration: none;
    }

    .login-box a:hover {
        text-decoration: underline;
    }

    .login-box .error-message {
        color: red;
        text-align: center;
    }
</style>

<div class="login-container">
    <div class="login-box">
        <h2>Login</h2>
        <?php if ($errorMessage): ?>
            <p class="error-message"><?= htmlspecialchars($errorMessage) ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</div>
