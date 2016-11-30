package hg.webshop.entity;

import java.io.Serializable;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;
 
@Entity
@Table(name = "Customer")
public class Customer implements Serializable {
 
    private static final long serialVersionUID = -2054386655979281969L;
 
      
    public static final String ROLE_CUSTOMER = "ROLE_CUSTOMER";
 
    private String email;
    private String password;
    private String userRole;
 
    @Id
    @Column(name = "email", length = 30, nullable = false)
    public String getEmail() {
        return email;
    }
 
    public void setEmail(String email) {
        this.email = email;
    }
 
    @Column(name = "Password", length = 20, nullable = false)
    public String getPassword() {
        return password;
    }
 
    public void setPassword(String password) {
        this.password = password;
    }
 
    @Column(name = "User_Role", length = 20, nullable = false)
    public String getUserRole() {
        return userRole;
    }
 
    public void setUserRole(String userRole) {
        this.userRole = userRole;
    }
    
    @Override
    public String toString()  {
        return "["+ this.email+","+ this.password+","+ this.userRole+"]";
    }
    
}
