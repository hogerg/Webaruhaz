<?php
$this->assign('title','Termék');

$this->display('_Header.tpl.php');
?>

<h2 class="text-center">Termék <?php echo ($this->inputData['name'] == '') ? 'létrehozása' : 'módosítása';?></h2>
	<hr/>

	<form method="POST" action="./newproduct">
		<input type="hidden" value="<?php echo $this->inputData['id']; ?>" name="id" />
        <table style="margin: 0px auto;">

            <tr>
                <td>Név </td>
                <td><input name="name" value="<?php echo $this->inputData['name']; ?>" /></td>
                <td style="color: red;"> 
					<?php 
						if(array_key_exists('name', $this->errors))
						{
							echo $this->errors['name'];	
						}
					?>
				</td>
            </tr>
 
            <tr>
                <td>Ár </td>
                <td><input name="price" value="<?php echo $this->inputData['price']; ?>" /></td>
                <td style="color: red;"> 
					<?php 
						if(array_key_exists('price', $this->errors))
						{
							echo $this->errors['price'];	
						}
					?>
				</td>
            </tr> 
            
            <tr>
                <td>Kategória </td>
                <td>
                	<select id="categoryId" name="categoryId">
                		<?php 
                			foreach($this->categories as $category)
                			{
                		?>
                			<option value="<?php echo $category->Id; ?>" <?php if($this->inputData['categoryId'] == $category->Id) echo 'selected'; ?>>
                				<?php echo $category->Name; ?>
                			</option>
                		<?php 
                			}
                		?>
                	</select>
                </td>
            </tr> 

        </table>
        <div class="text-center">
        	<input type="submit" value="Mentés" class="btn btn-default"/> |
        	<a href="./manageproducts">Vissza</a>
        </div>
    </form>

<?php
	$this->display('_Footer.tpl.php');
?>