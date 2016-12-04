<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>

<head>
<meta charset="UTF-8">
<title>Kategóriák kezelése</title>
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

    <jsp:include page="_footer.jsp" />