<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<%@taglib uri="http://www.springframework.org/tags/form" prefix="form"%>
<%@ taglib prefix="fmt" uri="http://java.sun.com/jsp/jstl/fmt" %>

<head>
<meta charset="UTF-8">
<title>Kosár</title>
</head>

    <jsp:include page="_header.jsp" />

	<div class="row">
	    <div class="col-md-4 text-center">
	        <h3 style="white-space:nowrap">Fizetendo: 
	            <span id="cart-total">
	                <fmt:formatNumber type="number" 
            			maxFractionDigits="0" value="${totalAmount}" /> Ft.-
	            </span>
	        </h3>
	        <hr/>
	        <span>
	        	<a class="btn btn-primary" href="${pageContext.request.contextPath}/shoppingCartCustomer">Tovább a fizetésre</a>
	        </span>
	        <hr />
	        <div id="update-message"></div>
	    </div>
	    <div class="col-md-8">
	        <!-- Kosár tartalma -->
	        <c:if test="${not empty cartForm and not empty cartForm.cartLines   }">
		 
		            <c:forEach items="${cartForm.cartLines}" var="cartLineInfo"
		                varStatus="varStatus">
		                <div class="col-md-4 thumbnail">
		                	<img class="img-responsive" 
			            		src="${pageContext.servletContext.contextPath}/resources/img/categories/${ProductImages.get(cartLineInfo.productInfo.id)}.jpg" 
			            		alt="">
		                	<div class="caption text-center" style="white-space: nowrap">
		                		<h5>
		                			${cartLineInfo.productInfo.name}
		                		</h5>
		                		<h5>
		                			Termékkód: ${cartLineInfo.productInfo.id}
		                		</h5>
		                		<h5>
		                			Ár: 
		                			<fmt:formatNumber type="number" 
            							maxFractionDigits="0" value="${cartLineInfo.productInfo.price}" /> Ft.-
		                		</h5>
		                		<div>
		                			Darabszám: 
		                			${cartLineInfo.quantity }
		                		</div>
		                		<br/>
		                		<div>
		                			Alösszeg:
		                			<fmt:formatNumber type="number" 
            							maxFractionDigits="0" value="${cartLineInfo.amount}" /> Ft.-
		                		</div>
		                		<br/>
		                		<a href="${pageContext.request.contextPath}/shoppingCartRemoveProduct?id=${cartLineInfo.productInfo.id}">
		                        	Eltávolítás 
		                        </a>
		                	</div>
   
		                </div>
		            </c:forEach>
		        
		    </c:if>
	    </div>
	</div>
 
    <jsp:include page="_footer.jsp" />