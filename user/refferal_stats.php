<?php
include_once '../databases/db_connect.php';
include_once '../includes/authentication.php';

if($_SESSION['auth_user']){
    include 'header.php';
    include 'navbar.php';
?>
<div class="container-fluid px-4">
    <?php
    include '../includes/message.php';
    ?>
    </ol>
    <div class="row mt-4">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h4>Referral Statistics
                    </h4>
                </div>
                <div class="card-body">

                                        <div class="row">

<?php
$username = $_SESSION['auth_user']['username'];
$referrer = $_SESSION['auth_user']['referrer'];
   ?>
   <div class="col-md-6 mb-3"> 
   <label for="">Username</label>
       <input type="text" value="<?php echo $username;?>"  class="form-control" readonly> 
   </div>
   <?php
 $refquery = $db->query("SELECT * FROM spectradb");
?>

<div class="col-md-6 mb-3">
    <label for="">Reffered by:</label>
    <input type="text" readonly value="<?php echo $referrer;?>" class="form-control">
</div>   

<?php 
$total_ref_query = $db->query("SELECT * FROM spectradb WHERE referrer = '$username'");
$total_ref = mysqli_num_rows($total_ref_query);?>
<div class="col-md-6 mb-3">
    <label for="">You have referred</label>
    <input type="text" readonly value="<?php echo $total_ref;?> users" class="form-control">
</div>     

  
<div class="col-md-12 mb-3">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                <th>Name</th>
                                                <th>Downlines</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
//show referred users
while($row = $total_ref_query->fetch_array()){
    $ref_user = $row['username']?>
                                                <tr>
                                            <td><?php echo $ref_user;}?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                        </div>
                                    <div class="col-md-12 mb-3">
    <label for="">Your refferal link </label>
    <input type="text" readonly value="http://localhost/portfolio/register?refer=<?php echo $username;?>" id="myInput" class="form-control"> 
    <button onclick="myFunction()" onmouseout="outFunc()">
  <span class="tooltiptext" id="myTooltip">Copy to clipboard  <i class="fas fa-clipboard"></i>
</span>
  </button>
</div>     

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
    }
    include 'footer.php';

?>
<script>
    setTimeout(function() {
        $("#loading").hide();
    }, 2100);
    setTimeout(function() {
        $(".content").show();
    }, 2000);
</script>
<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  navigator.clipboard.writeText(copyText.value);
  
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copied: " + copyText.value;
}

function outFunc() {
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copy to clipboard";
}
</script>
<style>
    .card {
        margin-top: 22vh !important;
    }

    .tooltip {
  position: relative;
  display: inline-block;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 140px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 50%;
  margin-left: -75px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
</style>