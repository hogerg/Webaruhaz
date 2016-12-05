package hg.webshop.dao;

import hg.webshop.entity.Order;
import hg.webshop.model.CartInfo;
 
public interface OrderDAO {
 
    public void saveOrder(CartInfo cartInfo);
    
    public Order findOrderByEmail(String email);

}