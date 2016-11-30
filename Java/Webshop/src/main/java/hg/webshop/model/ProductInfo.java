package hg.webshop.model;

import hg.webshop.entity.Product;
 
public class ProductInfo {
    private int id;
    private String name;
    private double price;
    private int categoryId;
 
    private boolean newProduct=false;
 
    public ProductInfo() {
    }
 
    public ProductInfo(Product product) {
        this.id = product.getID();
        this.name = product.getName();
        this.price = product.getPrice();
        this.categoryId = product.getCategoryId();
    }
 
    public ProductInfo(int id, String name, double price, int categoryId) {
        this.id = id;
        this.name = name;
        this.price = price;
        this.categoryId = categoryId;
    }
 
    public int getId() {
        return id;
    }
 
    public void setId(int id) {
        this.id = id;
    }
 
    public String getName() {
        return name;
    }
 
    public void setName(String name) {
        this.name = name;
    }
 
    public double getPrice() {
        return price;
    }
 
    public void setPrice(double price) {
        this.price = price;
    }
    
    public int getCategoryId() {
        return categoryId;
    }
 
    public void setCategoryId(int categoryId) {
        this.categoryId = categoryId;
    }
 
    public boolean isNewProduct() {
        return newProduct;
    }
 
    public void setNewProduct(boolean newProduct) {
        this.newProduct = newProduct;
    }
 
}