<?php
	include_once("./database.php");
	
	function CreatePost($txt)
	{
		$txt = htmlspecialchars($txt);
		echo "<div class=\"forumpost\">$txt</div>";
	}
	
	if( isset($_POST["message"]) && strlen($_POST["message"])>0 )
	{
		WritePost($_POST["message"]);
	}
?>


<html>
	<style>
		.forumpost {
			margin: 10px;
			padding: 10px;
			border: double;
			width: 400px;
		}
		
		.writing {
			margin: 10px;
			padding: 10px;
			border: dotted;
			width: 420px;
			height: 130px;
		}
	</style>	
	
	<head>
		<title> Bulletin Board </title>
	</head>
	
	<body>
		<center>
			<h1> Bulletin Board </h1>

			<?php
				$posts = GetPosts();
				foreach($posts as $post)
					CreatePost($post['msg']);
			?>
			
			<form method="post">
				<br>
				<br>
				<textarea name="message" type="text" class="writing"></textarea>
				<br>
				<input type="submit">
			</form>
		</center>
	</body>
</html>