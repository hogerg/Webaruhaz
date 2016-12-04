<?php
$this->assign('title','Webáruház');

$this->display('_Header.tpl.php');
?>

<div>
 	<h2 class="text-center">Elektronikai webáruház</h2>
 	<img class="img-responsive col-md-6 col-md-offset-3" src="./images/mock_webshop.jpg" alt="">
</div>

<?php
	$this->display('_Footer.tpl.php');
?>