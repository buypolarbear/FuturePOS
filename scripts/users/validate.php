<?php
 //LOGOUT
	if ((isset($_GET['doLogout'])) && ($_GET['doLogout']=="true")){
		  $_SESSION[$session_code]['tkn'] = NULL;
		  unset($_SESSION[$session_code]['tkn']);
		  setcookie($session_code."_tkn", '', -250000, '/',  '.'.$_SERVER['HTTP_HOST']);
		  $logoutGoTo = "/";
		  if ($logoutGoTo) {header('location:/'); }
	}

 //LOGIN
	if(isset($_POST['login'])){
		$loginFormAction = $_SERVER['PHP_SELF'];
		if (isset($_GET['accesscheck'])) {
		  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
		 }
		  $email=$_POST['email'];
		  $password=encryptPassword($_POST['password']);

		  $check=returnDBObject("SELECT * FROM datatype_account WHERE email=? AND password=?",array($email,$password));
		  if($check['id']!=''){
		  	$_SESSION[$session_code]['tkn'] = encryptText($email.'-'.$password);
		  	if(isset($_POST['login-remember-me'])){
		  		setcookie($session_code."_tkn", encryptText($email.'-'.$password), time()+2592500, '/',  '.'.$_SERVER['HTTP_HOST']);
		  	}
			  header('location: /');
		  }

		  if($check['id']==''){
			   $error='Username o password errati, riprova.';
		  }
  	}
	if(isset($_SESSION[$session_code]['tkn'])){
		$token=explode('-',decryptText($_SESSION[$session_code]['tkn']));

		$check = returnDBObject("SELECT * FROM datatype_account WHERE email=? AND password=?",array($token[0],$token[1]));

		if(isset($check['id'])){
			$user=$check;
		}else{
		  unset($_SESSION[$session_code]['tkn']);
		  header('location:/');
		}
	}
	if(isset($_COOKIE[$session_code.'_tkn'])){
		$token=explode('-',decryptText($_COOKIE[$session_code.'_tkn']));
		$check = returnDBObject("SELECT * FROM datatype_account WHERE email=? AND password=?",array($token[0],$token[1]));
		if(isset($check['id'])){
			$user=$check;
		}else{
		  setcookie($session_code."_tkn", '', -250000, '/',  '.'.$_SERVER['HTTP_HOST']);
		  header('location:/');
		}
	}

 //RECOVER PASSWORD
	if(isset($_POST['recover'])){
		$check=returnDBObject("SELECT * FROM datatype_account WHERE email=? LIMIT 1",array($_POST['email']));
		if(isset($check['id']) && $check['id']!=''){
			$password=generate_pwd();
			$encryptPassword=encryptPassword($password);
			$nome=$check['nome'].' '.$check['cognome'];
			$email=$check['email'];
			include('scripts/mailing/recoverMail.php');
			runDBQuery("UPDATE datatype_account SET password=? WHERE id=?",array($encryptPassword,$check['id']));
			sendMail(
       $_POST['email'],
       $_POST['nome'].' '.$_POST['cognome'],
       $oggetto,
       $testo
   );
   $_SESSION['success_message']='Abbiamo resettato la password, troverai le istruzioni nella tua e-mail.';
			header('location: /login');
		}else{
			$error='Qualcosa non va, riprova.';
		}
	}

 //REGISTER
	if(isset($_POST['register'])){
		$check=returnDBObject("SELECT * FROM datatype_account WHERE email=? LIMIT 1",array($_POST['email']));
		if(!isset($check['id'])){
			$nome=$_POST['nome'].' '.$_POST['cognome'];
			$password=generate_pwd();
			$encryptPassword=encryptPassword($password);
			$email=$_POST['email'];
			include('scripts/mailing/registrationMail.php');
			runDBQuery("INSERT INTO datatype_account (nome,cognome,email,data_registrazione,password) VALUES (?,?,?,?,?)",
				array($_POST['nome'],$_POST['cognome'],$_POST['email'],date('Y-m-d H:i:s'),$encryptPassword));
			sendMail(
       $_POST['email'],
       $_POST['nome'].' '.$_POST['cognome'],
       $oggetto,
       $testo
   );
   $_SESSION['success_message']='Grazie per esserti registrato!';
			header('location: /login');
		}else{
				$error='Sembra che la tua e-mail è già registrata, prova a recuperare i dati del tuo account.';
		}
	}
?>
