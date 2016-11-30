<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
 
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
 
<title>Bejelentkezés</title>
 
<link rel="stylesheet" type="text/css" href="${pageContext.servletContext.contextPath}/resources/css/Site.css">
<link rel="stylesheet" type="text/css" href="${pageContext.servletContext.contextPath}/resources/css/bootstrap.css">
<script src="${pageContext.servletContext.contextPath}/resources/js/jquery-1.10.2.js"></script>
<script src="${pageContext.servletContext.contextPath}/resources/js/bootstrap.js"></script>
 
</head>
<body>
 
 
    <jsp:include page="_header.jsp" />
 
 
 
    <h2 class="text-center">Bejelentkezés</h2>
    
    <br/>
 
    <div class="login-container text-center">
 
        <!-- /login?error=true -->
        <c:if test="${param.error == 'true'}">
            <div style="color: red; margin: 10px 0px;">
                Sikertelen bejelentkezés!<br /> <br/>
            </div>
        </c:if>
 
        <form method="POST"
            action="${pageContext.request.contextPath}/j_spring_security_check">
            <table style="margin: 0px auto;">
                <tr>
                    <td>Email </td>
                    <td><input name="email" /></td>
                </tr>
 
                <tr>
                    <td>Jelszó </td>
                    <td><input type="password" name="password" /></td>
                </tr>

            </table>

            <input type="submit" value="Bejelentkezés" class="btn btn-default text-center"/> |
            <a href="/Webshop/register">Új fiók létrehozása</a>
            
        </form>

        <span class="error-message">${error }</span>
 
    </div>
 
 
</body>
</html>