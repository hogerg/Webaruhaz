<?php
/** @package    WEBSHOP::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Product.php");
require_once("Model/Order.php");
require_once("Model/OrderDetails.php");


class StoreController extends AppBaseController
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

	public function List()
	{		
		require_once('Model/ProductCriteria.php');
		$criteria = new ProductCriteria();

		$category = intval(RequestUtil::Get('category'));
		$keyword = RequestUtil::Get('keyword');
		
		if(!Empty($category))
		{
			$criteria->CategoryId_Equals = $category;
		}
		if(!Empty($keyword))
		{
			$criteria->Name_IsLike = $keyword;
		}
		
		$categories = $this->Phreezer->Query('Category');
		$products = $this->Phreezer->Query('Product', $criteria);
		
		$indexedCategories = array();
		foreach($categories as $c)
		{
			$indexedCategories += array($c->Id => $c);
		}
		
		$this->Assign('categories', $categories);
		$this->Assign('products', $products);
		$this->Assign('indexedCategories', $indexedCategories);

		$this->Render('ProductList');
	}
	
	public function Details()
	{
		$id = intval(RequestUtil::Get('id'));
		
		if(Empty($id))
		{
			header("Location: ./productlist");
			exit();
		}
		else
		{
			$product = $this->Phreezer->Get('Product', $id);
			$category = $this->Phreezer->Get('Category', $product->CategoryId);
			
			$this->Assign('product', $product);
			$this->Assign('category', $category);
			
			$this->Render('Details');
		}
	}
	
	public function ShoppingCartAdd()
	{
		$id = intval(RequestUtil::Get('id'));
		
		if(!Empty($id))
		{
			$product = $this->Phreezer->Get('Product', $id);
			$img = $this->Phreezer->Get('Category', $product->CategoryId)->PicName;
			if(!isset($_SESSION['CartItems']))
			{
				$_SESSION['CartItems'] = array($product->Id => array($product,1,$img));
			}
			else 
			{
				$cart = $_SESSION['CartItems'];
				if(array_key_exists($id, $cart))
				{
					$cart[$id][1]++;
				}
				else
				{
					$cart[$id] = array($product,1,$img);
				}
				
				$_SESSION['CartItems'] = $cart;
			}
		}

		header("Location: ./productlist");
		exit();
	}
	
	public function ShoppingCartRemove()
	{
		$id = intval(RequestUtil::Get('id'));
		
		if(!Empty($id))
		{
			if(isset($_SESSION['CartItems'][$id]))
			{
				unset($_SESSION['CartItems'][$id]);
			}
		}
		
		header("Location: ./shoppingcart");
		exit();
	}
	
	public function ShoppingCartDrop()
	{
		if(isset($_SESSION['CartItems']))
		{
			unset($_SESSION['CartItems']);
		}
	}
	
	public function ShoppingCart()
	{
		$this->Render('ShoppingCart');
	}
	
	public function CustomerForm()
	{
		if(!isset($_SESSION['CartItems']) || count($_SESSION['CartItems']) == 0)
		{
			$this->Render('ShoppingCart');
		}
		else if(!isset($_SESSION['authUser']))
		{
			header('location: ./login?redirecturl=shoppingcart');
			exit();
		}
		else
		{
			$email = $_SESSION['authUser'][0];
			$name = '';
			$address = '';
			$phone = '';
			
			require_once('Model/OrderCriteria.php');
			$criteria = new OrderCriteria();
			$criteria->CustomerEmail_Equals = $_SESSION['authUser'][0];
			
			$criteria->SetOrder('OrderNum', true);
			
			$previousOrder = $this->Phreezer->Query('Order', $criteria)->ToObjectArray();
			
			if(count($previousOrder) > 0)
			{
				$name = $previousOrder[0]->CustomerName;
				$address = $previousOrder[0]->CustomerAddress;
				$phone = $previousOrder[0]->CustomerPhone;
			}
			
			$this->Assign('errors', array());
			$this->Assign('inputData', array('name' => $name, 'address' => $address, 'phone' => $phone, 'email' => $email));
			$this->Render('ShoppingCartCustomer');
		}
	}
	
	public function SaveOrder()
	{
		if(!isset($_SESSION['authUser']))
		{
			header("Location: ./login?redirecturl=customerdetails");
			exit();
		}
		else
		{
			try
			{
				$name = RequestUtil::Get('name');
				$address = RequestUtil::Get('address');
				$phone = RequestUtil::Get('phone');
				$email = RequestUtil::Get('email');
				
				$errors = array();
				
				if($name == '')
				{
					$errors += array('name' => 'Név kötelező!');
				}
				if($address == '')
				{
					$errors += array('address' => 'Cím kötelező!');
				}
				if($phone == '')
				{
					$errors += array('phone' => 'Telefonszám kötelező!');
				}
				if($email == '')
				{
					$errors += array('email' => 'Email kötelező!');
				}
				if(!isset($_POST['accept']))
				{
					$errors += array('accept' => 'A feltételek elfogadása kötelező!');
				}
				
				if(count($errors) > 0)
				{
					$this->Assign('errors', $errors);
					$this->Assign('inputData', array('name' => $name, 'address' => $address, 'phone' => $phone, 'email' => $email));
					$this->Render('ShoppingCartCustomer');
				}
				else
				{
					$storedOrders = $this->Phreezer->Query('Order');
					$lastOrderNum = 0;
					foreach($storedOrders as $o)
					{
						if($o->OrderNum > $lastOrderNum)
						{
							$lastOrderNum = $o->OrderNum;
						}
					}
					
					$amount = 0;
					foreach($_SESSION['CartItems'] as $id => $item)
					{
						$amount +=  $item[0]->Price * $item[1];
					}
					
					$now = new DateTime();
					
					$order = new Order($this->Phreezer);
					$orderId = $this->gen_uuid();
					
					$order->Id = $orderId;
					$order->Amount = $amount;
					$order->OrderDate = $now->format('Y-m-d H:i:s');
					$order->OrderNum = $lastOrderNum+1;
					$order->CustomerAddress = $address;
					$order->CustomerEmail = $email;
					$order->CustomerName = $name;
					$order->CustomerPhone = $phone;
					
					$order->Save(true);
					//
					//
					foreach($_SESSION['CartItems'] as $id => $item)
					{
						$orderDetails = new OrderDetails($this->Phreezer);
						$detailsId = $this->gen_uuid();
						$orderDetails->Id = $detailsId;
						$orderDetails->Amount = $item[0]->Price * $item[1];
						$orderDetails->Price = $item[0]->Price;
						$orderDetails->Quantity = $item[1];
						$orderDetails->OrderId = $orderId;
						$orderDetails->ProductId = $id;
						
						$orderDetails->Save(true);
					}
					//
					
					$this->SendOrderConfirmationEmail($email, $name, $lastOrderNum+1);
					$this->Assign('orderNum', $lastOrderNum+1);
					$this->Render('ShoppingCartFinalize');
					if(isset($_SESSION['CartItems']))
					{
						unset($_SESSION['CartItems']);
					}
				}
			}
			catch (Exception $ex)
			{
				$this->RenderExceptionJSON($ex);
			}
		}
	}
	
	private function SendOrderConfirmationEmail($address, $name, $orderNum)
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
		$mail->Subject = 'Webshop vásárlás';
		$mail->Body    = 'Kedves ' . $name . "!\n\nKöszönjük, hogy vásárolt a webáruházunkban!\n\nRendelésének azonosítója: " . $orderNum;
	
		$mail->send();
	}
	
	private function gen_uuid() {
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
				// 32 bits for "time_low"
				mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
	
				// 16 bits for "time_mid"
				mt_rand( 0, 0xffff ),
	
				// 16 bits for "time_hi_and_version",
				// four most significant bits holds version number 4
				mt_rand( 0, 0x0fff ) | 0x4000,
	
				// 16 bits, 8 bits for "clk_seq_hi_res",
				// 8 bits for "clk_seq_low",
				// two most significant bits holds zero and one for variant DCE1.1
				mt_rand( 0, 0x3fff ) | 0x8000,
	
				// 48 bits for "node"
				mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
				);
	}


}

?>
