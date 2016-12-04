<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>

<head>
<meta charset="UTF-8">
<title>Bejelentkez�s</title>
</head>

    <jsp:include page="_header.jsp" />
 
 
 
    <h2 class="text-center">Bejelentkez�s</h2>
    
    <br/>
 
    <div class="text-center">
 
        <!-- /login?error=true -->
        <c:if test="${param.error == 'true'}">
            <div style="color: red; margin: 10px 0px;">
                Sikertelen bejelentkez�s!<br /> <br/>
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
                    <td>Jelsz� </td>
                    <td><input type="password" name="password" /></td>
                </tr>

            </table>

            <input type="submit" value="Bejelentkez�s" class="btn btn-default text-center"/> |
            <a href="/Webshop/register">�j fi�k l�trehoz�sa</a>
            
        </form>

        <span class="error-message">${error }</span>
 
    </div>

    <jsp:include page="_footer.jsp" />