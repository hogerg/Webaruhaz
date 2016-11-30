package hg.webshop.model;

import hg.webshop.entity.Category;

public class CategoryInfo {

	private int id;
    private String name;
    private String picName;

    public CategoryInfo() {
    }
 
    public CategoryInfo(Category category) {
        this.id = category.getID();
        this.name = category.getName();
    }
 
    public CategoryInfo(int id, String name) {
        this.id = id;
        this.name = name;
    }
    
    public CategoryInfo(int id, String name, String picName) {
        this.id = id;
        this.name = name;
        this.picName = picName;
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

	public String getPicName() {
		return picName;
	}

	public void setPicName(String picName) {
		this.picName = picName;
	}

}
