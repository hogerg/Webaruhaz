<?php
$this->assign('title','Vásárlás visszaigazolása');

$this->display('_Header.tpl.php');
?>

<div class="text-center">

	<div class="container">
	    <h3>Köszönjük rendelését! A feldolgozás sikeres volt.</h3>
	    A rendelés sorszáma: <?php echo $this->orderNum; ?>
	</div>
 
</div>


<?php
	$this->display('_Footer.tpl.php');
?>