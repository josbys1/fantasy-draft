<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>

<body>
    <div class='container'>
      <br/>
  <?php include('startSession.php');?>
        <div id="tableHolder">

        </div>
    </div>
</body>

</html>
<script type="text/javascript">
    $(document).ready(function() {
        refreshTable();
    });

    function refreshTable() {
      var url= <?php echo '\'', 'getData.php?login=',urlencode($_GET['login']),'\'';?>;
      console.log(url);
        $('#tableHolder').load(url, function() {
            setTimeout(refreshTable, 2000);
        });
    }

     function btnclick(clicked_id){
       updateVals(clicked_id);
     }
     function updateVals(cid) {
       $.ajax({
                     type: 'POST',
                     url: 'clickedButton.php',
                     data: {id: cid.toString(),name:<?php echo '\'',$_GET['login'],'\'';?> },
                     dataType: 'text',
                     success: function (data) {
                       console.log("Successfully called AJAX on button click.")
                       console.log(data);
                       //refreshTable();
                     },
                     error: function(xhr, status, error){
                       console.log(error);
                     }
             });
      }


</script>
