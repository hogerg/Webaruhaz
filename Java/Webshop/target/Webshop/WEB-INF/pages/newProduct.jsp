<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@taglib uri="http://www.springframework.org/tags/form" prefix="form"%>

<head>
<meta charset="UTF-8">
<title>Term�k</title>
</head>

    <jsp:include page="_header.jsp" />
    
    <br/>
    
    <h2 class="text-center">Term�k ${not empty currentCategory ? 'm�dos�t�sa' : 'l�trehoz�sa' }</h2>
	<hr/>
 
    <c:if test="${not empty errorMessage }">
      <div class="error-message">
          ${errorMessage}
      </div>
    </c:if>
 
    <form:form modelAttribute="productForm" method="POST" enctype="multipart/form-data">
        <table style="margin: 0px auto;">

            <tr>
                <td>N�v </td>
                <td><form:input path="name" /></td>
                <td><form:errors path="name" class="error-message" /></td>
            </tr>
 
            <tr>
                <td>�r </td>
                <td><form:input path="price" /></td>
                <td><form:errors path="price" class="error-message" /></td>
            </tr> 
            
            <tr>
                <td>Kateg�ria </td>
                <td>
                	<select id="categoryId" name="categoryId">
                		<c:forEach items="${Categories}" var="item">
                			<option value="${item.id}" ${not empty currentCategory && currentCategory == item.id ? 'selected' : ''}>
                				${item.name}
                			</option>
                		</c:forEach>
                	</select>
                </td>
            </tr> 

        </table>
        <div class="text-center">
        	<input type="submit" value="Ment�s" class="btn btn-default"/> |
        	<a href="/Webshop/manageProducts">Vissza</a>
        </div>
    </form:form>
 
    <jsp:include page="_footer.jsp" />