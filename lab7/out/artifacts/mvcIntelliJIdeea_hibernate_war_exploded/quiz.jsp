<%@ page import="webubb.domain.Question" %>
<%@ page import="java.util.List" %>
<%@ page import="webubb.domain.User" %><%--
  Created by IntelliJ IDEA.
  User: dani
  Date: 5/6/20
  Time: 3:00 PM
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>Quiz</title>
    <style>
        form {
            margin-left: auto;
            margin-right: auto;
            width: 400px;
        }
        h2 {
            font-weight: bold;
        }
        button {background-color: #008CBA;}

    </style>
    <script src="js/jquery-2.0.3.js"></script>
    <script src="js/ajax-utils.js"></script>
</head>
<body>
<%
    User user = (User) session.getAttribute("user");
    if(user == null){
        response.sendRedirect("/bad_request.jsp");
    }

%>
<section id="questions">
</section>
<p><button id="next-btn" type="button">Next</button></p>
<script>
    function showQuestions(questions) {
        var content = "";
        for (let i = 0; i < questions.length; i++) {
            content += "<h4><b>" + questions[i]["question"] + "</b></h4>";
            content += "<input type = \"radio\" name = \"" + i + "\" value = \"1\">" + questions[i]["answer1"] + "<br>";
            content += "<input type = \"radio\" name = \"" + i + "\" value = \"2\">" + questions[i]["answer2"] + "<br>";
            content += "<input type = \"radio\" name = \"" + i + "\" value = \"3\">" + questions[i]["answer3"] + "<br>";
        }
        $("#questions").html(content);
    }

    function updateScore(score, questions) {
        for (let i = 0; i < questions.length; i++) {
            console.log(questions);
            var inputName = "\"" + i + "\"";
            var radioValue = $("input[name=" + inputName + "]:checked").val();
            if (parseInt(radioValue) === parseInt(questions[i]["correctAnswer"])) {
                score["right"]++;
            } else {
                score["wrong"]++;
            }
        }
    }

    $(document).ready(function(){
        var currentData = {page: 1, toGo: true};
        loadQuestions(currentData);
        var score = {right: 0, wrong: 0};

        $("#next-btn").click(function() {
            updateScore(score, currentData["questions"], currentData);
            if(currentData["toGo"] === false) {
                done(score);
            } else {
                nextBunch(currentData);
                currentData["page"] = currentData["page"] + 1;
            }
        })
    });
</script>
</body>
</html>
