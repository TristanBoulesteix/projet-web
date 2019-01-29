/**
 * @param {*} salt the salt sentence to crypt the cookie.
 */
const cipher = salt => {
  var textToChars = text => text.split('').map(c => c.charCodeAt(0))
  var byteHex = n => ("0" + Number(n).toString(16)).substr(-2)
  var applySaltToChar = code => textToChars(salt).reduce((a,b) => a ^ b, code)

  return text => text.split('')
      .map(textToChars)
      .map(applySaltToChar)
      .map(byteHex)
      .join('')
}
// create a cipher
var myCipher = cipher('mySecretSalt')

/**
 * called when you accept the cookie's creation
 * create a cookie and crypts it.
 */
function accept(){
  var d = new Date();
  d.setTime(d.getTime() +1000*60*60*24*365);//1 year
  var expires = "expires="+ d.toUTCString();
  value = myCipher('true');// --> "7c7a7d6d"
  document.cookie = "Accepted = " + value + ";" + expires + ";path=/";
  $("#cookie").empty();
}

/**
 * verify the vailidity of the cookie
 */
function verify(){
  var cookie = getCookie("Accepted");
  if (cookie == "7c7a7d6d") {
  cookie = "Accepted=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  }
  else{
    createCoooieSec();
  }
}

/**
 * display the cookie wrapper in the template
 * create HTML elements
 */
function createCoooieSec() {
  var cookieWrap = $("#cookie");
	var div1 = $(document.createElement("div")).attr("id", "cookieInjected");
	cookieWrap.append(div1);
  var div2 = $(document.createElement("div")).attr("id", "coookieWrapper");
  div1.append(div2);
  var h4 = $(document.createElement("h4")).attr("id", "cookieHeader").text("Ce site utilise des cookies");
  div2.append(h4);
  div2.append("<p>Ce site utilise des cookies pour améliorer votre expérience utilisateur. En utilisant ce site internet, vous  acceptez notre politique concernant la consevation et l'utilisation des Cookies.<br>  </p>");
  var div4 = $(document.createElement("div")).attr("id", "cookieButtons");
  div2.append(div4);
  var div5 = $(document.createElement("div")).attr("id", "cookieAccept").attr("onclick", "accept()").text("J'accepte");
  div4.append(div5);
  div4.append('<a id="cookieReject" href="{!! route('+'home'+') !!}">Je n'+'accepte pas </a>');
  div4.append('<a id="cookieReadmore" href="/legals">En savoir plus</a>');
}

/**
 * @param {*} cname name of the cookie, "Accepted"
 * @return the cookie find or empty string.
 */
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

