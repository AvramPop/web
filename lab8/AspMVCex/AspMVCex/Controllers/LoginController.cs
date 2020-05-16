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
    public class LoginController : Controller
    {
        // GET: Login
        public ActionResult Index()
        {
            return View("ViewLogin");
        }

        public ActionResult Login()
        {
            string user = Request.Params["user"];
            string password = Request.Params["password"];
            Debug.WriteLine(user + " " + password); 
            DB db = new DB();
            bool result = db.login(user, password);
            Debug.WriteLine(result);
            return Json(new { success = result });
        }
    }
}