package hg.webshop.dao.impl;

import java.util.List;

import org.hibernate.Criteria;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.criterion.Restrictions;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.transaction.annotation.Transactional;

import hg.webshop.dao.CategoryDAO;
import hg.webshop.entity.Category;
import hg.webshop.model.CategoryInfo;

@Transactional
public class CategoryDAOImpl implements CategoryDAO{
	
	@Autowired
    private SessionFactory sessionFactory;

	@Override
	public Category findCategory(int id){
		Session session = sessionFactory.getCurrentSession();
        Criteria crit = session.createCriteria(Category.class);
        crit.add(Restrictions.eq("id", id));
        return (Category) crit.uniqueResult();
	}
    
	@Override
    public CategoryInfo findCategoryInfo(int id){
		Category category = this.findCategory(id);
        if (category == null) {
            return null;
        }
        return new CategoryInfo(category.getID(), category.getName(), category.getPicName());
    }

	@Override
    public List<CategoryInfo> queryCategories(){
		String sql = "Select new " + CategoryInfo.class.getName() //
                + "(c.id, c.name, c.picName) " + " from "//
                + Category.class.getName() + " c ";

        Session session = sessionFactory.getCurrentSession();
 
        Query query = session.createQuery(sql);

        return query.list();
    }
	
	@Override
    public void save(CategoryInfo categoryInfo){
		 
        Category category = new Category();

        category.setName(categoryInfo.getName());
        category.setPicName(categoryInfo.getPicName());

        this.sessionFactory.getCurrentSession().persist(category);

        this.sessionFactory.getCurrentSession().flush();
    }
	
	@Override
	public void delete(CategoryInfo categoryInfo){
		int id = categoryInfo.getId();
		
		Category category = null;
		
		if (id >= 0 ) {
            category = this.findCategory(id);
            
            this.sessionFactory.getCurrentSession().delete(category);
            
            this.sessionFactory.getCurrentSession().flush();
        }
	}
}
