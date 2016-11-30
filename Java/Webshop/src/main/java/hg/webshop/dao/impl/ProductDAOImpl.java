package hg.webshop.dao.impl;

import java.util.List;

import org.hibernate.Criteria;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.criterion.Restrictions;
import hg.webshop.dao.ProductDAO;
import hg.webshop.entity.Product;
import hg.webshop.model.CartInfo;
import hg.webshop.model.ProductInfo;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.transaction.annotation.Transactional;
 
@Transactional
public class ProductDAOImpl implements ProductDAO {
 
    @Autowired
    private SessionFactory sessionFactory;
 
    @Override
    public Product findProduct(int id) {
        Session session = sessionFactory.getCurrentSession();
        Criteria crit = session.createCriteria(Product.class);
        crit.add(Restrictions.eq("id", id));
        return (Product) crit.uniqueResult();
    }
 
    @Override
    public ProductInfo findProductInfo(int id) {
        Product product = this.findProduct(id);
        if (product == null) {
            return null;
        }
        return new ProductInfo(product.getID(), product.getName(), product.getPrice(), product.getCategoryId());
    }
 
    @Override
    public void save(ProductInfo productInfo) {
        int id = productInfo.getId();
 
        Product product = null;
 
        boolean isNew = false;
        if (id >= 0 ) {
            product = this.findProduct(id);
        }
        if (product == null) {
            isNew = true;
            product = new Product();
        }
        product.setID(id);
        product.setName(productInfo.getName());
        product.setPrice(productInfo.getPrice());
        product.setCategoryId(productInfo.getCategoryId());
 
        if (isNew) {
            this.sessionFactory.getCurrentSession().persist(product);
        }

        this.sessionFactory.getCurrentSession().flush();
    }
    
    @Override
    public void delete(ProductInfo productInfo, CartInfo cartInfo){
    	int id = productInfo.getId();
		
		Product product = null;
		
		if (id >= 0 ) {
            product = this.findProduct(id);
            
            cartInfo.removeProduct(productInfo);
            
            this.sessionFactory.getCurrentSession().delete(product);
            
            this.sessionFactory.getCurrentSession().flush();
        }
    }
    
    @Override
    public List<ProductInfo> queryProducts(String likeName) {
        String sql = "Select new " + ProductInfo.class.getName() //
                + "(p.id, p.name, p.price, p.categoryId) " + " from "//
                + Product.class.getName() + " p ";
        if (likeName != null && likeName.length() > 0) {
            sql += " Where lower(p.name) like :likeName ";
        }
        //
        Session session = sessionFactory.getCurrentSession();
 
        Query query = session.createQuery(sql);
        if (likeName != null && likeName.length() > 0) {
            query.setParameter("likeName", "%" + likeName.toLowerCase() + "%");
        }

        return query.list();
    }
    
    @Override
    public List<ProductInfo> queryProducts(int categoryId) {
        String sql = "Select new " + ProductInfo.class.getName() //
                + "(p.id, p.name, p.price, p.categoryId) " + " from "//
                + Product.class.getName() + " p ";

        sql += " Where p.categoryId = :categoryId ";

        Session session = sessionFactory.getCurrentSession();
 
        Query query = session.createQuery(sql);
        
        query.setParameter("categoryId", categoryId);

        return query.list();
    }
    
    @Override
    public List<ProductInfo> queryProducts() {
        return queryProducts(null);
    }
    
    @Override
    public void categoryDeleted(int categoryId, CartInfo cartInfo){
    	List<ProductInfo> products = queryProducts(categoryId);
    	for(ProductInfo pi: products){
    		delete(pi, cartInfo);
    	}
    }
    
}