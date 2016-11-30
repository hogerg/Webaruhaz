package hg.webshop.controller;

import java.util.HashMap;
import java.util.List;

import javax.servlet.http.HttpServletRequest;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.transaction.annotation.Propagation;
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
import org.springframework.web.multipart.support.ByteArrayMultipartFileEditor;
import org.springframework.web.servlet.config.annotation.EnableWebMvc;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;

import hg.webshop.dao.CategoryDAO;
import hg.webshop.dao.ProductDAO;
import hg.webshop.model.CartInfo;
import hg.webshop.model.CategoryInfo;
import hg.webshop.model.ProductInfo;
import hg.webshop.util.Utils;
import hg.webshop.validator.CategoryInfoValidator;
import hg.webshop.validator.ProductInfoValidator;

@Controller
@Transactional
@EnableWebMvc
public class ManagerController {

    @Autowired
    private ProductDAO productDAO;
    
    @Autowired
    private CategoryDAO categoryDAO;
    
    @Autowired
    private CategoryInfoValidator categoryInfoValidator;
    
    @Autowired
    private ProductInfoValidator productInfoValidator;
    
    @InitBinder
    public void myInitBinder(WebDataBinder dataBinder) {
        Object target = dataBinder.getTarget();
        if (target == null) {
            return;
        }
        System.out.println("Target=" + target);

        if (target.getClass() == CategoryInfo.class) {
            dataBinder.setValidator(categoryInfoValidator);
        }
        
        else if (target.getClass() == ProductInfo.class) {
            dataBinder.setValidator(productInfoValidator);
            // For upload Image.
            dataBinder.registerCustomEditor(byte[].class, new ByteArrayMultipartFileEditor());
        }
 
    }
    
    @RequestMapping("/manageProducts")
    public String manageProductsHandler(Model model) {

    	List<ProductInfo> products = productDAO.queryProducts();
    	
    	HashMap<Integer, String> productCategories = new HashMap<Integer,String>();
    	
    	for(ProductInfo pi: products){

    		String category = categoryDAO.findCategory(pi.getCategoryId()).getName();

    		productCategories.put(pi.getId(), category);

    	}
    	
    	model.addAttribute("Products", products);
    	model.addAttribute("productCategories", productCategories);
    	
        return "manageProducts";
    }
    
    @RequestMapping("/manageCategories")
    public String manageCategoriesHandler(Model model) {

    	List<CategoryInfo> categories = categoryDAO.queryCategories();

    	model.addAttribute("Categories", categories);
    	
        return "manageCategories";
    }
    
    @RequestMapping(value = { "/manageCategories/newCategory" }, method = RequestMethod.GET)
    public String newCategory(Model model) {
    	
    	model.addAttribute("categoryForm", new CategoryInfo());
    	
        return "newCategory";
    }
    
    @RequestMapping(value = { "/manageCategories/newCategory" }, method = RequestMethod.POST)
    public String newCategorySave(Model model, //
            @ModelAttribute("categoryForm") @Validated CategoryInfo categoryInfo, //
            BindingResult result, //
            final RedirectAttributes redirectAttributes) {

    	if (result.hasErrors()) {
            return "newCategory";
        }
        try {
        	categoryInfo.setPicName("mock_tetris");
            categoryDAO.save(categoryInfo);
        } catch (Exception e) {
            String message = e.getMessage();
            model.addAttribute("message", message);
            return "newCategory";
 
        }
        return "redirect:/manageCategories";
    }
    
    @RequestMapping("/manageCategories/deleteCategory")
    public String deleteCategory(HttpServletRequest request, Model model,
            @RequestParam(value = "id", required = true) int id) {

        try {
            CategoryInfo categoryInfo = categoryDAO.findCategoryInfo(id);
            if( categoryInfo == null) throw new Exception("Nem található a törölni kívánt kategória");
            
            CartInfo cartInfo = Utils.getCartInSession(request);
            
            productDAO.categoryDeleted(categoryInfo.getId(), cartInfo);
            categoryDAO.delete(categoryInfo);
        } catch (Exception e) {
            String message = e.getMessage();
            model.addAttribute("message", message);
            return "newCategory";
 
        }
        return "redirect:/manageCategories";
    }
    
    @RequestMapping(value = { "/manageProducts/newProduct" }, method = RequestMethod.GET)
    public String newProduct(Model model, @RequestParam(value = "id", required = false) Integer id) {
        ProductInfo productInfo = null;
 
        if (id != null && id >= 0) {
            productInfo = productDAO.findProductInfo(id);
            
            int category = categoryDAO.findCategory(productInfo.getCategoryId()).getID();

    		model.addAttribute("currentCategory", category);
        }
        if (productInfo == null) {
            productInfo = new ProductInfo();
            productInfo.setNewProduct(true);
        }
        
        List<CategoryInfo> categories = categoryDAO.queryCategories();

    	model.addAttribute("Categories", categories);
        
        model.addAttribute("productForm", productInfo);
        return "newProduct";
    }
 
    @RequestMapping(value = { "/manageProducts/newProduct" }, method = RequestMethod.POST)
    @Transactional(propagation = Propagation.NEVER)
    public String newProductSave(Model model, //
            @ModelAttribute("productForm") @Validated ProductInfo productInfo, //
            BindingResult result, //
            final RedirectAttributes redirectAttributes) {
 
        if (result.hasErrors()) {
            return "newProduct";
        }
        try {
            productDAO.save(productInfo);
        } catch (Exception e) {
            String message = e.getMessage();
            model.addAttribute("message", message);
            return "newProduct";
 
        }
        return "redirect:/manageProducts";
    }
    
    @RequestMapping("/manageProducts/deleteProduct")
    public String deleteProduct(HttpServletRequest request, Model model,
            @RequestParam(value = "id", required = true) int id) {

        try {
            ProductInfo productInfo = productDAO.findProductInfo(id);
            if( productInfo == null) throw new Exception("Nem található a törölni kívánt termék");
            
            CartInfo cartInfo = Utils.getCartInSession(request);
            
            productDAO.delete(productInfo, cartInfo);
        } catch (Exception e) {
            String message = e.getMessage();
            model.addAttribute("message", message);
            return "newProduct";
 
        }
        return "redirect:/manageProducts";
    }
}
