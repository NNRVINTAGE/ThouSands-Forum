function IntakeDataF() {
  var Intakes = new XMLHttpRequest();
  Intakes.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("content").innerHTML = this.responseText;
    }
  };
  Intakes.open("GET", "IntakeDataF.php", true);
  Intakes.send();
}