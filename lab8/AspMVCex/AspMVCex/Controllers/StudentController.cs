using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using AspMVCex.DataAbstractionLayer;
using AspMVCex.Models;

namespace AspMVCex.Controllers
{
    public class StudentController : Controller
    {
        // GET: Student
        public ActionResult Index()
        {
            return View("ViewGetStudents");
        }

        public ActionResult GetStudents()
        {
            DB db = new DB();
            List<Student> slist = db.getAllStudents();
            return Json(new { students = slist }, JsonRequestBehavior.AllowGet);
            //ViewData["studentList"] = slist;
            //return View("ViewGetStudents");
        }

        public ActionResult AddStudent()
        {
            string name = Request.Params["name"];
            int groupId = int.Parse(Request.Params["groupId"]);
            DB db = new DB();
            Student student = new Student();
            student.groupId = groupId;
            student.name = name;
            bool result = db.saveStudent(student);
            return Json(new { success = result });
        }

        public ActionResult UpdateStudent()
        {
            string name = Request.Params["name"];
            int id = int.Parse(Request.Params["id"]);
            int groupId = int.Parse(Request.Params["group"]);
            DB db = new DB();
            Student student = new Student();
            student.id = id;
            student.groupId = groupId;
            student.name = name;
            bool result = db.updateStudent(id, groupId, name);
            return Json(new { success = result });
        }

        public ActionResult DeleteStudent()
        {
            int id = int.Parse(Request.Params["id"]);
            DB db = new DB();
            bool result = db.deleteStudent(id);
            return Json(new { success = result });
        }
    }
}