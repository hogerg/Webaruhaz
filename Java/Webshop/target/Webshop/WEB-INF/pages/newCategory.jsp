<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@taglib uri="http://www.springframework.org/tags/form" prefix="form"%>

<head>
<meta charset="UTF-8">
<title>Kategória</title>
</head>

    <jsp:include page="_header.jsp" />
    
    <br/>

	<h2 class="text-center">Kategória létrehozása</h2>
	<hr/>

    <c:if test="${not empty errorMessage }">
      <div class="error-message">
          ${errorMessage}
      </div>
    </c:if>
 
    <form:form modelAttribute="categoryForm" method="POST" enctype="multipart/form-data">
        <table style="margin: 0px auto;"> 
            <tr>
                <td>Név </td>
                <td><form:input path="name" /></td>
                <td><form:errors path="name" class="error-message" /></td>
            </tr>
            <tr>
            	<td>Képfeltöltés </td>
            	<td><input type="file" name="fileToUpload" id="fileToUpload" size="50" /></td>
            </tr>
        </table>
        <div class="text-center">
        	<input type="submit" value="Mentés" class="btn btn-default"/> |
        	<a href="/Webshop/manageCategories">Vissza</a>
        </div>
    </form:form>
 
    <jsp:include page="_footer.jsp" />