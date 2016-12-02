<?php
$this->assign('title','Regisztráció');

$this->display('_Header.tpl.php');
?>

<h2 class="text-center">Regisztráció</h2>

<div class="text-center">
	<form method="POST" action="./register">
		<table style="margin: 0px auto;">
	    	<tr>
	        	<td>Email </td>
	            <td><input name="email" value="<?php echo $this->inputData['email']; ?>"/></td>
	            <td style="color: red;"> 
					<?php 
						if(array_key_exists('email', $this->errors))
						{
							echo $this->errors['email'];	
						}
					?>
				</td>
	        </tr>
	 
	        <tr>
	            <td>Jelszó </td>
	            <td><input type="password" name="password" value="<?php echo $this->inputData['password']; ?>"/></td>
	            <td style="color: red;"> 
					<?php 
						if(array_key_exists('password', $this->errors))
						{
							echo $this->errors['password'];	
						}
					?>
				</td>
	        </tr>
	                
	        <tr>
	            <td>Jelszó megerősítése </td>
	            <td><input type="password" name="passwordc" value="<?php echo $this->inputData['passwordc']; ?>"/></td>
	            <td style="color: red;">
		            <?php 
						if(array_key_exists('passwordc', $this->errors))
						{
							echo $this->errors['passwordc'];	
						}
					?>
				</td>
	        </tr>
	
	    </table>
	
	    <input type="submit" value="Regisztráció" class="btn btn-default text-center"/>
	            
	</form>
</div>

<?php
	$this->display('_Footer.tpl.php');
?>