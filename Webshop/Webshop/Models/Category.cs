using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Webshop.Models
{
    public class Category
    {
        public int CategoryID { get; set; }
        public string Name { get; set; }
        public List<Product> Products { get; set; }
    }
}