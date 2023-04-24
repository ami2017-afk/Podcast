<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            

            header("Location: desc.html");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
   
	<meta charset="UTF-8">
	<title>Admin Login</title>
	<style>
		body {
			background-color: #fff;
			font-family: Montserrat, sans-serif;
			color: #000000;
		}
		.user{
			margin-left: 310px;

		}

		form {
			background-color: #fff;
			padding: 20px;
			border-radius: 10px;
			width: 50%;
			margin: 0 auto;
			margin-top: 50px;
		}

		label {
			font-weight: bold;
			display: block;
			margin-bottom: 10px;
		}

		input[type="email"], input[type="password"] {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			background-color: #fff;
			box-sizing: border-box;
			border-radius: 5px ;
			border: none;
			border: 2px solid #000000;

		}

		input[type="submit"] {
			width: 100%;
			background-color: #4CAF50;
			color: #fff;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-image: linear-gradient(to right, #4CAF50, #2E8B57);
		}
	</style>
</head>
<body>
<?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
	<form id="login-form" >
		<label for="email">email:</label>
		<input type="email" name="email" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" required>
		<label for="password">Password:</label>
		<input type="password" id="password" name="password" required>

		<input type="submit" value="Login">
		<p class="user"> New user?<a href="signup.html"> Signup</a></p>
	</form>
    <script src="js\login.js"></script>
</body>
</html>
