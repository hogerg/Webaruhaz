<%@taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@tag description="Layout template" pageEncoding="UTF-8"%>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<c:url value="/resources/css/Site.css" />" rel="stylesheet">
        <link href="<c:url value="/resources/css/bootstrap.css" />" rel="stylesheet">
        <script src="<c:url value="/resources/js/jquery-1.10.2.js" />"></script>
    	<script src="<c:url value="/resources/js/bootstrap.js" />"></script>
    </head>
  <body>
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
                        <li><a href="/Webshop/store">Termékek</a></li>
                        <li><a href="/Webshop/cart">Kosár</a></li>
                        <li><a href="/Webshop/about">Információ</a></li>
                        <li><a href="/Webshop/contact">Kapcsolat</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<c:url value='#' />">Regisztráció</a></li>
                        <li><a href="<c:url value='#' />">Bejelentkezés</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div id="body">
            <br/>
            <jsp:doBody/>
            <br/>
        </div>
        
    </container> 
        
  </body>
</html>