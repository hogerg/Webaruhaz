<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@ taglib prefix="fmt" uri="http://java.sun.com/jsp/jstl/fmt" %>
<%@taglib uri="http://www.springframework.org/tags/form" prefix="form"%>
 
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
 
    <c:if test="${not empty errorMessage }">
      <div class="error-message">
          ${errorMessage}
      </div>
    </c:if>
 
    <form:form modelAttribute="productForm" method="POST" enctype="multipart/form-data">
        <table style="margin: 0px auto;">

            <tr>
                <td>Név </td>
                <td><form:input path="name" /></td>
                <td><form:errors path="name" class="error-message" /></td>
            </tr>
 
            <tr>
                <td>Ár </td>
                <td><form:input path="price" /></td>
                <td><form:errors path="price" class="error-message" /></td>
            </tr> 
            
            <tr>
                <td>Kategória </td>
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
        	<input type="submit" value="Létrehozás" class="btn btn-default"/> |
        	<a href="/Webshop/manageProducts">Vissza</a>
        </div>
    </form:form>
 
</body>
</html>