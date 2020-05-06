<%--
  Created by IntelliJ IDEA.
  User: forest
  Date: 5/17/2018
  Time: 7:43 AM
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>

<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    form {
      margin-left: auto;
      margin-right: auto;
      width: 400px;
    }
  </style>
</head>
<body>
<form action="/login" method="post">
  Enter username : <input type="text" name="username"> <BR>
  Enter password : <input type="password" name="password"> <BR>
  <input type="submit" value="Login"/>
</form>
</body></html>