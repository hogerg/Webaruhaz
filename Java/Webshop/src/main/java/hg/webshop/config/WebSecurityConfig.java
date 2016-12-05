package hg.webshop.config;

import hg.webshop.authentication.MyDBAuthenticationService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.authentication.encoding.Md5PasswordEncoder;
import org.springframework.security.config.annotation.authentication.builders.AuthenticationManagerBuilder;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.config.annotation.web.configuration.WebSecurityConfigurerAdapter;
 
@Configuration
@EnableWebSecurity
public class WebSecurityConfig extends WebSecurityConfigurerAdapter {
 
   @Autowired
   MyDBAuthenticationService myDBAauthenticationService;
 
   @Autowired
   public void configureGlobal(AuthenticationManagerBuilder auth) throws Exception {
 
       auth.userDetailsService(myDBAauthenticationService).passwordEncoder(new Md5PasswordEncoder());
 
   }
 
   @Override
   protected void configure(HttpSecurity http) throws Exception {
 
       http.csrf().disable();
 
       http.authorizeRequests().antMatchers(
    		   "/shoppingCartCustomer", 
    		   "/shoppingCartFinalize")//
       .access("hasAnyRole('ROLE_CUSTOMER', 'ROLE_MANAGER')");
 
       http.authorizeRequests().antMatchers(
    		   "/manageProducts", 
    		   "/manageProducts/newProduct",
    		   "/manageProducts/deleteProduct",
    		   "/manageCategories",
    		   "/manageCategories/newCategory",
    		   "/manageCategories/deleteCategory")
       .access("hasRole('ROLE_MANAGER')");
 
       http.authorizeRequests().and().exceptionHandling().accessDeniedPage("/403");
 
       // Config for Login Form
       http.authorizeRequests().and().formLogin()//
               .loginProcessingUrl("/j_spring_security_check")//
               .loginPage("/login")//
               .defaultSuccessUrl("/productList")//
               .failureUrl("/login?error=true")//
               .usernameParameter("email")//
               .passwordParameter("password")
               .and().logout().logoutUrl("/logout").logoutSuccessUrl("/");
 
   }
}