<?php
/** @package    WEBSHOP::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Customer.php");
require_once("Model/Product.php");

class AccountController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 *
	 * @inheritdocs
	 */
	protected function Init()
	{
		parent::Init();

		// TODO: add controller-wide bootstrap code

		// TODO: if authentiation is required for this entire controller, for example:
		// $this->RequirePermission(ExampleUser::$PERMISSION_USER,'SecureExample.LoginForm');
	}
	
	public function Login()
	{
		if(isset($_SESSION['authUser']))
		{
			$this->Render('index');
		}
		else
		{
			$this->Assign('errors', array());
			$this->Render('login');
		}
	}
	
	public function LoginRequested()
	{
		try{
			$email = RequestUtil::Get('email');
			$password = RequestUtil::Get('password');
			
			$errors = array();
				
			if($email == '')
			{
				$errors += array('email' => 'Email kötelező!');
			}
			if($password == '')
			{
				$errors += array('password' => 'Jelszó kötelező!');
			}
			
			if(count($errors) > 0)
			{
				$this->Assign('errors', $errors);
				$this->Render('Login');
			}
			else
			{
				require_once('Model/CustomerCriteria.php');
				$criteria = new CustomerCriteria();
				$criteria->Email_Equals = $email;
				
				$customer = $this->Phreezer->Query('Customer', $criteria)->ToObjectArray();
				
				if(count($customer) == 0)
				{
					$errors += array('email' => 'Nem található a megadott email cím');
					$this->Assign('errors', $errors);
					$this->Render('Login');
				}
				else
				{
					$c = $customer[0];
					if(md5($password) != $c->Password)
					{
						$errors += array('password' => 'Hibás jelszó');
						$this->Assign('errors', $errors);
						$this->Render('login');
					}
					else
					{
						$_SESSION['authUser'] = array($email, $c->UserRole);
						$url = RequestUtil::Get('redirecturl');
						if(Empty($url))
						{
							header('location: ./productlist');
							exit();
						}
						else
						{
							header('location: ./' . $url);
							exit();
						}
					}
				}
			}
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
	
	public function Logout()
	{
		if(isset($_SESSION['authUser']))
		{
			unset($_SESSION['authUser']);
		}
		
		$this->Render('index');
	}
	
	public function Register()
	{
		$this->Assign('errors', array());
		$this->Assign('inputData', array('email' => '', 'password' => '', 'passwordc' => ''));
		$this->Render('Register');
	}
	
	public function RegisterSave()
	{
		try
		{
			$email = RequestUtil::Get('email');
			$password = RequestUtil::Get('password');
			$passwordc = RequestUtil::Get('passwordc');
			
			$customer = new Customer($this->Phreezer);
			$customer->Email = $email;
			$customer->Password = md5($password);
			$customer->UserRole = 'CUSTOMER';

			$errors = array();
			
			if($email == '')
			{
				$errors += array('email' => 'Email kötelező!');
			}
			if($password == '')
			{
				$errors += array('password' => 'Jelszó kötelező!');
			}
			if($passwordc == '')
			{
				$errors += array('passwordc' => 'Jelszó megerősítése kötelező!');
			}
			if($password != '' && $passwordc != '' && $password != $passwordc)
			{
				$errors += array('passwordc' => 'A megerősítőnek egyeznie kell a jelszóval!');
			}

			if(count($errors) > 0)
			{
				$this->Assign('errors', $errors);
				$this->Assign('inputData', array('email' => $email, 'password' => $password, 'passwordc' => $passwordc));
				$this->Render('Register');
			}
			else
			{
				$customer->Save();
				
				$this->SendRegistrationEmail($email);
				//$this->Assign("errors", array());
				//$this->Render('Login');
				
				header('location: ./login');
				exit();
			}
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
	
	private function SendRegistrationEmail($address)
	{
		require_once("PHPMailer/PHPMailerAutoload.php");
		
		$mail = new PHPMailer;
		
		//$mail->SMTPDebug = 3;                               // Enable verbose debug output
		
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'hogergwebshop@gmail.com';          // SMTP username
		$mail->Password = 'szakdolgozat';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to
		
		$mail->setFrom('hogergwebshop@gmail.com');
		$mail->addAddress($address);               // Name is optional

		$mail->CharSet = 'UTF-8';
		$mail->Subject = 'Webshop regisztráció';
		$mail->Body    = 'Köszönjük, hogy regisztrált a webáruházunkba!';
		
		$mail->send();
	}

}

?>
