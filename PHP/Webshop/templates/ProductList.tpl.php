<?php
	$this->assign('title','Termékek');
	
	$this->display('_Header.tpl.php');
?>

<div class="row">
    <div class="col-md-4">
        <form method="POST" class="input-group text-center">
            <input class="form-control" id="inputKeres" type="text" name="keyword">
            <span class="input-group-btn">
                <input class="btn btn-default" type="submit" value="Keresés"/>
            </span>
        </form>
        <hr />
        <div class="form-group text-center">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                    Kategória
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="./productlist">Minden kategória</a></li>
                    <?php 
                    	foreach($this->categories as $category)
                    	{
                    ?>
                    		<li>
	                    		<a href="./productlist?category=<?php echo $category->Id; ?>"><?php echo $category->Name;?></a>
	                    	</li>
                    <?php 
						}
                    ?>
                </ul>
            </div>
        </div>
        <hr />
    </div>
    <div class="col-md-8">
        <!-- Termeklista -->
		<?php 
			foreach($this->products as $product)
			{
		?>
				<div class="col-md-4 thumbnail">
					<img class="img-responsive" 
	            		src="./images/categories/<?php echo $this->indexedCategories[$product->CategoryId]->PicName; ?>.jpg" 
	            		alt="">
	                <div class="caption text-center" style="white-space:nowrap">
	                    <h5>
	                        <a href="./details?id=<?php echo $product->Id; ?>"><?php echo $product->Name; ?></a>
	                    </h5>
	                    <h4><?php echo $product->Price; ?> Ft.-</h4>
	                    <a class="btn btn-primary" href="./additem?id=<?php echo $product->Id; ?>">Kosárba</a>
	                </div>
	            </div>
		<?php		
			}
		?>
    </div>
</div>

<?php
	$this->display('_Footer.tpl.php');
?>
