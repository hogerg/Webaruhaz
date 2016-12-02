<?php
$this->assign('title','Termék részletei');

$this->display('_Header.tpl.php');
?>

	<div class="container">
	    <div class="row">
	        <div class="col-md-6 text-center">
	        	<img class="img-responsive" 
	            		src="./images/categories/<?php echo $this->category->PicName; ?>.jpg" 
	            		alt="">
	            <div class="row-fluid">
	                <a class="btn btn-primary" href="#">Kosárba</a>
	            </div>
	        </div>
	        <div class="col-md-6">
	            <h1>
	                <?php echo $this->product->Name; ?>
	            </h1>
	            <h3>
	                Termékkód: <?php echo $this->product->Id; ?>
	            </h3>
	            <h3>
	                Kategória: <?php echo $this->category->Name; ?>
	            </h3>
	            <h3>
	                Ár: <?php echo $this->product->Price; ?> Ft.-
	            </h3>
	            <hr />
	        </div>
	    </div>
	</div>

<?php
	$this->display('_Footer.tpl.php');
?>
