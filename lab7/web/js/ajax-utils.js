function createSession(totalQuestions, questionsPerPage) {
	$.post(
		"/home",
		{ action: 'createSession', totalQuestions: totalQuestions, questionsPerPage: questionsPerPage },
		() => location.href = '/quiz.jsp'
	);
}

function loadQuestions(currentData) {
	$.getJSON("/quiz",
		{action: "getQuestions", page: 0},
		function(data) {
			showQuestions(data["questions"]);
			currentData["questions"] = data["questions"];
			if (data["done"] === true) {
				currentData["toGo"] = false;
			}
		}
	);
}

function nextBunch(currentData) {
	$.getJSON("/quiz",
		{action: "getQuestions", page: currentData["page"]},
		function(data){
			if(data["done"] === false) {
				showQuestions(data["questions"]);
				currentData["questions"] = data["questions"];
			} else {
				showQuestions(data["questions"]);
				currentData["toGo"] = false;
				currentData["questions"] = data["questions"];
			}
		}
	);
}

function done(score) {
	$.post(
		"/quiz",
		{ action: 'done', right: score["right"], wrong: score["wrong"]},
		() => location.href = '/result.jsp'
	);
}

function logout() {
	$.post(
		"/logout",
		{ action: 'logout'},
		() => location.href = '/login.jsp'
	);
}