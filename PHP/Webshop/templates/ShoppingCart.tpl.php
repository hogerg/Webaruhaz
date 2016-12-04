<?php
$this->assign('title','Kosár');

$this->display('_Header.tpl.php');
?>

	    <div class="col-md-4 text-center">
	        <h3 style="white-space:nowrap">Fizetendő: 
	            <span id="cart-total">
	                <?php 
	                	$total = 0;
	                	if(isset($_SESSION['CartItems']))
	                	{
	                		foreach($_SESSION['CartItems'] as $id => $item)
	                		{
	                			$total += $item[0]->Price * $item[1];
	                		}	
	                	}
	                	echo $total . ' Ft.-';
	                ?>
	            </span>
	        </h3>
	        <hr/>
	        <span>
	        	<a class="btn btn-primary" href="./customerdetails">Tovább a fizetésre</a>
	        </span>
	        <hr />
	        <div id="update-message"></div>
	    </div>
	    <div class="col-md-8">
	        <!-- Kosár tartalma -->
			<?php 
				if(isset($_SESSION['CartItems']))
				{
					foreach($_SESSION['CartItems'] as $id => $item)
					{
			?>
						<div class="col-md-4 thumbnail">
							<img class="img-responsive" 
			            		src="./images/categories/<?php echo $item[2]; ?>.jpg" 
			            		alt="">
		                	<div class="caption text-center" style="white-space: nowrap">
		                		<h5>
		                			<?php echo $item[0]->Name; ?>
		                		</h5>
		                		<h5>
		                			Termékkód: <?php echo $item[0]->Id; ?>
		                		</h5>
		                		<h5>
		                			Ár: <?php echo $item[0]->Price; ?> Ft.-
		                		</h5>
		                		<div>
		                			Darabszám: <?php echo $item[1]; ?>
		                		</div>
		                		<br/>
		                		<div>
		                			Alösszeg: <?php echo $item[0]->Price * $item[1]; ?> Ft.-
		                		</div>
		                		<br/>
		                		<a href="./removeitem?id=<?php echo $id; ?>">
		                        	Eltávolítás 
		                        </a>
		                	</div>
						</div>
			<?php
					}
				}
			?>
	    </div>

<?php
	$this->display('_Footer.tpl.php');
?>