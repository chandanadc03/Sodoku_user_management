<!DOCTYPE html>
<html>
<head>
    <title>Player Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
        }

        form {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 20px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #444;
        }
    </style>

</head>
<body>
<div class="container">
    <h1>Player Login</h1>
    <form id="loginForm">
        <label for="player_name">Player Name:</label><br>
        <input type="text" id="player_name" name="player_name"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <button type="submit">Login</button>
        <p>Don't have an account? <a href="player_register.html">Register here</a></p>
    </form>
</div>
<script>

    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Get form data
        var playerName = document.getElementById('player_name').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        // Validate form data
        if (playerName === '' || email === '' || password === '') {
            alert('Please fill in all fields.');
            return;
        }

        // Check if the player exists in the database
        var xhr = new XMLHttpRequest();
        
		xhr.open('POST', 'check_player.php', true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onload = function() {
			if (xhr.status === 200) {
				if (xhr.responseText === 'true') {
					window.location.href = 'subs_player.php?player_name=' + playerName; // Redirect to welcome page
				} else if (xhr.responseText === 'false') {
					window.location.href = 'welcome_player.php?player_name=' + playerName; // Redirect to welcome page for non-premium players
				} else {
					alert('An error occurred while checking the player.');
				}
			}
		};
		
		xhr.send('player_name=' + playerName + '&email=' + email + '&password=' + password);
    });

</script>
</body>
</html>
