package hg.webshop.validator;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;
import org.springframework.validation.Errors;
import org.springframework.validation.ValidationUtils;
import org.springframework.validation.Validator;

import hg.webshop.dao.CategoryDAO;
import hg.webshop.entity.Category;
import hg.webshop.model.CategoryInfo;

@Component
public class CategoryInfoValidator implements Validator{
	
	@Autowired
	private CategoryDAO categoryDAO;
	
	@Override
    public boolean supports(Class<?> clazz) {
        return clazz == CategoryInfo.class;
    }

	@Override
    public void validate(Object target, Errors errors) {
		CategoryInfo categoryInfo = (CategoryInfo) target;
 
        ValidationUtils.rejectIfEmptyOrWhitespace(errors, "name", "NotEmpty.categoryForm.name");

        String name = categoryInfo.getName();
        if(name != null){
        	Category category = categoryDAO.findCategory(name);
        	if(category != null){
        		errors.rejectValue("name", "Duplicate.categoryForm.name");
        	}
        }
        
    }

}
