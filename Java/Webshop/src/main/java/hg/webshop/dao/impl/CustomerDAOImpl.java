package hg.webshop.dao.impl;

import org.hibernate.Criteria;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.criterion.Restrictions;
import hg.webshop.dao.CustomerDAO;
import hg.webshop.entity.Customer;
import hg.webshop.model.AccountInfo;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.transaction.annotation.Transactional;
 
@Transactional
public class CustomerDAOImpl implements CustomerDAO {
    
    @Autowired
    private SessionFactory sessionFactory;
 
    @Override
    public Customer findAccount(String email ) {
    	System.out.println("FIND USER BY EMAIL: " + email);
        Session session = sessionFactory.getCurrentSession();
        Criteria crit = session.createCriteria(Customer.class);
        crit.add(Restrictions.eq("email", email));
        return (Customer) crit.uniqueResult();
    }
    
    @Override
    public void save(AccountInfo accountInfo){
    	
        Customer customer = new Customer();
        customer.setEmail(accountInfo.getEmail());
        customer.setPassword(accountInfo.getPassword());
        customer.setUserRole("CUSTOMER");
        
        this.sessionFactory.getCurrentSession().persist(customer);

        this.sessionFactory.getCurrentSession().flush();
        
    }
 
}