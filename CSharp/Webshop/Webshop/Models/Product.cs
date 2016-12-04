using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.ComponentModel;
using System.ComponentModel.DataAnnotations;
using System.Web.Mvc;

namespace Webshop.Models
{
    public class Product
    {
        [ScaffoldColumn(false)]
        public int ProductID { get; set; }

        [DisplayName("Kategória")]
        public int CategoryID { get; set; }

        [Required(ErrorMessage = "Név kötelező")]
        [StringLength(50)]
        public string Name { get; set; }

        [Required(ErrorMessage = "Ár kötelező")]
        public int Price { get; set; }

        public virtual Category Category { get; set; }
    }
}