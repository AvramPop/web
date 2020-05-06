package webubb.controller;

import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import webubb.domain.Question;
import webubb.domain.User;
import webubb.model.DBConnection;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.Collections;
import java.util.List;

@WebServlet("/quiz")
public class QuizController extends HttpServlet {
  List<Question> questions;

  @Override
  protected void doGet(HttpServletRequest request, HttpServletResponse response)
      throws ServletException, IOException {
    String action = request.getParameter("action");
    User user = (User) request.getSession().getAttribute("user");

    if ((action != null) && action.equals("getQuestions")) {
      JSONArray jsonAssets = new JSONArray();
      PrintWriter out = new PrintWriter(response.getOutputStream());
      DBConnection db = new DBConnection();
      int page = Integer.parseInt(request.getParameter("page"));
      if (page == 0) {
        questions = db.getAllQuestions();
        Collections.shuffle(questions);
      }
      int questionsPerPage = db.getCurrentSessionOfUser(user.getId()).getQuestionPerPage();
      int totalQuestions = db.getCurrentSessionOfUser(user.getId()).getTotalQuestions();
      JSONObject answer = new JSONObject();
      int i;
      for (i = page * questionsPerPage;
          i < (page + 1) * questionsPerPage && i < totalQuestions && i < questions.size();
          i++) {
        JSONObject jObj = new JSONObject();
        jObj.put("id", questions.get(i).getId());
        jObj.put("question", questions.get(i).getQuestion());
        jObj.put("answer1", questions.get(i).getAnswer1());
        jObj.put("answer2", questions.get(i).getAnswer2());
        jObj.put("answer3", questions.get(i).getAnswer3());
        jObj.put("correctAnswer", questions.get(i).getCorrectAnswer());
        jsonAssets.add(jObj);
      }
      System.out.println((page + 1) * questionsPerPage);
      System.out.println(questions.size());
      System.out.println(totalQuestions);
      answer.put(
          "done",
          (page + 1) * questionsPerPage >= questions.size()
              || (page + 1) * questionsPerPage >= totalQuestions);
      answer.put("questions", jsonAssets);
      out.println(answer);
      out.flush();
    }
  }

  @Override
  protected void doPost(HttpServletRequest request, HttpServletResponse response)
      throws ServletException, IOException {
    String action = request.getParameter("action");
    User user = (User) request.getSession().getAttribute("user");

    if ((action != null) && action.equals("done")) {
      DBConnection db = new DBConnection();
      db.closeSession(db.getCurrentSessionOfUser(user.getId()).getId());
      System.out.println("right answers:" + request.getParameter("right"));
      System.out.println("wrong answers:" + request.getParameter("wrong"));
      int right = Integer.parseInt(request.getParameter("right"));
      request.getSession().setAttribute("right", request.getParameter("right"));
      request.getSession().setAttribute("wrong", request.getParameter("wrong"));
      if (right > user.getBest()) {
        db.updateBest(user.getId(), right);
        user.setBest(right);
      }
    }
  }
}
