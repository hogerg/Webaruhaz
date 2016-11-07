using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace Webaruhaz.Controllers
{
    public class ProbaController : Controller
    {
        // GET: Proba
        public ActionResult Index()
        {
            return View();
        }

        public string Aloldal()
        {
            return "aloldal probaszoveg";
        }
    }
}