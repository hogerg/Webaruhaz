<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@taglib uri="http://www.springframework.org/tags/form" prefix="form"%>

<head>
<meta charset="UTF-8">
<title>Kateg�ria</title>
</head>

    <jsp:include page="_header.jsp" />
    
    <br/>

	<h2 class="text-center">Kateg�ria l�trehoz�sa</h2>
	<hr/>

    <c:if test="${not empty errorMessage }">
      <div class="error-message">
          ${errorMessage}
      </div>
    </c:if>
 
    <form:form modelAttribute="categoryForm" method="POST" enctype="multipart/form-data">
        <table style="margin: 0px auto;"> 
            <tr>
                <td>N�v </td>
                <td><form:input path="name" /></td>
                <td><form:errors path="name" class="error-message" /></td>
            </tr>
            <tr>
            	<td>K�pfelt�lt�s </td>
            	<td><input type="file" name="fileToUpload" id="fileToUpload" size="50" /></td>
            </tr>
        </table>
        <div class="text-center">
        	<input type="submit" value="Ment�s" class="btn btn-default"/> |
        	<a href="/Webshop/manageCategories">Vissza</a>
        </div>
    </form:form>
 
    <jsp:include page="_footer.jsp" />