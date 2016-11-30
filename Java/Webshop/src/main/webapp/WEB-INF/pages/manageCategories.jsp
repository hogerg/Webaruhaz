<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@ taglib prefix="fmt" uri="http://java.sun.com/jsp/jstl/fmt" %>
 
<%@ taglib uri="http://www.springframework.org/security/tags" prefix="security" %>
 
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Kategóriák kezelése</title>

<link rel="stylesheet" type="text/css" href="${pageContext.servletContext.contextPath}/resources/css/Site.css">
<link rel="stylesheet" type="text/css" href="${pageContext.servletContext.contextPath}/resources/css/bootstrap.css">
<script src="${pageContext.servletContext.contextPath}/resources/js/jquery-1.10.2.js"></script>
<script src="${pageContext.servletContext.contextPath}/resources/js/bootstrap.js"></script>
 
</head>
<body>
	
    <jsp:include page="_header.jsp" />
    
    <br/>
    
    <h2>Kategóriák</h2>
    
    <p>
    	<a href="/Webshop/manageCategories/newCategory">Kategória létrehozása</a> | <a href="/Webshop/manageProducts">Vissza</a>
    </p>
    
    <table class="table" style="margin: 0px auto;">
    	<tr>
    		<th> 
    			Kategória
    		</th>
    		<th></th>
    	</tr>
    	
    	<c:forEach items="${Categories}" var="item">
    		<tr>
    			<td>
    				${item.name}
    			</td>
    			<td>
    				<a href="/Webshop/manageCategories/deleteCategory?id=${item.id}">Törlés</a>
    			</td>
    		</tr>
    	</c:forEach>
    	
    </table>

 
</body>
</html>