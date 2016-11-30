package hg.webshop.dao;

import hg.webshop.entity.Customer;
import hg.webshop.model.AccountInfo;

public interface CustomerDAO {
 
    public Customer findAccount(String email );
    
    public void save(AccountInfo accountInfo);
    
}