<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@taglib uri="http://www.springframework.org/tags/form" prefix="form"%>
 
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
 
<title>Regisztráció</title>
 
<link rel="stylesheet" type="text/css" href="${pageContext.servletContext.contextPath}/resources/css/Site.css">
<link rel="stylesheet" type="text/css" href="${pageContext.servletContext.contextPath}/resources/css/bootstrap.css">
<script src="${pageContext.servletContext.contextPath}/resources/js/jquery-1.10.2.js"></script>
<script src="${pageContext.servletContext.contextPath}/resources/js/bootstrap.js"></script>
 
</head>
<body>
 
 
    <jsp:include page="_header.jsp" />
 
 
 
    <h2 class="text-center">Regisztráció</h2>
    
    <br/>
 
    <div class="login-container text-center">
 
        <span class="error-message">${error}</span>
        
        <br/>
        <br/>
 
        <form:form modelAttribute="registerForm" method="POST"
            action="${pageContext.request.contextPath}/register">
            <table style="margin: 0px auto;">
                <tr>
                    <td>Email </td>
                    <td><input name="email" /></td>
                </tr>
 
                <tr>
                    <td>Jelszó </td>
                    <td><input type="password" name="password" /></td>
                </tr>
                
                <tr>
                    <td>Jelszó megerosítése</td>
                    <td><input type="password" name="passwordConfirm" /></td>
                </tr>

            </table>

            <input type="submit" value="Regisztráció" class="btn btn-default text-center"/>
            
        </form:form>

        
 
    </div>
 
 
</body>
</html>