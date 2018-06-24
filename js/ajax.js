function addAnimeToDbtPROXER(id) {
  $.post("/cgi-bin/crawler.cgi", {'id': id, 'page': "PROXER"}, function(data) {
    console.log(data);
    $.post("/classes/inserter.php", {'json': data}, function(data) {

    });
    $("#fw-Proxer").val("");
  });
}
function addAnimeToDbtNew(url, orgtit, deutit, engtit, fsk, genre, desc) {
  $.post("/AnimeSiteProject/Anime/ajaxaddnew.php", {'url': url, 'orgtit': orgtit, 'deutit': deutit, 'engtit': engtit, 'fsk': fsk, 'genre': genre, 'desc': desc}, function(data) {
    console.log(data);
  });
}
