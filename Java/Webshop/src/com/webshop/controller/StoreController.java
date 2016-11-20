package com.webshop.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.servlet.ModelAndView;

@Controller
public class StoreController {

	@RequestMapping("/store")
	public ModelAndView store() {

		return new ModelAndView("store");
	}
	
	@RequestMapping("/cart")
	public ModelAndView cart() {

		return new ModelAndView("cart");
	}
}
