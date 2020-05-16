using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using AspMVCex.DataAbstractionLayer;
using AspMVCex.Models;

namespace AspMVCex.Controllers
{
    public class CatalogController : Controller
    {
        // GET: Catalog
        public ActionResult Index()
        {
            return View("ViewCatalog");
        }

        public ActionResult SearchBooks()
        {
            string query = Request.Params["query"];
            List<Book> result = new List<Book>();
            DB db = new DB();
            List<Book> temp = new List<Book>();
            temp = db.selectBooksWithIdentifierLike("author", query);
            foreach (Book book in temp)
            {
                if (this.itemNotInList(book, result))
                {
                    result.Add(book);
                }
            }
            temp = db.selectBooksWithIdentifierLike("title", query);
            foreach (Book book in temp)
            {
                if (this.itemNotInList(book, result))
                {
                    result.Add(book);
                }
            }
            temp = db.selectBooksWithIdentifierLike("genre", query);
            foreach (Book book in temp)
            {
                if (this.itemNotInList(book, result))
                {
                    result.Add(book);
                }
            }
            temp = db.selectBooksWithIdentifierLike("publisher", query);
            foreach (Book book in temp)
            {
                if (this.itemNotInList(book, result))
                {
                    result.Add(book);
                }
            }
            foreach (Book tempBook in result)
            {
                Debug.WriteLine(tempBook.title);
            }
            return Json(new { books = result }, JsonRequestBehavior.AllowGet);
        }

        private bool itemNotInList(Book book, List<Book> list)
        {
            foreach (Book temp in list)
            {
                if (temp.id == book.id) return false;
            }
            return true;
        }
    }
}