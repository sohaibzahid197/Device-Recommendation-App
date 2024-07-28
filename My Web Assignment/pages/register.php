<?php

$filePath = '../data/users.json';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    if (file_exists($filePath)) {
        $currentData = file_get_contents($filePath);
        $arrayData = json_decode($currentData, true);
    } else {
        $arrayData = ["users" => []];
    }
    
    $userExists = false;
    foreach ($arrayData["users"] as $user) {
        if ($user["username"] === $username) {
            $message = "Username already exists.";
            $userExists = true;
            break;
        }
    }
    
    if (!$userExists) {
        $newUserData = [
            "username" => $username,
            "password" => $hashedPassword,
            "email" => $email
        ];
        $arrayData["users"][] = $newUserData;
        
        if (file_put_contents($filePath, json_encode($arrayData, JSON_PRETTY_PRINT))) {
            $message = "Your Registration Successful And Stores in a Json File.";
        } else {
            $message = "Error :: Could not save the user data.";
        }
    }
}
?>

<?php include '../partials/header.php'; ?>
<style>
.register-container 
{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 30px;
}

.register-box
 {
    width: 100%;
    max-width: 400px;
    background-color: #fff;
    padding: 50px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.register-box h2 
{
    text-align: center;
    color: #007bff;
}

.register-box form
 {
    display: flex;
    flex-direction: column;
}

.form-group 
{
    margin-bottom: 15px;
}

.form-group label
 {
    display: block;
    margin-bottom: 5px;
}

.register-box input[type="text"],
.register-box input[type="password"],
.register-box input[type="email"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
}

.register-box .register-button
 {
    padding: 10px;
    width: 100%;
    
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.register-box .register-button:hover {
/*     background-color: #0056b3; */
}

.register-box p {
    text-align: center;
}

.register-box a {
    color: #007bff;
    text-decoration: none;
}


.message {
    text-align: center;
    color: green;
    margin-bottom: 15px;
}

</style>
<div class="register-container">
    <div class="register-box">
        <h2>Registration Form</h2>
        <?php if (!empty($message)) : ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Register" class="register-button">
            </div>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</div>

<?php include '../partials/footer.php'; ?>