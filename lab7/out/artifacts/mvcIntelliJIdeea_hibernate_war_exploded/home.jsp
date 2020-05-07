<%@ page import="webubb.domain.User" %><%--
  Created by IntelliJ IDEA.
  User: forest
  Date: 16.12.2014
  Time: 10:47
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Home</title>
    <style>

        input[type=text]:focus {
            background-color: lightblue;
        }

        button {background-color: #008CBA;}
        h2 {
            font-weight: bold;
        }

    </style>
    <script src="js/jquery-2.0.3.js"></script>
    <script src="js/ajax-utils.js"></script>
</head>
<body>


<%
    User user = (User) session.getAttribute("user");
    if(user == null){
        response.sendRedirect("/bad_request.jsp");
    } else {
        out.println("<h2>Welcome " + user.getUsername() + "</h2>");
        out.println("<h2>Your current best is: " + user.getBest() + " correctly answered questions</h2>");
    }

%>

<section id="create-section">
    <span style="font-weight: bold; background-color: mediumseagreen">Create a new quiz</span><br/>
    <table>
        <tr>
            <td>Total number of questions:</td>
            <td><input type="text" id="total-questions"></td>
        </tr>
        <tr>
            <td>Questions per page:</td>
            <td><input type="text" id="questions-per-page"></td>
        </tr>
        <tr>
            <td>
                <button type="button" id="create-session-btn" >Create</button>
            </td>
            <td></td>
        </tr>
    </table>
</section>
<br>
<button type="button" id="logout-btn" >Logout</button>


<script>
    $(document).ready(function () {
        $("#create-session-btn").click(function () {
            if($("#total-questions").val().length && $("#questions-per-page").val().length) {
                if(!isNaN($("#total-questions").val()) && !isNaN($("#questions-per-page").val())) {
                    if (parseInt($("#total-questions").val()) >= parseInt($("#questions-per-page").val())) {
                        createSession($("#total-questions").val(),
                            $("#questions-per-page").val());
                    } else {
                        alert("The total number of questions should be bigger than the number of questions on a page. Try again");
                    }
                } else {
                    alert("Both field should be numeric");
                }
            } else {
                alert("Both field should be non-empty");
            }
        });
        $("#logout-btn").click(function () {
            logout();
        });
    });
</script>

</body>
</html>