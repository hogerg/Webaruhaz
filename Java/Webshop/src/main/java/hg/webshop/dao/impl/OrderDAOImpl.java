package hg.webshop.dao.impl;

import java.util.Date;
import java.util.List;
import java.util.UUID;
 
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import hg.webshop.dao.OrderDAO;
import hg.webshop.dao.ProductDAO;
import hg.webshop.entity.Order;
import hg.webshop.entity.OrderDetail;
import hg.webshop.entity.Product;
import hg.webshop.model.CartInfo;
import hg.webshop.model.CartLineInfo;
import hg.webshop.model.CustomerInfo;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.transaction.annotation.Transactional;
 
@Transactional
public class OrderDAOImpl implements OrderDAO {
 
    @Autowired
    private SessionFactory sessionFactory;
 
    @Autowired
    private ProductDAO productDAO;
 
    private int getMaxOrderNum() {
    	String sql = "Select max(o.orderNum) from " + Order.class.getName() + " o ";
        Session session = sessionFactory.getCurrentSession();
        Query query = session.createQuery(sql);
        Integer value = (Integer) query.uniqueResult();
        if (value == null) {
            return 0;
        }
        return value;
    }
 
    @Override
    public void saveOrder(CartInfo cartInfo) {
        Session session = sessionFactory.getCurrentSession();
 
        int orderNum = this.getMaxOrderNum() + 1;
        
        Order order = new Order();
        
        String uid = UUID.randomUUID().toString().substring(0, 36);
 
        order.setId(uid);
        order.setOrderNum(orderNum);
        order.setOrderDate(new Date());
        order.setAmount(cartInfo.getAmountTotal());
 
        CustomerInfo customerInfo = cartInfo.getCustomerInfo();
        order.setCustomerName(customerInfo.getName());
        order.setCustomerEmail(customerInfo.getEmail());
        order.setCustomerPhone(customerInfo.getPhone());
        order.setCustomerAddress(customerInfo.getAddress());

        session.persist(order);
 
        List<CartLineInfo> lines = cartInfo.getCartLines();
 
        for (CartLineInfo line : lines) {
            OrderDetail detail = new OrderDetail();
            
            uid = UUID.randomUUID().toString().substring(0, 36);;
            
            detail.setId(uid);
            detail.setOrder(order);
            detail.setAmount(line.getAmount());
            detail.setPrice(line.getProductInfo().getPrice());
            detail.setQuantity(line.getQuantity());
            
            int id = line.getProductInfo().getId();
            Product product = this.productDAO.findProduct(id);
            detail.setProduct(product);
            
            session.persist(detail);
            
        }
 
        cartInfo.setOrderNum(orderNum);

    }
 
}