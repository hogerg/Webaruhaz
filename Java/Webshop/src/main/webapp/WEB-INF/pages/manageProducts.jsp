<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@ taglib prefix="fmt" uri="http://java.sun.com/jsp/jstl/fmt" %>

<head>
<meta charset="UTF-8">
<title>Termékek kezelése</title>
</head>

    <jsp:include page="_header.jsp" />
    
    <br/>
    
    <h2>Terméklista</h2>
    
    <p>
    	<a href="/Webshop/manageProducts/newProduct">Termék létrehozása</a> | <a href="/Webshop/manageCategories">Kategóriák kezelése</a>
    </p>
    
    <table class="table" style="margin: 0px auto;">
    	<tr>
    		<th> 
    			Kategória
    		</th>
    		<th> 
    			Termék neve
    		</th>
    		<th> 
    			Ár
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
    				<a href="/Webshop/manageProducts/newProduct?id=${item.id}">Módosítás</a> | 
    				<a href="/Webshop/details?id=${item.id}">Részletek</a> | 
    				<a href="/Webshop/manageProducts/deleteProduct?id=${item.id}">Törlés</a>
    			</td>
    		</tr>
    	</c:forEach>
    	
    </table>

    <jsp:include page="_footer.jsp" />