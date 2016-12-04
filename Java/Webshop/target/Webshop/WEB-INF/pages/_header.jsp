<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@taglib uri="http://www.springframework.org/tags/form" prefix="form"%>
<%@ taglib prefix="fmt" uri="http://java.sun.com/jsp/jstl/fmt" %>
<%@ taglib uri="http://www.springframework.org/security/tags" prefix="security" %>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="${pageContext.servletContext.contextPath}/resources/css/Site.css">
	<link rel="stylesheet" type="text/css" href="${pageContext.servletContext.contextPath}/resources/css/bootstrap.css">
	<script src="${pageContext.servletContext.contextPath}/resources/js/jquery-1.10.2.js"></script>
	<script src="${pageContext.servletContext.contextPath}/resources/js/bootstrap.js"></script>
 </head>
 
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
                        <li>
                        	<a href="/Webshop/shoppingCart">
                        		Kosár (<%= session.getAttribute("cartAmount")==null ? 0 : session.getAttribute("cartAmount") %>)
                        	</a>
                        </li>
                        <li><a href="/Webshop/about">Információ</a></li>
                        <li><a href="/Webshop/contact">Kapcsolat</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    	<c:if test="${pageContext.request.userPrincipal.name != null}">
                    		<security:authorize access="hasRole('MANAGER')">
                    			<li><a href="/Webshop/manageProducts">Készlet</a></li>
							</security:authorize>
				            <li><a href="#">${pageContext.request.userPrincipal.name}</a></li>
				            <li><a href="/Webshop/logout">Kijelentkezés</a></li>
				 
				        </c:if>
				        <c:if test="${pageContext.request.userPrincipal.name == null}">
				        	<li><a href="/Webshop/register">Regisztráció</a></li>
				            <li><a href="/Webshop/login">Bejelentkezés</a></li>
				        </c:if>
                    </ul>
                </div>
            </div>
        </div> 
</container> 

<body>
	<div class="col-md-10 col-md-offset-1">