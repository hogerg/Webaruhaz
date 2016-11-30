package hg.webshop.dao;

import java.util.List;

import hg.webshop.entity.Category;
import hg.webshop.model.CategoryInfo;

public interface CategoryDAO {
 
    
    public Category findCategory(int id);
    
    public CategoryInfo findCategoryInfo(int id) ;

    public List<CategoryInfo> queryCategories();
	
    public void save(CategoryInfo categoryInfo);
    
    public void delete(CategoryInfo categoryInfo);
    
}