using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using AspMVCex.DataAbstractionLayer;
using AspMVCex.Models;

namespace AspMVCex.Controllers
{
    public class BookController : Controller
    {
        // GET: Book
        public ActionResult Index()
        {
            return View("ViewBook");
        }

        public ActionResult GetBooks()
        {
            DB db = new DB();
            List<Book> slist = db.getAllBooks();
            return Json(new { books = slist }, JsonRequestBehavior.AllowGet);
        }

        public ActionResult AddBook()
        {
            string author = Request.Params["author"];
            string title = Request.Params["title"];
            string genre = Request.Params["genre"];
            string publisher = Request.Params["publisher"];
            DB db = new DB();
            Book book = new Book();
            book.author = author;
            book.title = title;
            book.publisher = publisher;
            book.genre = genre;
            bool result = db.saveBook(book);
            return Json(new { success = result });
        }

        public ActionResult UpdateBook()
        {
            int id = int.Parse(Request.Params["id"]);
            string author = Request.Params["author"];
            string title = Request.Params["title"];
            string genre = Request.Params["genre"];
            string publisher = Request.Params["publisher"];
            DB db = new DB();
            bool result = db.updateBook(id, author, title, publisher, genre);
            return Json(new { success = result });
        }

        public ActionResult DeleteBook()
        {
            int id = int.Parse(Request.Params["id"]);
            DB db = new DB();
            bool result = db.deleteBook(id);
            return Json(new { success = result });
        }

    }
}