<?php
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

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['player_name']) && isset($_POST['time'])) {
    $playerName = $_POST['player_name'];
    $time = $_POST['time'];

    // Insert data into leaderboard table
    $stmt = $pdo->prepare("INSERT INTO leaderboard (player_name, time) VALUES (:player_name, :time)");
    $stmt->execute(['player_name' => $playerName, 'time' => $time]);
}

// Retrieve updated leaderboard data
$stmt = $pdo->query("SELECT * FROM leaderboard ORDER BY time ASC");
$players = $stmt->fetchAll();

$rank = 1;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard</title>
   <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        body {
  /* Gradient background */
  background: linear-gradient(45deg, #4158d0, #c850c0, #ffcc70);
  background-size: 1000% 1000%;
  animation: Gradient 10s ease infinite;

  /* Centered layout */
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  height: 100vh;
  padding: 2rem;
}

table {
  /* Shadow effect */
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

th,
td {
  text-align: left;
  padding: 1rem;
  font-size: 1.2rem;
}

th {
  background-color: #f5f5f5;
}

.btn {
  /* Gradient background */
background-color:lightcyan;
 
  background-position: right bottom;
  transition:  0.5s ease;

  /* Height, width, and display settings */
  height: 3rem;
 
  display: inline-block;

  /* Font and text styling */
  border-radius: 5px;
  border: none;
  font-size: 1.2rem;
  
  text-transform: uppercase;

  /* Hover animation */
  &:hover {
    background-position: left bottom;
  }
}

@keyframes Gradient {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}

/* Media query for smaller screens */
@media (max-width: 600px) {
  .btn {
    margin: 1rem;
    width: 100%;
  }

  table {
    width: 100%;
    margin-top: 1rem;
  }
}
</style> 

</head>
<body>
    <h1>Leaderboard</h1>
    
    <!-- Form to submit player data 
    <form method="post">
        <label for="player_name">Player Name:</label>
        <input type="text" name="player_name" required>
        
        <label for="time">Time:</label>
        <input type="text" name="time" required>
        
        <button type="submit">Submit</button>
    </form>
    -->
    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Player Name</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($players as $player) { ?>
                <tr>
                    <td><?= $rank ?></td>
                    <td><?= htmlspecialchars($player['player_name']) ?></td>
                    <td><?= $player['time'] ?></td>
                </tr>
                <?php $rank++; ?>
            <?php } ?>
        </tbody>
    </table>
    <div class="btn " >
                    <a href="Landingpage.php" >Home</a>
                </div> <br>
                <br>

                <div class="btn" onclick="goBack()"  >Goback</div>
                <script>
                    function goBack()
                    {
                      window.history.back()
                    }
                  </script>

</body>
</html>