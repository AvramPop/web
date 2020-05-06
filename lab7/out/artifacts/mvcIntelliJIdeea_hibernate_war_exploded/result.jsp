<%@ page import="webubb.domain.User" %><%--
  Created by IntelliJ IDEA.
  User: dani
  Date: 5/6/20
  Time: 4:03 PM
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>Result</title>
</head>
<body>
<h1>Your quiz is done</h1>
<h3>Result</h3>
<%
    User user = (User) session.getAttribute("user");
    if(user == null){
        response.sendRedirect("/bad_request.jsp");
    }
    int right = Integer.parseInt((String) session.getAttribute("right"));
    int wrong = Integer.parseInt((String) session.getAttribute("wrong"));
    out.println("<h3>Right answers " + right + "</h3>");
    out.println("<h3>Wrong answers " + wrong + "</h3>");
%>
<a href="home.jsp">HOME</a>
</body>
</html>
