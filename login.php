<?php
// Define the salt and stored hash
$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';

// Function to validate input and authenticate user
function authenticate_user($username, $password) {
    global $salt, $stored_hash;
    if (empty($username) || empty($password)) {
        return "User name and password are required"; // pasword is php123
    } else {
        $hashed_password = hash('md5', $salt.$password);
        if ($hashed_password === $stored_hash) {
            // Redirect to game.php if authentication is successful
            header("Location: game.php?name=".urlencode($username));
            exit();
        } else {
            return "Incorrect password";
        }
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $username = $_POST['who'];
    $password = $_POST['pass'];

    // Validate and authenticate user
    $error_message = authenticate_user($username, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Broken Rock Paper Scissors</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h1 class="mt-5 mb-4">Login - Broken Rock Paper Scissors</h1>
    <?php if(isset($error_message)): ?>
        <div class="alert alert-danger" role="alert"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="who">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="pass">
      </div>
      <button type="submit" class="btn btn-primary">Log In</button>
    </form>
  </div>
</body>
</html>
