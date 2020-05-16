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
    public class LendController : Controller
    {
        // GET: Lend
        public ActionResult Index()
        {
            return View("ViewLend");
        }

        public ActionResult GetAllLentBooks()
        {
            DB db = new DB();
            List<Book> slist = db.getAllLentBooks();
            return Json(new { books = slist }, JsonRequestBehavior.AllowGet);
        }

        public ActionResult GetAllAvailableBooks()
        {
            DB db = new DB();
            List<Book> slist = db.getAllAvailableBooks();
            return Json(new { books = slist }, JsonRequestBehavior.AllowGet);
        }

        public ActionResult GetNameOfBorrower()
        {
            int id = int.Parse(Request.Params["borrowerId"]);
            DB db = new DB();
            Student student = db.selectStudent(id);
            Debug.WriteLine(student.name);
            return Json(new { name = student.name }, JsonRequestBehavior.AllowGet);
        }

        public ActionResult ReturnBook()
        {
            int id = int.Parse(Request.Params["id"]);
            DB db = new DB();
            bool result = db.returnBook(id);
            return Json(new { success = result });
        }


        public ActionResult Lend()
        {
            int id = int.Parse(Request.Params["id"]);
            string name = Request.Params["name"];
            DB db = new DB();
            Student student = db.selectStudent(name);
            Debug.WriteLine(student.name);
            bool result = db.lendBook(student.id, id);
            return Json(new { success = result });
        }
    }
}