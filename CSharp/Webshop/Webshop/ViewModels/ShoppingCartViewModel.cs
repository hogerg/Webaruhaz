using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using Webshop.Models;
using System.ComponentModel.DataAnnotations;

namespace Webshop.ViewModels
{
    public class ShoppingCartViewModel
    {
        [Key]
        public int dummyID { get; set; }

        public List<Cart> CartItems { get; set; }

        public decimal CartTotal { get; set; }
    }
}