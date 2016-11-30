<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@taglib uri="http://www.springframework.org/tags/form" prefix="form"%>
<%@ taglib prefix="spring" uri="http://www.springframework.org/tags"%>
 
 
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
 
<title>Megrendel�si adatok</title>
 
<link rel="stylesheet" type="text/css" href="${pageContext.servletContext.contextPath}/resources/css/Site.css">
<link rel="stylesheet" type="text/css" href="${pageContext.servletContext.contextPath}/resources/css/bootstrap.css">
<script src="${pageContext.servletContext.contextPath}/resources/js/jquery-1.10.2.js"></script>
<script src="${pageContext.servletContext.contextPath}/resources/js/bootstrap.js"></script>
 
</head>
<body>
	<jsp:include page="_header.jsp" />
	 
	<br/> 
	 
	<h2 class="text-center">Megrendel�s</h2>
	
	<br/>
 	
 	<div class="text-center">
	    <form:form method="POST" modelAttribute="customerForm"
	        action="${pageContext.request.contextPath}/shoppingCartCustomer">
	 
	        <table style="margin: 0px auto;">
	            <tr>
	                <td>N�v </td>
	                <td><form:input path="name" /></td>
	                <td><form:errors path="name" class="error-message" /></td>
	            </tr>
	            
	            <tr>
	                <td>C�m </td>
	                <td><form:input path="address"/></td>
	                <td><form:errors path="address" class="error-message" /></td>
	            </tr>
	 
	            <tr>
	                <td>Telefonsz�m</td>
	                <td><form:input path="phone" /></td>
	                <td><form:errors path="phone" class="error-message" /></td>
	            </tr>
	 
	            <tr>
	                <td>Email </td>
	                <td><form:input path="email" value="${email}" /></td>
	                <td><form:errors path="email" class="error-message" /></td>
	            </tr>
	
	        </table>
	        <div class="row text-center">
	            <input type="checkbox" name="accept"/> Elfogadom az �ltal�nos felhaszn�l�i felt�teleket
	        </div>
	 		<input type="submit" value="Rendel�s felad�sa" class="btn btn-default text-center"/>
	    </form:form>
 	</div>
 
 
</body>
</html>