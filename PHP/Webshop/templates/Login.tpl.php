<?php
$this->assign('title','Bejelentkezés');

$this->display('_Header.tpl.php');
?>
 
    <h2 class="text-center">Bejelentkezés</h2>
    
    <br/>
 
    <div class="text-center">
 
        <form method="POST">
            <table style="margin: 0px auto;">
                <tr>
                    <td>Email </td>
                    <td><input name="email" /></td>
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
                    <td><input type="password" name="password" /></td>
                    <td style="color: red;">
                    	<?php 
							if(array_key_exists('password', $this->errors))
							{
								echo $this->errors['password'];	
							}
						?>
                    </td>
                </tr>

            </table>

            <input type="submit" value="Bejelentkezés" class="btn btn-default text-center"/> |
            <a href="./register">Új fiók létrehozása</a>
            
        </form>
    </div>


<?php
	$this->display('_Footer.tpl.php');
?>