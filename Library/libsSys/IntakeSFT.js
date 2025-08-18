function IntakeDataSFT() {
  var Intakes = new XMLHttpRequest();
  Intakes.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("content").innerHTML = this.responseText;
    }
  };
  Intakes.open("GET", "IntakeDataSFT.php", true);
  Intakes.send();
}