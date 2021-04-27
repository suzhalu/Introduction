<?php
require("comon.php");
session_start();
	if($_SERVER["REQUEST_METHOD"]==="POST"){
		// try {
		// 	$pdo = new PDO('mysql:host=localhost;dbname=portforio;charset=utf8','root','',
		// 	array(PDO::ATTR_EMULATE_PREPARES => false));
		// }
		// catch (PDOException $e) {
		// 	die('データベース接続失敗。'.$e->getMessage());
		// }
		$pdo=connect();

		$stmt=$pdo->prepare("SELECT `pass`,`title01`,`title02`,`title03`,`textarea01`,`textarea02`,`textarea03` FROM `portforio` WHERE `mail`=:mail");
		$stmt->bindParam(":mail",$_POST["mail"]);
		$stmt->execute();
		$result=$stmt->fetch();
		if($result){
			if($_POST["pass"]===$result["pass"]){
				session_regenerate_id(true);
				$_SESSION['mail']=$_POST["mail"];
				$_SESSION['title01']=$result["title01"];
				$_SESSION['textarea01']=$result["textarea01"];
				$_SESSION['title02']=$result["title02"];
				$_SESSION['textarea02']=$result["textarea02"];
				$_SESSION['title03']=$result["title03"];
				$_SESSION['textarea03']=$result["textarea03"];
				header("Location: ../../home.html");
				exit();

			} else {
				$errors="パスワードが違います";
			}
		} else{
			$errors="ユーザーが存在しません";
		}

		$stmt=null;
		if(isset($errors)){
			$pdo=null;	
		}

	} else {
			die("直接アクセス禁止");
	}
?>


