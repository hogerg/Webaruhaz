<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@ taglib prefix="fmt" uri="http://java.sun.com/jsp/jstl/fmt" %>

<head>
<meta charset="UTF-8">
<title>Term�kek kezel�se</title>
</head>

    <jsp:include page="_header.jsp" />
    
    <br/>
    
    <h2>Term�klista</h2>
    
    <p>
    	<a href="/Webshop/manageProducts/newProduct">Term�k l�trehoz�sa</a> | <a href="/Webshop/manageCategories">Kateg�ri�k kezel�se</a>
    </p>
    
    <table class="table" style="margin: 0px auto;">
    	<tr>
    		<th> 
    			Kateg�ria
    		</th>
    		<th> 
    			Term�k neve
    		</th>
    		<th> 
    			�r
    		</th>
    		<th></th>
    	</tr>
    	
    	<c:forEach items="${Products}" var="item">
    		<tr>
    			<td>
    				${productCategories.get(item.id) }
    			</td>
    			<td>
    				${item.name}
    			</td>
    			<td>
    				<fmt:formatNumber type="number" maxFractionDigits="0" value="${item.price}" /> Ft.-
    			</td>
    			<td>
    				<a href="/Webshop/manageProducts/newProduct?id=${item.id}">M�dos�t�s</a> | 
    				<a href="/Webshop/details?id=${item.id}">R�szletek</a> | 
    				<a href="/Webshop/manageProducts/deleteProduct?id=${item.id}">T�rl�s</a>
    			</td>
    		</tr>
    	</c:forEach>
    	
    </table>

    <jsp:include page="_footer.jsp" />