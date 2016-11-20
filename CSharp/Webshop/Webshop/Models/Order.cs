using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using System.ComponentModel;
using System.ComponentModel.DataAnnotations;

namespace Webshop.Models
{
    [Bind(Exclude = "OrderId")]
    public partial class Order
    {
        [ScaffoldColumn(false)]
        public int OrderId { get; set; }

        [ScaffoldColumn(false)]
        public System.DateTime OrderDate { get; set; }

        [ScaffoldColumn(false)]
        public string Username { get; set; }


        [Required(ErrorMessage = "Vezetéknév kötelező")]
        [DisplayName("Vezetéknév")]
        [StringLength(160)]
        public string LastName { get; set; }

        [Required(ErrorMessage = "Keresztnév kötelező")]
        [DisplayName("Keresztnév")]
        [StringLength(160)]
        public string FirstName { get; set; }
        
        [Required(ErrorMessage = "Cím kötelező")]
        [DisplayName("Cím")]
        [StringLength(70)]
        public string Address { get; set; }

        [Required(ErrorMessage = "Telefonszám kötelező")]
        [DisplayName("Telefonszám")]
        [StringLength(24)]
        public string Phone { get; set; }

        [Required(ErrorMessage = "Email kötelező")]
        [DisplayName("Email cím")]
        [RegularExpression(@"[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}", ErrorMessage = "Email érvénytelen")]
        [DataType(DataType.EmailAddress)]
        public string Email { get; set; }

        [ScaffoldColumn(false)]
        public decimal Total { get; set; }

        public List<OrderDetail> OrderDetails { get; set; }
    }
}