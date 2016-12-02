<?php
$this->assign('title','Kategória');

$this->display('_Header.tpl.php');
?>

	<form method="POST" action="./newcategory">
        <table style="margin: 0px auto;"> 
            <tr>
                <td>Név </td>
                <td><input name="name" /></td>
                <td style="color: red;"> 
					<?php 
						if(array_key_exists('name', $this->errors))
						{
							echo $this->errors['name'];	
						}
					?>
				</td>
            </tr>
        </table>
        <div class="text-center">
        	<input type="submit" value="Mentés" class="btn btn-default"/> |
        	<a href="./managecategories">Vissza</a>
        </div>
    </form>

<?php
	$this->display('_Footer.tpl.php');
?>