function accepter(){

  var d = new Date();
  var exdays = d.getDate();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = "Accepted = " + true + ";" + expires + ";path=/";
  //alert(document.cookie);
  $("#cookie").empty();
}
