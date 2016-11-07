using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using Webaruhaz.DAL;
using Webaruhaz.Models;

namespace Webaruhaz.Controllers
{
    public class TermekController : Controller
    {
        private TermekContext db = new TermekContext();

        // GET: Termek
        public ActionResult Index()
        {
            return View(db.Termekek.ToList());
        }

        // GET: Termek/Details/5
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Termek termek = db.Termekek.Find(id);
            if (termek == null)
            {
                return HttpNotFound();
            }
            return View(termek);
        }

        // GET: Termek/Create
        public ActionResult Create()
        {
            return View();
        }

        // POST: Termek/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "TermekID,Ar,Nev,Kategoria")] Termek termek)
        {
            if (ModelState.IsValid)
            {
                db.Termekek.Add(termek);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            return View(termek);
        }

        // GET: Termek/Edit/5
        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Termek termek = db.Termekek.Find(id);
            if (termek == null)
            {
                return HttpNotFound();
            }
            return View(termek);
        }

        // POST: Termek/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "TermekID,Ar,Nev,Kategoria")] Termek termek)
        {
            if (ModelState.IsValid)
            {
                db.Entry(termek).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            return View(termek);
        }

        // GET: Termek/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Termek termek = db.Termekek.Find(id);
            if (termek == null)
            {
                return HttpNotFound();
            }
            return View(termek);
        }

        // POST: Termek/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            Termek termek = db.Termekek.Find(id);
            db.Termekek.Remove(termek);
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
    }
}
