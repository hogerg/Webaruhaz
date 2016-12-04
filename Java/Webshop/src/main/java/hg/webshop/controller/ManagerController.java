package hg.webshop.controller;

import java.awt.Graphics;
import java.awt.image.BufferedImage;
import java.io.ByteArrayInputStream;
import java.io.File;
import java.util.HashMap;
import java.util.List;
import java.util.UUID;

import javax.imageio.ImageIO;
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
import org.springframework.web.multipart.MultipartFile;
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
    public String newCategorySave(HttpServletRequest request, Model model, 
    		@RequestParam("fileToUpload") MultipartFile file,//
            @ModelAttribute("categoryForm") @Validated CategoryInfo categoryInfo, //
            BindingResult result, //
            final RedirectAttributes redirectAttributes) {

    	if (result.hasErrors()) {
            return "newCategory";
        }
        try {
        	if(!file.isEmpty()){
        		String contentType = file.getContentType();
        		if(!contentType.split("/")[0].equals("image")){
        			throw new Exception("Nem képfájl!");
        		}
        		
        		String filename = UUID.randomUUID().toString();
        		String realPath = request.getServletContext().getRealPath("/");
        		String path = realPath + "/resources/img/categories/" + filename + ".jpg";
        		BufferedImage src = ImageIO.read(new ByteArrayInputStream(file.getBytes()));
        		BufferedImage blank = ImageIO.read(new File(realPath + "/resources/img/categories/", "blank.jpg"));
        		
        		float maxDim = 600;
        		float src_w = src.getWidth();
        		float src_h = src.getHeight();
        		float ratio = src_w / src_h;
        		
        		if(src_w > maxDim || src_h > maxDim){
        			if(ratio > 1){
        				src_w = maxDim;
        				src_h = maxDim / ratio;
        			}
        			else{
        				src_w = maxDim * ratio;
        				src_h = maxDim;
        			}
        		}
        		
        		int hoffset = (int) ((600 - src_w)/2);
        		int voffset = (int) ((600 - src_h)/2);
        		
        		int imageType = BufferedImage.TYPE_INT_RGB;
                BufferedImage scaledSrc = new BufferedImage((int)src_w, (int)src_h, imageType);
                Graphics g = scaledSrc.createGraphics();
                g.drawImage(src, 0, 0, (int)src_w, (int)src_h, null); 
                g.dispose();
        		
        		BufferedImage combined = new BufferedImage(600, 600, BufferedImage.TYPE_INT_RGB);
        		Graphics cg = combined.getGraphics();
        		cg.drawImage(blank, 0, 0, null);
        		cg.drawImage(src, hoffset, voffset, null);

        		File destination = new File(path);
        		ImageIO.write(combined, "jpg", destination);
        		
        		categoryInfo.setPicName(filename);
        	}
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
        	List<CategoryInfo> categories = categoryDAO.queryCategories();
        	model.addAttribute("Categories", categories);
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
