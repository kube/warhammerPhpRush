<?php 

function chat($user)
{
	echo "<div id='chat'><div id='messages'></div>";
	?>
<script type="text/javascript">
$(document).ready(function() {
	setInterval(function() {
		$('#messages').load('get_chat.php');
		$('#messages').scrollBottom = 1000;
	}, 300); 
});

</script>
	
	<form action="index.php" method="post" >
		<input type="text" name="message" id="message" maxlength="42" autofocus/>
		<input type="button" id="send"  value="Press Enter">
	</form>
	<?php
	if (isset($_POST['message']))
	{
		$msg = "<span class='mess'><span class='name'>".$user."</span>: ".$_POST['message']."</span><hr />".PHP_EOL;
		if(!file_exists('chat.txt'))
			fopen('chat.txt', 'x');
		file_put_contents('chat.txt', $msg, FILE_APPEND);
	}
	echo "</div>";
}
?>
