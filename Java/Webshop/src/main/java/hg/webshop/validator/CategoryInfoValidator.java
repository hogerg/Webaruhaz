package hg.webshop.validator;

import org.springframework.stereotype.Component;
import org.springframework.validation.Errors;
import org.springframework.validation.ValidationUtils;
import org.springframework.validation.Validator;

import hg.webshop.model.CategoryInfo;

@Component
public class CategoryInfoValidator implements Validator{
	
	@Override
    public boolean supports(Class<?> clazz) {
        return clazz == CategoryInfo.class;
    }

	@Override
    public void validate(Object target, Errors errors) {
 
        ValidationUtils.rejectIfEmptyOrWhitespace(errors, "name", "NotEmpty.productForm.name");

    }

}
