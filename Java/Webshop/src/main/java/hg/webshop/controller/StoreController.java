package hg.webshop.controller;

import java.util.HashMap;
import java.util.List;
import java.util.Properties;

import javax.mail.Message;
import javax.mail.MessagingException;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.MimeMessage;
import javax.servlet.http.HttpServletRequest;
import hg.webshop.dao.CategoryDAO;
import hg.webshop.dao.OrderDAO;
import hg.webshop.dao.ProductDAO;
import hg.webshop.entity.Order;
import hg.webshop.entity.Product;
import hg.webshop.model.CartInfo;
import hg.webshop.model.CartLineInfo;
import hg.webshop.model.CategoryInfo;
import hg.webshop.model.CustomerInfo;
import hg.webshop.model.ProductInfo;
import hg.webshop.util.Utils;
import hg.webshop.validator.CustomerInfoValidator;

import org.hibernate.SessionFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.transaction.annotation.Transactional;
import org.springframework.ui.Model;
import org.springframework.validation.BindingResult;
import org.springframework.validation.annotation.Validated;
import org.springframework.web.bind.WebDataBinder;
import org.springframework.web.bind.annotation.InitBinder;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.config.annotation.EnableWebMvc;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;
 
@Controller
@Transactional
@EnableWebMvc
public class StoreController {
 
    @Autowired
    private OrderDAO orderDAO;
 
    @Autowired
    private ProductDAO productDAO;
    
    @Autowired
    private CategoryDAO categoryDAO;
 
    @Autowired
    private CustomerInfoValidator customerInfoValidator;
 
    @InitBinder
    public void myInitBinder(WebDataBinder dataBinder) {
        Object target = dataBinder.getTarget();
        if (target == null) {
            return;
        }
        System.out.println("Target=" + target);

        if (target.getClass() == CartInfo.class) {
 
        }

        else if (target.getClass() == CustomerInfo.class) {
            dataBinder.setValidator(customerInfoValidator);
        }
 
    }
    
    @RequestMapping({ "/productList" })
    public String listProductHandler(Model model, //
            @RequestParam(value = "keyword", defaultValue = "") String likeName,
            @RequestParam(value = "category", required = false) String category) {

    	List<ProductInfo> result;
    	
    	if(category != null){
    		result = productDAO.queryProducts(Integer.valueOf(category));
    	}
    	else{
    		result = productDAO.queryProducts(likeName);
    	}
        
        List<CategoryInfo> categories = categoryDAO.queryCategories();
        
        
        HashMap<Integer, String> productImages = new HashMap<Integer,String>();
    	
    	for(ProductInfo pi: result){

    		String image = categoryDAO.findCategory(pi.getCategoryId()).getPicName();

    		productImages.put(pi.getId(), image);

    	}
 
        model.addAttribute("Products", result);
        model.addAttribute("Categories", categories);
        model.addAttribute("ProductImages", productImages);
        return "productList";
    }
    
    
    /////
    @RequestMapping(value = { "/details" }, method = RequestMethod.GET)
    public String details(Model model, @RequestParam(value = "id") int id) {
        ProductInfo productInfo = null;
        CategoryInfo categoryInfo = null;
 
        if (id >= 0) {
            productInfo = productDAO.findProductInfo(id);
            
            categoryInfo = categoryDAO.findCategoryInfo(productInfo.getCategoryId());
        }
        if (productInfo == null) {
            return "productList";
        }
        model.addAttribute("product", productInfo);
        model.addAttribute("category", categoryInfo);
        return "details";
    }
 
    @RequestMapping({ "/buyProduct" })
    public String listProductHandler(HttpServletRequest request, Model model, //
            @RequestParam(value = "id") int id) {
 
        Product product = null;
        if (id >= 0) {
            product = productDAO.findProduct(id);
        }
        if (product != null) {
 
            CartInfo cartInfo = Utils.getCartInSession(request);
 
            ProductInfo productInfo = new ProductInfo(product);
 
            cartInfo.addProduct(productInfo, 1);
            
            Integer cartAmount = (Integer)request.getSession().getAttribute("cartAmount");
            if(cartAmount == null){
            	request.getSession().setAttribute("cartAmount", 1);
            }
            else {
            	request.getSession().setAttribute("cartAmount", ++cartAmount);
            }
            
        }
        return "redirect:/productList";
    }
 
    @RequestMapping({ "/shoppingCartRemoveProduct" })
    public String removeProductHandler(HttpServletRequest request, Model model, //
            @RequestParam(value = "id") int id) {
        Product product = null;
        if (id >= 0) {
            product = productDAO.findProduct(id);
        }
        if (product != null) {
 
            CartInfo cartInfo = Utils.getCartInSession(request);
 
            ProductInfo productInfo = new ProductInfo(product);
 
            cartInfo.removeProduct(productInfo);
            
            Integer cartAmount = (Integer)request.getSession().getAttribute("cartAmount");
            request.getSession().setAttribute("cartAmount", --cartAmount);
 
        }
        return "redirect:/shoppingCart";
    }
 
    @RequestMapping(value = { "/shoppingCart" }, method = RequestMethod.POST)
    public String shoppingCartUpdateQty(HttpServletRequest request, //
            Model model, //
            @ModelAttribute("cartForm") CartInfo cartForm) {
 
        CartInfo cartInfo = Utils.getCartInSession(request);
        cartInfo.updateQuantity(cartForm);
 
        return "redirect:/shoppingCart";
    }
 
    @RequestMapping(value = { "/shoppingCart" }, method = RequestMethod.GET)
    public String shoppingCartHandler(HttpServletRequest request, Model model) {
        CartInfo myCart = Utils.getCartInSession(request);
 
        HashMap<Integer, String> productImages = new HashMap<Integer,String>();
        
        for(CartLineInfo cli: myCart.getCartLines()){
        	ProductInfo pi = cli.getProductInfo();
        	String image = categoryDAO.findCategory(pi.getCategoryId()).getPicName();

    		productImages.put(pi.getId(), image);
        }
        
        model.addAttribute("cartForm", myCart);
        model.addAttribute("totalAmount", myCart.getAmountTotal());
        model.addAttribute("quantityTotal", myCart.getQuantityTotal());
        model.addAttribute("ProductImages", productImages);
        return "shoppingCart";
    }
 
    @RequestMapping(value = { "/shoppingCartCustomer" }, method = RequestMethod.GET)
    public String shoppingCartCustomerForm(HttpServletRequest request, Model model) {
 
        CartInfo cartInfo = Utils.getCartInSession(request);
      
        if (cartInfo.isEmpty()) {
             
            return "redirect:/shoppingCart";
        }
 
        CustomerInfo customerInfo = cartInfo.getCustomerInfo();
        if (customerInfo == null) {
            customerInfo = new CustomerInfo();
        }
        
        Order order = orderDAO.findOrderByEmail(request.getUserPrincipal().getName());
        
        if(order != null)
        {
        	customerInfo.setEmail(order.getCustomerEmail());
        	customerInfo.setAddress(order.getCustomerAddress());
        	customerInfo.setName(order.getCustomerName());
        	customerInfo.setPhone(order.getCustomerPhone());
        }
 
        model.addAttribute("customerForm", customerInfo);
        model.addAttribute("email", customerInfo.getEmail());
        
        System.out.println(customerInfo.getEmail());
 
        return "shoppingCartCustomer";
    }
 
    @RequestMapping(value = { "/shoppingCartCustomer" }, method = RequestMethod.POST)
    public String shoppingCartCustomerSave(HttpServletRequest request, //
            Model model, //
            @ModelAttribute("customerForm") @Validated CustomerInfo customerForm, //
            BindingResult result, //
            final RedirectAttributes redirectAttributes) {
  
        if (result.hasErrors() || request.getParameter("accept") == null) {
            customerForm.setValid(false);
            return "shoppingCartCustomer";
        }
 
        customerForm.setValid(true);
        CartInfo cartInfo = Utils.getCartInSession(request);
 
        cartInfo.setCustomerInfo(customerForm);
 
        if(cartInfo.isEmpty()){
        	return "redirect:/shoppingCart";
        }
        
        try {
            orderDAO.saveOrder(cartInfo);
            sendPurchaseEmail(customerForm.getEmail(), customerForm.getName(), cartInfo.getOrderNum());
        } catch (Exception e) {
            return "shoppingCartCustomer";
        }

        Utils.removeCartInSession(request);
        request.getSession().setAttribute("cartAmount", 0);
        Utils.storeLastOrderedCartInSession(request, cartInfo);

        return "redirect:/shoppingCartFinalize";
    }
 
    @RequestMapping(value = { "/shoppingCartFinalize" }, method = RequestMethod.GET)
    public String shoppingCartFinalize(HttpServletRequest request, Model model) {
 
        CartInfo lastOrderedCart = Utils.getLastOrderedCartInSession(request);
 
        if (lastOrderedCart == null) {
            return "redirect:/shoppingCart";
        }
 
        return "shoppingCartFinalize";
    }
 
    private void sendPurchaseEmail(String recipient, String name, int orderNum){
    	Properties props = new Properties();
        props.put("mail.smtp.host", "smtp.gmail.com");
        props.put("mail.smtp.port", 587);
        props.put("mail.smtp.starttls.enable", "true");
        Session session = Session.getInstance(props, null);

        try {
            MimeMessage msg = new MimeMessage(session);
            msg.setFrom("hogergwebshop@google.com");
            msg.setRecipients(Message.RecipientType.TO, recipient);
            msg.setSubject("Webshop vásárlás");
            msg.setText("Kedves " + name + "!\n\nKöszönjük, hogy vásárolt a webáruházunkban!\n\nRendelésének azonosítója: " + orderNum);
            Transport.send(msg, "hogergwebshop@gmail.com", "szakdolgozat");
        } catch (MessagingException mex) {
            System.out.println("send failed, exception: " + mex);
        }
    }
     
}