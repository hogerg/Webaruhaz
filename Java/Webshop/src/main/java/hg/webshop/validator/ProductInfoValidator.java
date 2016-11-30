package hg.webshop.validator;

import hg.webshop.dao.ProductDAO;
import hg.webshop.entity.Product;
import hg.webshop.model.ProductInfo;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;
import org.springframework.validation.Errors;
import org.springframework.validation.ValidationUtils;
import org.springframework.validation.Validator;
 
@Component
public class ProductInfoValidator implements Validator {
 
    @Autowired
    private ProductDAO productDAO;
 
    @Override
    public boolean supports(Class<?> clazz) {
        return clazz == ProductInfo.class;
    }
 
    @Override
    public void validate(Object target, Errors errors) {
        ProductInfo productInfo = (ProductInfo) target;
 
        ValidationUtils.rejectIfEmptyOrWhitespace(errors, "name", "NotEmpty.productForm.name");
        ValidationUtils.rejectIfEmptyOrWhitespace(errors, "price", "NotEmpty.productForm.price");
        ValidationUtils.rejectIfEmptyOrWhitespace(errors, "categoryId", "NotEmpty.productForm.categoryId");
 
        int id = productInfo.getId();
        if (id >= 0) {
            if(productInfo.isNewProduct()) {
                Product product = productDAO.findProduct(id);
                if (product != null) {
                    errors.rejectValue("id", "Duplicate.productForm.id");
                }
            }
        }
    }
 
}