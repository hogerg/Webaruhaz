<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@ taglib prefix="fmt" uri="http://java.sun.com/jsp/jstl/fmt" %>
 
<%@ taglib uri="http://www.springframework.org/security/tags" prefix="security" %>
 
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Terméklista</title>

<link rel="stylesheet" type="text/css" href="${pageContext.servletContext.contextPath}/resources/css/Site.css">
<link rel="stylesheet" type="text/css" href="${pageContext.servletContext.contextPath}/resources/css/bootstrap.css">
<script src="${pageContext.servletContext.contextPath}/resources/js/jquery-1.10.2.js"></script>
<script src="${pageContext.servletContext.contextPath}/resources/js/bootstrap.js"></script>
 
</head>
<body>
 
    <jsp:include page="_header.jsp" />
    
    <br/>
    
    <div class="row">
	    <div class="col-md-4">
	        <form method="POST" class="input-group text-center">
	            <input class="form-control" id="inputKeres" type="text" name="keyword">
	            <span class="input-group-btn">
	                <input class="btn btn-default" type="submit" value="Keresés"/>
	            </span>
	        </form>
	        <hr />
	        <div class="form-group text-center">
	            <div class="dropdown">
	                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
	                    Kategória
	                    <span class="caret"></span>
	                </button>
	                <ul class="dropdown-menu">
	                    <li><a href="/Webshop/productList">Minden kategória</a></li>
	                    <c:forEach items="${Categories}" var="item">
	                    	<li>
	                    		<a href="/Webshop/productList?category=${item.id}">${item.name}</a>
	                    	</li>
	                    </c:forEach>
	                </ul>
	            </div>
	        </div>
	        <hr />
	    </div>
	    <div class="col-md-8">
	        <!-- Termeklista -->
	        <c:forEach items="${Products}" var="item">
	            <div class="col-md-4 thumbnail">
	            	<img class="img-responsive" 
	            		src="${pageContext.servletContext.contextPath}/resources/img/categories/${ProductImages.get(item.id)}.jpg" 
	            		alt="">
	                <div class="caption text-center" style="white-space:nowrap">
	                    <h5>
	                        <a href="/Webshop/details?id=${item.id}">${item.name}</a>
	                    </h5>
	                    <h4><fmt:formatNumber type="number" 
            					maxFractionDigits="0" value="${item.price}" /> Ft.-</h4>
	                    <a class="btn btn-primary" href="${pageContext.request.contextPath}/buyProduct?id=${item.id}">Kosárba</a>
	                    
	                    <security:authorize  access="hasRole('ROLE_MANAGER')">
		                  <a style="color:red;"
		                      href="${pageContext.request.contextPath}/product?id=${prodInfo.id}">
		                        Termék módosítása</a>
		                </security:authorize>
	                </div>
	            </div>
	        </c:forEach>
	    </div>
	</div>

 
</body>
</html>