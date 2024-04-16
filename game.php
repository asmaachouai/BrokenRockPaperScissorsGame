<?php
session_start();

// Function to check the game result
function check($computer, $human) {
    $names = array("Rock", "Paper", "Scissors");
    if ($computer == $human) {
        return "Tie";
    } elseif (($human == "Rock" && $computer == "Scissors") ||
              ($human == "Paper" && $computer == "Rock") ||
              ($human == "Scissors" && $computer == "Paper")) {
        return "You Win";
    } else {
        return "You Lose";
    }
}

// Check if user is logged in
// Demand a GET parameter
if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Name parameter missing');
}

// Logout functionality
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
    return;
}

// Game play functionality
$computer_options = array("Rock", "Paper", "Scissors");
$human = $_POST['throw'] ?? null;

if ($human !== null) {
    $computer = $computer_options[array_rand($computer_options)];
    $result = check($computer, $human);
    $output = "Your Play=$human Computer Play=$computer Result=$result";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game - Broken Rock Paper Scissors</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="mt-5 mb-4">Game - Broken Rock Paper Scissors</h1>
    <form method="post" class="mb-3">
        <div class="form-group">
            <label for="throw">Choose your throw:</label>
            <select class="form-control" id="throw" name="throw">
                <option value="Rock">Rock</option>
                <option value="Paper">Paper</option>
                <option value="Scissors">Scissors</option>
                <option value="Test">Test</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="play">Play</button>
        <button type="submit" class="btn btn-danger" name="logout">Logout</button>
    </form>
    <?php if(isset($output)): ?>
        <div class="alert alert-info" role="alert"><?php echo $output; ?></div>
    <?php endif; ?>
</div>
</body>
</html>
