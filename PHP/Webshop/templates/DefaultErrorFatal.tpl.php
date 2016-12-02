<?php
	$this->assign('title','Webshop');

	$this->display('_Header.tpl.php');
?>

<div class="container">

	<h1>Hiba történt!</h1>

	<!-- this is used by app.js for scraping -->
	<!-- ERROR <?php $this->eprint($this->message); ?> /ERROR -->

	<h3 onclick="$('#stacktrace').show('slow');" class="well" style="cursor: pointer;"><?php $this->eprint($this->message); ?></h3>

	<div id="stacktrace" class="well hide">
		<p style="font-weight: bold;">Stack Trace:</p>
		<?php if ($this->stacktrace) { ?>
			<p style="white-space: nowrap; overflow: auto; padding-bottom: 15px; font-family: courier new, courier; font-size: 8pt;"><pre><?php $this->eprint($this->stacktrace); ?></pre></p>
		<?php } ?>
	</div>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>