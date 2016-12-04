<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>

<head>
<meta charset="UTF-8">
<title>Kateg�ri�k kezel�se</title>
</head>
<body>
	
    <jsp:include page="_header.jsp" />
    
    <br/>
    
    <h2>Kateg�ri�k</h2>
    
    <p>
    	<a href="/Webshop/manageCategories/newCategory">Kateg�ria l�trehoz�sa</a> | <a href="/Webshop/manageProducts">Vissza</a>
    </p>
    
    <table class="table" style="margin: 0px auto;">
    	<tr>
    		<th> 
    			Kateg�ria
    		</th>
    		<th></th>
    	</tr>
    	
    	<c:forEach items="${Categories}" var="item">
    		<tr>
    			<td>
    				${item.name}
    			</td>
    			<td>
    				<a href="/Webshop/manageCategories/deleteCategory?id=${item.id}">T�rl�s</a>
    			</td>
    		</tr>
    	</c:forEach>
    	
    </table>

    <jsp:include page="_footer.jsp" />