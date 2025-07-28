function IntakeDataF() {
  var Intakes = new XMLHttpRequest();
  Intakes.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("content").innerHTML = this.responseText;
    }
  };
  Intakes.open("GET", "IntakeDataF.php", true);
  Intakes.send();
};

window.addEventListener('load', function()
{
    var xhr = null;
    getXmlHttpRequestObject = function()
    {
        if(!xhr)
        {               
            // Create a new XMLHttpRequest object 
            xhr = new XMLHttpRequest();
        }
        return xhr;
    };

    updateLiveData = function()
    {
        var now = new Date();
        // Date string is appended as a query with live data 
        // for not to use the cached version 
        var url = 'livefeed.txt?' + now.getTime();
        xhr = getXmlHttpRequestObject();
        xhr.onreadystatechange = eventHandler;
        xhr.open("GET", url, true);
        xhr.send(null);
    };
    updateLiveData();
    
    function eventHandler()
    {
        if(xhr.readyState == 4 && xhr.status == 200)
        {
            dataDiv = document.getElementById('liveData');
            // Set current data text
            dataDiv.innerHTML = xhr.responseText;
            // Update the live data every 1 sec
            setTimeout(updateLiveData(), 10000);
        }
    }
});