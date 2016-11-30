package hg.webshop.dao;

import java.util.List;

import hg.webshop.entity.Product;
import hg.webshop.model.CartInfo;
import hg.webshop.model.CategoryInfo;
import hg.webshop.model.ProductInfo;
 
public interface ProductDAO {
 
    
    
    public Product findProduct(int id);
    
    public ProductInfo findProductInfo(int id) ;

    public List<ProductInfo> queryProducts();
	
	public List<ProductInfo> queryProducts(String likeName);
	
	public List<ProductInfo> queryProducts(int categoryId);
 
    public void save(ProductInfo productInfo);
    
    public void delete(ProductInfo productInfo, CartInfo cartInfo);
    
    public void categoryDeleted(int categoryId, CartInfo cartInfo);
    
}