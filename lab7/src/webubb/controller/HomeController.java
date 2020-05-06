package webubb.controller;

import webubb.domain.User;
import webubb.model.DBConnection;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import java.io.IOException;

@WebServlet("/home")
public class HomeController extends HttpServlet {
  protected void doGet(HttpServletRequest request, HttpServletResponse response)
      throws ServletException, IOException {}

  protected void doPost(HttpServletRequest request, HttpServletResponse response)
      throws ServletException, IOException {

    String action = request.getParameter("action");
    User user = (User) request.getSession().getAttribute("user");
    if ((action != null) && action.equals("createSession")) {
      // We update an asset
      DBConnection db = new DBConnection();
      int createdSessionId =
          db.createSession(
              user.getId(),
              Integer.parseInt(request.getParameter("totalQuestions")),
              Integer.parseInt(request.getParameter("questionsPerPage")));
      HttpSession session = request.getSession();
      session.setAttribute("currentSessionId", createdSessionId);
    }
  }
}
