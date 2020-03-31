function loadPage(){
  loadCSS();
  hideContent();
}

function loadCSS() {
  $("ul").css({
    "list-style-type": "none",
    "margin": "0",
    "padding": "0"
  });
  $("li").css({
    "display": "inline",
    "float": "left"
  });
  $("button").css({
    "color": "black",
    "background-color":"#d3dbd5",
    "padding": "22px 16px",
    "border": "none",
    "width": "100%",
    "outline": "none",
    "text-align": "left",
    "cursor": "pointer",
    "transition":".3s"
  })
  $(".poet-image").css({
    "width":"225px",
    "height":"300px"
  });
  $(".landscape-image").css({
    "width":"1000px",
    "height":"250px"
  });
  $(".poems").css({
    "display":"flex"
  });
  $("button").hover(function(){$(this).css("background-color", "#eee");}, function(){$(this).css("background-color", "#d3dbd5");});
  $("button").click(function(){$(this).css("background-color", "#ccc");});
}

function hideContent() {
  $(".poet").css("display", "none");
}

function showContent(event, poet) {
  $("#page-description").css("display", "none");
  $(".poet").css("display", "none");
  $("#" + poet).css("display", "block");
}
window.onload = loadPage;
