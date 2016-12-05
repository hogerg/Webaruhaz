package hg.webshop.controller;

import hg.webshop.dao.CustomerDAO;
import hg.webshop.entity.Customer;
import hg.webshop.model.AccountInfo;
import hg.webshop.util.HashGenerationException;
import hg.webshop.util.HashUtil;
import hg.webshop.validator.AccountInfoValidator;

import java.util.Properties;

import javax.mail.Message;
import javax.mail.MessagingException;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.MimeMessage;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.transaction.annotation.Propagation;
import org.springframework.transaction.annotation.Transactional;
import org.springframework.ui.Model;
import org.springframework.validation.BindingResult;
import org.springframework.validation.annotation.Validated;
import org.springframework.web.bind.WebDataBinder;
import org.springframework.web.bind.annotation.InitBinder;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.servlet.config.annotation.EnableWebMvc;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;
 
@Controller
@Transactional
@EnableWebMvc
public class AccountController {

    @Autowired
    private CustomerDAO customerDAO;

    @Autowired
    private AccountInfoValidator accountInfoValidator;
 
    @InitBinder
    public void myInitBinder(WebDataBinder dataBinder) {
        Object target = dataBinder.getTarget();
        if (target == null) {
            return;
        }
        System.out.println("Target=" + target);

        if (target.getClass() == AccountInfo.class) {
        	dataBinder.setValidator(accountInfoValidator);
        }
    }
 
    @RequestMapping(value = { "/login" }, method = RequestMethod.GET)
    public String login(Model model) {
 
        return "login";
    }
    
    @RequestMapping(value = { "/register" }, method = RequestMethod.GET)
    public String register(Model model) {
 
        return "register";
    }
    
    @RequestMapping(value = { "/register" }, method = RequestMethod.POST)
    @Transactional(propagation = Propagation.NEVER)
    public String registerSave(Model model, //
            @ModelAttribute("registerForm") @Validated AccountInfo accountInfo, //
            BindingResult result, //
            final RedirectAttributes redirectAttributes) {

    	if(customerDAO.findAccount(accountInfo.getEmail()) != null) {
    		model.addAttribute("error", "Ez az Email cím már használatban van!");
    		return "register";
    	}    	
        if (result.hasErrors()) {
        	model.addAttribute("error", "Hibás adatok!");
        	model.addAttribute("email", accountInfo.getEmail());
            return "register";
        }
        try {
        	accountInfo.setPassword(HashUtil.generateMD5(accountInfo.getPassword()));
            customerDAO.save(accountInfo);
            sendRegistrationEmail(accountInfo.getEmail());
        } catch (Exception e) {
            String message = e.getMessage();
            model.addAttribute("message", message);
            return "register";
 
        }
        return "login";
    }
    
    private void sendRegistrationEmail(String recipient){
    	Properties props = new Properties();
        props.put("mail.smtp.host", "smtp.gmail.com");
        props.put("mail.smtp.port", 587);
        props.put("mail.smtp.starttls.enable", "true");
        Session session = Session.getInstance(props, null);

        try {
            MimeMessage msg = new MimeMessage(session);
            msg.setFrom("hogergwebshop@google.com");
            msg.setRecipients(Message.RecipientType.TO, recipient);
            msg.setSubject("Webshop regisztráció");
            msg.setText("Köszönjük, hogy regisztrált a webáruházunkba!\n");
            Transport.send(msg, "hogergwebshop@gmail.com", "szakdolgozat");
        } catch (MessagingException mex) {
            System.out.println("send failed, exception: " + mex);
        }
    }
}