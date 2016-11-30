<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
 
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
 
<title>Megrendelés véglegesítése</title>
 
<link rel="stylesheet" type="text/css" href="${pageContext.servletContext.contextPath}/resources/css/Site.css">
<link rel="stylesheet" type="text/css" href="${pageContext.servletContext.contextPath}/resources/css/bootstrap.css">
<script src="${pageContext.servletContext.contextPath}/resources/js/jquery-1.10.2.js"></script>
<script src="${pageContext.servletContext.contextPath}/resources/js/bootstrap.js"></script>
 
</head>
<body>
    <jsp:include page="_header.jsp" />
 
 	<div class="text-center">

	    <div class="container">
	        <h3>Köszönjük rendelését! A feldolgozás sikeres volt.</h3>
	        A rendelés sorszáma: ${lastOrderedCart.orderNum}
	    </div>
 
 	</div>

</body>
</html>