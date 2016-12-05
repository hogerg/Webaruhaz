using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Drawing;
using System.Drawing.Drawing2D;
using System.IO;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using Webshop.Models;

namespace Webshop.Controllers
{
    public class AuthorizeAdminAttribute : AuthorizeAttribute
    {

        public override void OnAuthorization(AuthorizationContext filterContext)
        {
            base.OnAuthorization(filterContext);
            if (!filterContext.HttpContext.User.Identity.IsAuthenticated)
            {
                filterContext.Result = new RedirectResult("/AccessDenied");
                return;
            }

            if (filterContext.Result is HttpUnauthorizedResult)
            {
                filterContext.Result = new RedirectResult("/AccessDenied");
                return;
            }
        }
    }

    [AuthorizeAdmin(Roles = "Admin")]
    public class StoreManagerController : Controller
    {
        private StoreEntities db = new StoreEntities();

        // GET: StoreManager
        public ActionResult Index()
        {
            var products = db.Products.Include(p => p.Category);
            return View(products.ToList());
        }

        // GET: StoreManager/Details/5
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Product product = db.Products.Find(id);
            if (product == null)
            {
                return HttpNotFound();
            }
            return View(product);
        }

        // GET: StoreManager/Create
        public ActionResult Create()
        {
            ViewBag.CategoryID = new SelectList(db.Categories, "CategoryID", "Name");
            return View();
        }

        // POST: StoreManager/Create
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "ProductID,CategoryID,Name,Price")] Product product)
        {
            if (ModelState.IsValid)
            {
                db.Products.Add(product);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            ViewBag.CategoryID = new SelectList(db.Categories, "CategoryID", "Name", product.CategoryID);
            return View(product);
        }

        // GET: StoreManager/Edit/5
        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Product product = db.Products.Find(id);
            if (product == null)
            {
                return HttpNotFound();
            }
            ViewBag.CategoryID = new SelectList(db.Categories, "CategoryID", "Name", product.CategoryID);
            return View(product);
        }

        // POST: StoreManager/Edit/5
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "ProductID,CategoryID,Name,Price")] Product product)
        {
            if (ModelState.IsValid)
            {
                db.Entry(product).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            ViewBag.CategoryID = new SelectList(db.Categories, "CategoryID", "Name", product.CategoryID);
            return View(product);
        }

        // GET: StoreManager/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Product product = db.Products.Find(id);
            if (product == null)
            {
                return HttpNotFound();
            }
            db.Products.Remove(product);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        // POST: StoreManager/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            Product product = db.Products.Find(id);
            db.Products.Remove(product);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        public ActionResult Categories()
        {
            return View(db.Categories.ToList());
        }

        public ActionResult CreateCategory()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult CreateCategory([Bind(Include = "Name,PictureURL")] Category category)
        {
            if(db.Categories.Where(c => c.Name.Contains(category.Name)).Count() > 0)
            {
                ViewBag.CategoryName = "Már létező kategória!";
                return View();
            }

            if(Request.Files.Count == 0 || Request.Files[0].ContentLength == 0)
            {
                ViewBag.Picture = "Kérem válasszon képet!";
                return View();
            }

            if (ModelState.IsValid)
            {
                foreach(string file in Request.Files)
                {
                    var postedFile = Request.Files[file];
                    String fileName = System.Guid.NewGuid().ToString();
                    //postedFile.SaveAs(Server.MapPath("~/Content/images/categories/") + fileName + ".jpg");
                    SaveImage(postedFile, fileName);
                    category.PictureURL = fileName;
                }

                db.Categories.Add(category);
                db.SaveChanges();
                return RedirectToAction("Categories");
            }

            ViewBag.CategoryID = new SelectList(db.Categories, "CategoryID", "Name", category.CategoryID);
            return View(category);
        }

        public ActionResult DeleteCategory(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Category category = db.Categories.Find(id);
            if (category == null)
            {
                return HttpNotFound();
            }
            db.Categories.Remove(category);
            db.SaveChanges();
            return RedirectToAction("Categories");
        }

        private void SaveImage(HttpPostedFileBase file, String fileName)
        {
            String path = Server.MapPath("~/Content/images/categories/");

            Image src = Image.FromStream(file.InputStream);
            Image blank = Image.FromFile(path + "blank.jpg");
            Image resizedPic = src;

            int maxDim = 600;
            float src_w = src.Width;
            float src_h = src.Height;
            float ratio = src_w / src_h;

            if(src_w > maxDim || src_h > maxDim)
            {
                if(ratio > 0)
                {
                    src_w = maxDim;
                    src_h = maxDim / ratio;
                }
                else
                {
                    src_w = maxDim * ratio;
                    src_h = maxDim;
                }
            }

            resizedPic = (Image)(new Bitmap(src, new Size((int)src_w, (int)src_h)));

            using (blank)
            {
                using (var bitmap = new Bitmap(maxDim, maxDim))
                {
                    using (var canvas = Graphics.FromImage(bitmap))
                    {
                        canvas.InterpolationMode = InterpolationMode.HighQualityBicubic;
                        canvas.DrawImage(blank,
                                         new Rectangle(0,
                                                       0,
                                                       maxDim,
                                                       maxDim),
                                         new Rectangle(0,
                                                       0,
                                                       blank.Width,
                                                       blank.Height),
                                         GraphicsUnit.Pixel);
                        canvas.DrawImage(resizedPic,
                                         (bitmap.Width - resizedPic.Width) / 2,
                                         (bitmap.Height - resizedPic.Height) / 2);
                        canvas.Save();
                    }
                    try
                    {
                        bitmap.Save(path + fileName + ".jpg",
                                    System.Drawing.Imaging.ImageFormat.Jpeg);
                    }
                    catch (Exception ex) { }
                }
            }

        }
    }
}
