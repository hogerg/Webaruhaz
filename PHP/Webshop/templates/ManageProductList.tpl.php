<?php
$this->assign('title','Termékek kezelése');

$this->display('_Header.tpl.php');
?>

<h2>Terméklista</h2>
    
    <p>
    	<a href="./newproduct">Termék létrehozása</a> | <a href="./managecategories">Kategóriák kezelése</a>
    </p>
    
    <table class="table" style="margin: 0px auto;">
    	<tr>
    		<th> 
    			Kategória
    		</th>
    		<th> 
    			Termék neve
    		</th>
    		<th> 
    			Ár
    		</th>
    		<th></th>
    	</tr>
    	
    	<?php 
    		foreach($this->products as $product)
    		{
    	?>
	    		<tr>
	    			<td>
	    				<?php echo $this->indexedCategories[$product->CategoryId]->Name; ?>
	    			</td>
	    			<td>
	    				<?php echo $product->Name; ?>
	    			</td>
	    			<td>
	    				<?php echo $product->Price ?> Ft.-
	    			</td>
	    			<td>
	    				<a href="./newproduct?id=<?php echo $product->Id; ?>">Módosítás</a> | 
	    				<a href="./details?id=<?php echo $product->Id; ?>">Részletek</a> | 
	    				<a href="./deleteproduct?id=<?php echo $product->Id; ?>">Törlés</a>
	    			</td>
	    		</tr>
    	<?php 
    		}
    	?>
    	
    </table>

<?php
	$this->display('_Footer.tpl.php');
?>