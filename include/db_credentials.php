        <?php
		/*
		$connString = null;
		$user = null;
		$pass = null;
		$pdo = null;
		try {*/
		$connString = "mysql:host=localhost;dbname=project_db";
		$user = "root";
		$pass = '';
		$pdo = new PDO($connString, $user, $pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		/*} catch (PDOException $e) {
			die($e->getMessage());
		}*/
