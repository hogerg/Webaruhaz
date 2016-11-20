package com.webshop.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.servlet.ModelAndView;

@Controller
public class HomeController {

	@RequestMapping("/about")
	public ModelAndView about() {

		return new ModelAndView("about");
	}
	
	@RequestMapping("/contact")
	public ModelAndView contact() {

		return new ModelAndView("contact");
	}
}
