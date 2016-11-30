package hg.webshop.dao;

import hg.webshop.model.CartInfo;
 
public interface OrderDAO {
 
    public void saveOrder(CartInfo cartInfo);

}