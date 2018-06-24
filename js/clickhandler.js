$("#fw-profilebar-click").click(function () {
  $(".fw-sidebar").toggle();
  console.log("test");
});
$("#fw-Proxer-submit").click(function () {
  if($("#fw-Proxer").val() != ''){
    addAnimeToDbtPROXER($("#fw-Proxer").val());
  }
});

$(".fw-reg-avatar-small-getter").on("click", function(){
    var avatar = $(this).attr("alt");
    console.log(avatar);
    $("#fw-reg-big-img").attr("src", "/AnimeSiteProject/img/Avatar/"+avatar+".png");
    $("#fw-reg-input-avatar").val(avatar);
});
$("#fw-addAnime-button").click(function () {
  var url = $("#fw-addAnime-link").val();
  var orgtit = $("#fw-addAnime-orgtit").val();
  var deutit = $("#fw-addAnime-deutit").val();
  var engtit = $("#fw-addAnime-engtit").val();
  var fsk = $("#fw-addAnime-fsk").val();
  var genre = $("#fw-addAnime-genre").val();
  var desc = $("#fw-addAnime-desc").val();

  addAnimeToDbtNew(url, orgtit, deutit, engtit, fsk, genre, desc);

  $("#fw-addAnime-link").val("");
  $("#fw-addAnime-orgtit").val("");
  $("#fw-addAnime-deutit").val("");
  $("#fw-addAnime-engtit").val("");
  $("#fw-addAnime-fsk").val("");
  $("#fw-addAnime-genre").val("");
  $("#fw-addAnime-desc").val("");

});
