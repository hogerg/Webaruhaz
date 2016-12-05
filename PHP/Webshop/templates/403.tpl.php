<?php
$this->assign('title','Hozzáférés megtagadva');

$this->display('_Header.tpl.php');
?>

	<h2 style="color:red;">Hozzáférés megtagadva!</h2>
	
	<h3>Nincs jogosultsága megtekinteni az oldalt!</h3>


<?php
	$this->display('_Footer.tpl.php');
?>