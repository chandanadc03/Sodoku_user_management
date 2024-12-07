<?php
/*
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

$player_name = $_POST['player_name'];
$question_id = $_POST['question_id'];
$reply = $_POST['reply'];

$stmt = $pdo->prepare("INSERT INTO replies (player_name, question_id, reply) VALUES (?, ?, ?)");
$stmt->execute([$player_name, $question_id, $reply]);

header('Location: adminq.php');
exit;


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

$stmt = $pdo->query("SELECT * FROM questions");
$questions = $stmt->fetchAll();*/
?>

<!DOCTYPE html>
<html><!--
<head>
	<title>Admin Page</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
	<h1>Player Questions</h1>
	<table>
		<thead>
			<tr>
				<th>Player Name</th>
				<th>Email</th>
				<th>Question</th>
				<th>Reply</th>
			</tr>
		</thead>
		<tbody>
			<?php /*foreach ($questions as $question) { ?>
			<tr id="question-<?= $question['id'] ?>">
				<td><?= htmlspecialchars($question['player_name']) ?></td>
				<td><?= htmlspecialchars($question['email']) ?></td>
				<td><?= htmlspecialchars($question['question']) ?></td>
				<td>
					<form class="reply-form" data-id="<?= $question['id'] ?>">
						<input type="hidden" name="player_name" value="<?= htmlspecialchars($question['player_name']) ?>">
						<input type="hidden" name="question_id" value="<?= htmlspecialchars($question['id']) ?>">
						<textarea name="reply" required></textarea>
						<button type="submit">Reply</button>
					</form>
				</td>
			</tr>
			<?php } */?>
		</tbody>
	</table>

	<script>
		$(document).ready(function() {
			$('.reply-form').on('submit', function(e) {
				e.preventDefault();
				var $form = $(this);
				var questionId = $form.data('id');
				var reply = $form.find('textarea[name="reply"]').val();

				$.ajax({
					url: 'reply.php',
					method: 'POST',
					data: {
						player_name: $form.find('input[name="player_name"]').val(),
						question_id: $form.find('input[name="question_id"]').val(),
						reply: reply
					},
					success: function(data) {
						$('#question-' + questionId + ' td:nth-child(4)').html(reply);
						$form.remove();
					}
				});
			});
		});
	</script>
</body>-->
</html>

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

$stmt = $pdo->query("SELECT q.*, r.reply FROM questions AS q LEFT JOIN replies AS r ON q.question_id = r.question_id ORDER BY q.question_id");
$questionsWithReplies = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $questionsWithReplies[] = array_merge((array)$row, ['has_reply' => !empty($row['reply'])]);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Page</title>
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
		form {
			display: inline-block;
		}
	</style>
</head>
<body>
	<h1>Player Questions</h1>
	<table>
		<thead>
			<tr>
				<th>Player Name</th>
				<th>Email</th>
				<th>Question</th>
				<th>Reply</th>
			</tr>
		</thead>
		<tbody>
		<a href="javascript:history.go(-1)"></a>
        <button onclick="history.go(-1)" class="logout">Go Back</button>
			<?php foreach ($questionsWithReplies as $question) { ?>
			<tr>
				<td><?= htmlspecialchars($question['player_name']) ?></td>
				<td><?= htmlspecialchars($question['email']) ?></td>
				<td><?= htmlspecialchars($question['question']) ?></td>
				<td>
					<?php if (empty($question['reply'])) { ?>
						<form action="reply.php" method="post">
							<input type="hidden" name="player_name" value="<?= htmlspecialchars($question['player_name']) ?>">
							<input type="hidden" name="question_id" value="<?= htmlspecialchars($question['question_id']) ?>">
							<textarea name="reply" required></textarea><br><br>
							<button type="submit">Reply</button>
						</form>
					<?php } else { ?>
						<p><strong>Admin Reply:</strong> <?= htmlspecialchars($question['reply']) ?></p>
						
					<?php } ?>
				</td>
			</tr>
			<?php } ?>
  	 </tbody>
   </table>

<h2>Replies Table</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Player Name</th>
            <th>Question ID</th>
            <th>Reply</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        $stmt = $pdo->query("SELECT * FROM replies ORDER BY reply_id");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
                <td><?= htmlspecialchars($row['reply_id']) ?></td>
                <td><?= htmlspecialchars($row['player_name']) ?></td>
                <td><?= htmlspecialchars($row['question_id']) ?></td>
                <td><?= htmlspecialchars($row['reply']) ?></td>
                
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

</body>
</html>
