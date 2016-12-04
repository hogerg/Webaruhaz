<?php
$this->assign('title','Kategóriák kezelése');

$this->display('_Header.tpl.php');
?>


<h2>Kategóriák</h2>
    
    <p>
    	<a href="./newcategory">Kategória létrehozása</a> | <a href="./manageproducts">Vissza</a>
    </p>
    
    <table class="table" style="margin: 0px auto;">
    	<tr>
    		<th> 
    			Kategória
    		</th>
    		<th></th>
    	</tr>
    	
    	<?php 
    		foreach($this->categories as $category)
    		{
    	?>
    		<tr>
    			<td>
    				<?php echo $category->Name; ?>
    			</td>
    			<td>
    				<a href="./deletecategory?id=<?php echo $category->Id; ?>">Törlés</a>
    			</td>
    		</tr>
    	<?php 
    		}
    	?>
    	
    </table>

<?php
	$this->display('_Footer.tpl.php');
?>