<html>
	<header>
		<title>
			Weather
		</title>
	</header>
</html>

<?php

$password = $_POST['pass'];

	switch($password){
		case 'neutron':
			include 'jsontest.php';
            break;
		default:
		include 'incorrect.php';
		return;
}

?>