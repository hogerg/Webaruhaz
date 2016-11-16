using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using Webshop.Models;

namespace Webshop.Controllers
{
    public class StoreController : Controller
    {
        StoreEntities storeDB = new StoreEntities();

        //
        // GET: /Store/
        public ActionResult Index(string keyword, int? category)
        {
            ViewBag.Categories = storeDB.Categories.ToList();
            if (!String.IsNullOrEmpty(keyword))
            {
                if (category == null)
                {
                    return View(storeDB.Products.Where(p => p.Name.Contains(keyword)));
                }
                else
                {
                    return View(storeDB.Products.Where(p => p.Name.Contains(keyword) && p.CategoryID == category));
                }
            }

            if (category == null)
            {
                return View(storeDB.Products.ToList());
            }
            else
            {
                return View(storeDB.Products.Where(p => p.CategoryID == category));
            }
        }
        //
        // GET: /Store/Browse
        public ActionResult Browse(string category)
        {
            // Retrieve Category and its Associated Products from database
            var categoryModel = storeDB.Categories.Include("Products").Single(c => c.Name == category);
            return View(categoryModel);
        }
        //
        // GET: /Store/Details
        public ActionResult Details(int id)
        {
            Product product = storeDB.Products.Find(id);
            return View(product);
        }
    }
}