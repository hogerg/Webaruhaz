<?php
$this->assign('title','Kapcsolat');

$this->display('_Header.tpl.php');
?>


    <div class="col-md-6">
        <h2>Elérhetőségek</h2>
        <hr />
        <address> 
            <strong>1117 Budapest, Magyar tudósok körútja 2</strong> <br />
            <strong>Support:</strong>   <a href="mailto:hodiger@gmail.com">hodiger@gmail.com</a><br />
        </address>
    </div>
    <div class="col-md-6">
        <iframe class="col-md-12" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2696.888331778964!2d19.05774755146094!3d47.47260547907374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741ddabb29bd997%3A0x4b453205e2d0f96b!2sBME+Building+I!5e0!3m2!1shu!2shu!4v1479314243500" 
                 height="400" style="border:0"></iframe>
    </div>


<?php
	$this->display('_Footer.tpl.php');
?>
