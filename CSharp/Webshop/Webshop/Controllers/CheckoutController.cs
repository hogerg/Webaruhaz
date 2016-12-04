using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using Webshop.Models;
using System.Net.Mail;
using System.Diagnostics;

namespace Webshop.Controllers
{
    [Authorize]
    public class CheckoutController : Controller
    {
        StoreEntities storeDB = new StoreEntities();

        //
        // GET: /Checkout/AddressAndPayment
        public ActionResult AddressAndPayment()
        {
            Order previousOrder = new Order();
            previousOrder.Email = User.Identity.Name;

            List<Order> prevOrders = storeDB.Orders.Where(o => o.Email == User.Identity.Name).ToList();
            if(prevOrders.Count > 0)
            {
                previousOrder = prevOrders[0];
            }

            ViewBag.PreviousOrder = previousOrder;
            return View(previousOrder);
        }

        //
        // POST: /Checkout/AddressAndPayment
        [HttpPost]
        public ActionResult AddressAndPayment(FormCollection values)
        {
            var order = new Order();
            TryUpdateModel(order);

            try
            {
                if (!values["Accept"].Contains("true"))
                {
                    return View(order);
                }
                else
                {
                    order.Username = User.Identity.Name;
                    order.OrderDate = DateTime.Now;

                    storeDB.Orders.Add(order);
                    storeDB.SaveChanges();

                    var cart = ShoppingCart.GetCart(this.HttpContext);
                    cart.CreateOrder(order);

                    return RedirectToAction("Complete", new { id = order.OrderId });
                }
            }
            catch
            {
                return View(order);
            }
        }

        //
        // GET: /Checkout/Complete
        public ActionResult Complete(int id)
        {
            bool isValid = storeDB.Orders.Any(o => o.OrderId == id && o.Username == User.Identity.Name);

            if (isValid)
            {
                MailMessage mail = new MailMessage();

                SmtpClient smtpServer = new SmtpClient("smtp.gmail.com");
                smtpServer.UseDefaultCredentials = false;
                smtpServer.EnableSsl = true;
                smtpServer.Credentials = new System.Net.NetworkCredential("hogergwebshop", "szakdolgozat");
                smtpServer.Port = 587; // Gmail port   

                mail.From = new MailAddress("hogergwebshop@gmail.com");
                mail.To.Add(User.Identity.Name);
                mail.Subject = "Webshop vásárlás";
                mail.Body = "Rendelése sikeres, köszönjük a vásárlást!";

                smtpServer.Send(mail);

                return View(id);
            }
            else
            {
                return View("Error");
            }
        }
    }
}