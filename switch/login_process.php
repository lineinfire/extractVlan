<?php
	
	require_once 'dbconfig.php';

	if(isset($_POST))

	{
		
		$user_email = trim($_POST['username']);
		$user_password = trim($_POST['password']);
		
		$password = md5($user_password);
		
		try
		{	
		
			$stmt = $db_con->prepare("SELECT * FROM logins WHERE username=:email");
			$stmt->execute(array(":email"=>$user_email));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			
			if($row['password']==$password){
				
			
				$_SESSION['user_session'] = $row['username'];

					echo "login success"; // log in
			}
			else{
				
				echo "<i class='fas fa-info-circle'><span style='color:red;'>Username / Password invalid.</span></i>"; // wrong details 
			}
				
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	} 


?>