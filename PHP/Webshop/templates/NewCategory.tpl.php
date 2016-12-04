<?php
$this->assign('title','Kategória');

$this->display('_Header.tpl.php');
?>

<h2 class="text-center">Kategória létrehozása</h2>
	<hr/>

	<form method="POST" action="./newcategory" enctype="multipart/form-data">
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
            <tr>
            	<td>Képfeltöltés </td>
            	<td><input type="file" name="fileToUpload" id="fileToUpload"></td>
            	
            </tr>
            <tr>
            	<td></td>
            	<td style="color: red;">
            		<?php 
						if(array_key_exists('picture', $this->errors))
						{
							foreach ($this->errors['picture'] as $err)
							{
								echo $err . '<br/>';
							}
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