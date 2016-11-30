<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
 
<container>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/Webshop/productList">Termékek</a></li>
                        <li><a href="/Webshop/shoppingCart">Kosár</a></li>
                        <li><a href="/Webshop/about">Információ</a></li>
                        <li><a href="/Webshop/contact">Kapcsolat</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    	<c:if test="${pageContext.request.userPrincipal.name != null}">
				           <li>
				           	<a href="#">${pageContext.request.userPrincipal.name}</a>
				           </li>
				           <li><a href="${pageContext.request.contextPath}/logout">Kijelentkezés</a></li>
				 
				        </c:if>
				        <c:if test="${pageContext.request.userPrincipal.name == null}">
				        	<li><a href="${pageContext.request.contextPath}/register">Regisztráció</a></li>
				            <li><a href="${pageContext.request.contextPath}/login">Bejelentkezés</a></li>
				        </c:if>
                    </ul>
                </div>
            </div>
        </div> 
</container> 