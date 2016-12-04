<%@ taglib prefix="fmt" uri="http://java.sun.com/jsp/jstl/fmt" %>

<head>
<meta charset="UTF-8">
<title>Term�k r�szletei</title>
<body>
 
    <jsp:include page="_header.jsp" />
  
	<div class="container">
	    <div class="row">
	        <div class="col-md-6 text-center">
				<img class="img-responsive" 
					src="${pageContext.servletContext.contextPath}/resources/img/categories/${category.picName}.jpg" 
					alt="">
	            <div class="row-fluid">
	                <a class="btn btn-primary" href="${pageContext.request.contextPath}/buyProduct?id=${product.id}">Kos�rba</a>
	            </div>
	        </div>
	        <div class="col-md-6">
	            <h1>
	                ${product.name}
	            </h1>
	            <h3>
	                Term�kk�d: ${product.id}
	            </h3>
	            <h3>
	                Kateg�ria: ${category.name}
	            </h3>
	            <h3>
	                �r: <fmt:formatNumber type="number" maxFractionDigits="0" value="${product.price}" /> Ft.-
	            </h3>
	            <hr />
	            <jsp:include page="_lorem.jsp" />
	        </div>
	    </div>
	</div>

	<jsp:include page="_footer.jsp" />