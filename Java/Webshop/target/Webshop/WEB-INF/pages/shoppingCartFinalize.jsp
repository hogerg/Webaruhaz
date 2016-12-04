<head>
<meta charset="UTF-8">
<title>Vásárlás visszaigazolása</title>
</head>

    <jsp:include page="_header.jsp" />
 
 	<div class="text-center">

	    <div class="container">
	        <h3>Köszönjük rendelését! A feldolgozás sikeres volt.</h3>
	        A rendelés sorszáma: ${lastOrderedCart.orderNum}
	    </div>
 
 	</div>

    <jsp:include page="_footer.jsp" />