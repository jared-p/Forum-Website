        <?php
		/*try{ */
			$connString = "mysql:host=localhost;dbname=project_db";
			$user = "root";
			$pass = '';
			$pdo = new PDO($connString,$user, $pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			/*
			$sql = "select * from post";
			$result = $pdo->query($sql);
			while($row = $result->fetch()){
				echo $row['title'].', '.$row['body']."<br>";
			}
			$pdo = null;
		} catch (PDOException $e){
			die ($e->getMessage());
		}
		*/
		