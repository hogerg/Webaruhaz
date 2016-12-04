<%@taglib uri="http://www.springframework.org/tags/form" prefix="form"%>

<head>
<meta charset="UTF-8">
<title>Regisztr�ci�</title>
</head>
 
    <jsp:include page="_header.jsp" />
 
    <h2 class="text-center">Regisztr�ci�</h2>
    
    <br/>
 
    <div class="text-center">
 
        <span class="error-message">${error}</span>
        
        <br/>
        <br/>
 
        <form:form modelAttribute="registerForm" method="POST"
            action="/Webshop/register">
            <table style="margin: 0px auto;">
                <tr>
                    <td>Email </td>
                    <td><input name="email" value="${email }" /></td>
                </tr>
 
                <tr>
                    <td>Jelsz� </td>
                    <td><input type="password" name="password" /></td>
                </tr>
                
                <tr>
                    <td>Jelsz� megeros�t�se</td>
                    <td><input type="password" name="passwordConfirm" /></td>
                </tr>

            </table>

            <input type="submit" value="Regisztr�ci�" class="btn btn-default text-center"/>
            
        </form:form>

        
 
    </div>
 
    <jsp:include page="_footer.jsp" />