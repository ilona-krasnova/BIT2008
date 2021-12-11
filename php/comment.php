<script>
    fetchComments();
    // setInterval("fetchComments()", 5000);
    setInterval(fetchComments, 5000); // IK

    //Function to grab comments from database and display
    function fetchComments() {
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.open("get", "fetchComments.php?seedId=<?=$seedId?>", true);

      xmlHttp.onreadystatechange = function(){
        if(xmlHttp.readyState == 4)
        {
          if(xmlHttp.status == 200) {
            displayComments(xmlHttp.responseText);
          }
          else {
              // alert("An error occurred!");
              displayComments("An error occurred!"); //IK
          }
        }
      };
      xmlHttp.send(null);
    }

    //Function to display comment info from database
    function displayComments(sText) {
      var divNews = document.getElementById("Comment");
      divNews.innerHTML = sText;
    }

    //function to upload comment info to database
    function uploadComments() {
      console.log("upload comments");
      var comData = "uCom=" + document.getElementById("comItem").value
      + "&seedId=<?=$seedId?>&userId=<?=$currUser?>"; // IK
      document.getElementById("comItem").value = '';

      var xmlHttp = new XMLHttpRequest();
      xmlHttp.open("post", "uploadComments.php", true);

      xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      xmlHttp.onreadystatechange = function() {
        if(xmlHttp.readyState == 4) {
          if(xmlHttp.status == 200) {
            /* alert("Message posted");*/
          }
          else {
            alert("Oh no.  An error occurred when posting");
          }
        }
      };
      xmlHttp.send(comData);
    }

</script>
