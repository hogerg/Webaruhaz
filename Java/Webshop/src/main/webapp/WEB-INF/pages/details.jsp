<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@taglib uri="http://www.springframework.org/tags/form" prefix="form"%>
<%@ taglib prefix="fmt" uri="http://java.sun.com/jsp/jstl/fmt" %>
 
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Termék részletei</title>

<link rel="stylesheet" type="text/css" href="${pageContext.servletContext.contextPath}/resources/css/Site.css">
<link rel="stylesheet" type="text/css" href="${pageContext.servletContext.contextPath}/resources/css/bootstrap.css">
<script src="${pageContext.servletContext.contextPath}/resources/js/jquery-1.10.2.js"></script>
<script src="${pageContext.servletContext.contextPath}/resources/js/bootstrap.js"></script>
 
</head>
<body>
 
    <jsp:include page="_header.jsp" />
  
	<div class="container">
	    <div class="row">
	        <div class="col-md-6 text-center">
				<img class="img-responsive" 
					src="${pageContext.servletContext.contextPath}/resources/img/categories/${category.picName}.jpg" 
					alt="">
	            <div class="row-fluid">
	                <a class="btn btn-primary" href="${pageContext.request.contextPath}/buyProduct?id=${product.id}">Kosárba</a>
	            </div>
	        </div>
	        <div class="col-md-6">
	            <h1>
	                ${product.name}
	            </h1>
	            <h3>
	                Termékkód: ${product.id}
	            </h3>
	            <h3>
	                Kategória: ${category.name}
	            </h3>
	            <h3>
	                Ár: <fmt:formatNumber type="number" 
            					maxFractionDigits="0" value="${product.price}" /> Ft.-
	            </h3>
	            <hr />
	        </div>
	    </div>
	</div>

 
 
</body>
</html>