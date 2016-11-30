package hg.webshop.validator;

import org.apache.commons.validator.routines.EmailValidator;

import hg.webshop.model.AccountInfo;
import org.springframework.stereotype.Component;
import org.springframework.validation.Errors;
import org.springframework.validation.ValidationUtils;
import org.springframework.validation.Validator;
 
@Component
public class AccountInfoValidator implements Validator {
 
    private EmailValidator emailValidator = EmailValidator.getInstance();
 
    @Override
    public boolean supports(Class<?> clazz) {
        return clazz == AccountInfo.class;
    }
 
    @Override
    public void validate(Object target, Errors errors) {
        AccountInfo accountInfo = (AccountInfo) target;

        ValidationUtils.rejectIfEmptyOrWhitespace(errors, "email", "NotEmpty.registerForm.email");
        ValidationUtils.rejectIfEmptyOrWhitespace(errors, "password", "NotEmpty.registerForm.password");
        ValidationUtils.rejectIfEmptyOrWhitespace(errors, "passwordConfirm", "NotEmpty.registerForm.passwordConfirm");
        
        if(!(accountInfo.getPassword().equals(accountInfo.getPasswordConfirm()))){
        	errors.rejectValue("password", "Nem egyezo jelszó");
        }
 
        if (!emailValidator.isValid(accountInfo.getEmail())) {
            errors.rejectValue("email", "Pattern.customerForm.email");
        }
    }
 
}