package webubb.controller;

/** Created by forest. */

import webubb.domain.Session;
import webubb.domain.User;
import webubb.model.DBConnection;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;

@WebServlet("/login")
public class LoginController extends HttpServlet {

  //  public LoginController() {
  //    super();
  //  }
  @Override
  protected void doPost(HttpServletRequest request, HttpServletResponse response)
      throws ServletException, IOException {

    String username = request.getParameter("username");
    String password = request.getParameter("password");

    DBConnection db = new DBConnection();
    User user = db.authenticate(username, password);
    if (user != null) {
      Session currentSession = db.getCurrentSessionOfUser(user.getId());
      if (currentSession != null && currentSession.isAlive()) {
        db.closeSession(db.getCurrentSessionOfUser(user.getId()).getId());
      }
      request.getSession().setAttribute("user", user);
      response.sendRedirect("/home.jsp");
    } else {
      response.sendRedirect("/bad_request.jsp");
    }
  }
}
