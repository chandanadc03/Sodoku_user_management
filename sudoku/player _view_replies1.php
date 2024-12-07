<?php /*
session_start();

if (!isset($_SESSION['player_name'])) {
    header("Location: player_login.php"); // Redirect to player login page if not logged in
    exit;
}

$player_name = $_SESSION['player_name'];

try {
    $host = 'localhost';
    $db = 'sahana';
    $user = 'sahana';
    $pass = 'sahanac@2004*';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);

    $stmt = $pdo->prepare("SELECT q.*, r.reply FROM questions q LEFT JOIN replies r ON q.question_id = r.question_id WHERE q.player_name = :player_name ORDER BY q.question_id DESC");
    $stmt->execute(['player_name' => $player_name]);
    $questions = $stmt->fetchAll();
} catch (\Throwable $e) {
    die('Error connecting to database: ' . $e->getMessage());
} 
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    <title>Player Questions and Replies</title>
</head>
<body>
    <h1>Your Questions and Replies</h1>
    <table>
        <thead>
            <tr>
                <th>Question</th>
                <th>Reply</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $question) { ?>
                <tr>
                    <td><?= htmlspecialchars($question['question']) ?></td>
                    <td><?= htmlspecialchars($question['reply']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body> */


session_start();

if (!isset($_SESSION['player_name'])) {
    header("Location: player_login.html"); // Redirect to player login page if not logged in
    exit;
}

$player_name = $_SESSION['player_name'];

try {
    $host = 'localhost';
    $db = 'database1';
    $user = 'sahana';
    $pass = 'sahanac@2004*';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);

    $stmt = $pdo->prepare("SELECT q.*, r.reply FROM questions q LEFT JOIN replies r ON q.question_id = r.question_id WHERE q.player_name = :player_name ORDER BY q.question_id DESC");
    $stmt->execute(['player_name' => $player_name]);
    $questions = $stmt->fetchAll();
} catch (\Throwable $e) {
    die('Error connecting to database: ' . $e->getMessage());
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    <title>Player Questions and Replies</title>
</head>
<body>
    <h1>Your Questions and Replies</h1>
    <table>
        <thead>
            <tr>
                <th>Question</th>
                <th>Reply</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $question) { ?>
                <tr>
                    <td><?= htmlspecialchars($question['question']) ?></td>
                    <td><?= htmlspecialchars($question['reply']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>