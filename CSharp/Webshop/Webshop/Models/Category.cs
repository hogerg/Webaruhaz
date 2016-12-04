using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Web;

namespace Webshop.Models
{
    public class Category
    {
        public int CategoryID { get; set; }

        [Required(ErrorMessage = "Név kötelező")]
        public string Name { get; set; }

        public string PictureURL { get; set; }

        public List<Product> Products { get; set; }
    }
}