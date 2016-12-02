<?php
$this->assign('title','Vásárlás');

$this->display('_Header.tpl.php');
?>

<h2 class="text-center">Megrendelés</h2>
	
	<br/>
 	
 	<div class="text-center">
	    <form method="POST" action="./customerdetails">
	 
	        <table style="margin: 0px auto;">
	            <tr>
	                <td>Név </td>
	                <td><input name="name" value="<?php echo $this->inputData['name']; ?>"/></td>
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
	                <td>Cím </td>
	                <td><input name="address" value="<?php echo $this->inputData['address']; ?>"/></td>
	                <td style="color: red;"> 
						<?php 
							if(array_key_exists('address', $this->errors))
							{
								echo $this->errors['address'];	
							}
						?>
					</td>
	            </tr>
	 
	            <tr>
	                <td>Telefonszám</td>
	                <td><input name="phone" value="<?php echo $this->inputData['phone']; ?>"/></td>
	                <td style="color: red;"> 
						<?php 
							if(array_key_exists('phone', $this->errors))
							{
								echo $this->errors['phone'];	
							}
						?>
					</td>
	            </tr>
	 
	            <tr>
	                <td>Email </td>
	                <td><input name="email" value="<?php echo $this->inputData['email']; ?>" /></td>
	                <td style="color: red;"> 
						<?php 
							if(array_key_exists('email', $this->errors))
							{
								echo $this->errors['email'];	
							}
						?>
					</td>
	            </tr>
	
	        </table>
	        <div class="row text-center">
	            <input type="checkbox" name="accept"/> Elfogadom az általános felhasználói feltételeket <br/>
	            <span style="color: red;">
					<?php 
						if(array_key_exists('accept', $this->errors))
						{
							echo $this->errors['accept'];	
						}
					?>
	            </span>
	        </div>
	 		<input type="submit" value="Rendelés feladása" class="btn btn-default text-center"/>
	    </form>
 	</div>

<?php
	$this->display('_Footer.tpl.php');
?>