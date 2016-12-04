<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<!-- ><meta http-equiv="X-Frame-Options" content="deny"> -->
		<base href="<?php $this->eprint($this->ROOT_URL); ?>" />
		<title><?php $this->eprint($this->title); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="WEBSHOP" />
		<meta name="author" content="phreeze builder | phreeze.com" />

		<!-- Le styles -->
		<!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />-->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
		<link href="styles/style.css" rel="stylesheet" />
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link href="bootstrap/css/font-awesome.min.css" rel="stylesheet" />
		<!--[if IE 7]>
		<link rel="stylesheet" href="bootstrap/css/font-awesome-ie7.min.css">
		<![endif]-->
		<link href="bootstrap/css/datepicker.css" rel="stylesheet" />
		<link href="bootstrap/css/timepicker.css" rel="stylesheet" />
		<link href="bootstrap/css/bootstrap-combobox.css" rel="stylesheet" />
		
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="images/favicon.ico" />
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/apple-touch-icon-114-precomposed.png" />
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72-precomposed.png" />
		<link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon-57-precomposed.png" />

		<script type="text/javascript" src="scripts/libs/LAB.min.js"></script>
		<script type="text/javascript">
			$LAB.script("//code.jquery.com/jquery-1.8.2.min.js").wait()
				//.script("bootstrap/js/bootstrap.min.js")
				.script("bootstrap/js/bootstrap.js")
				.script("bootstrap/js/bootstrap-datepicker.js")
				.script("bootstrap/js/bootstrap-timepicker.js")
				.script("bootstrap/js/bootstrap-combobox.js")
				.script("scripts/libs/underscore-min.js").wait()
				.script("scripts/libs/underscore.date.min.js")
				.script("scripts/libs/backbone-min.js")
				.script("scripts/app.js")
				.script("scripts/model.js").wait()
				.script("scripts/view.js").wait()
		</script>

	</head>

	<body>

			<div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="./productlist">Termékek</a></li>
                        <li><a href="./shoppingcart">Kosár (<?php echo isset($_SESSION['CartItems']) ? count($_SESSION['CartItems']) : '0'; ?>)</a></li>
                        <li><a href="./about">Információ</a></li>
                        <li><a href="./contact">Kapcsolat</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    	<?php if(isset($_SESSION['authUser']))
                    		{
                    			if($_SESSION['authUser'][1] == 'MANAGER')
                    			{
                    	?>
                    				<li><a href="./manageproducts">Készlet</a></li>
                    	<?php			
                    			}
                    	?>
                    			<li><a href=""><?php echo ($_SESSION['authUser'][0]); ?></a></li>
                    			<li><a href="./logout">Kijelentkezés</a></li>
                    	<?php
                    		}
                    		else
                    		{
                    	?>
		                    	<li><a href="./register">Regisztráció</a></li>
		                    	<li><a href="./login">Bejelentkezés</a></li>
		                <?php 
                    		}
		                ?>
                    </ul>
                </div>
            </div>
        </div> 
		<div class="col-md-10 col-md-offset-1">	
			
			
			