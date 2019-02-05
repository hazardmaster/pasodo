<?php $conn = mysqli_connect("localhost", "root", "", "pasodo"); ?>
<?php require_once("../include/sessions.php");?>
<!DOCTYPE>

<html>
    <head>
        <title>Loan Approval</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/backend.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        
    </head>
    <body>
        <?php 
            include('../myHTML/simple_html_dom.php');
            echo file_get_html('../myHTML/navbar.html');
             ?>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <!--<h3 style="color:white">Super Admin!!!</h3>-->
                    <ul id="side_menu" class="nav nav-pills nav-stacked">
                        <li><a href="index.php">Add new client</a></li>
                        <li><a href="categories.php">View Categories</a></li>
                        <li class="active"><a href="transactionapproval.php">Approve transactions</a></li>
                        <li><a href="">Manage administrators</a></li>
                    </ul>
                </div>
                <div class="col-sm-10" style="width: 80%">
                    <h1 style="color: #000000">Please Approve the following Loans</h1>
                    <?php
                        echo message();
                        echo SuccessMessage();
                    ?>

                    <!--Input CLient Loan Information in a table for approval-->
                    <div class="table-responsive" style="">
                         <table class="table table-borderless table-dark">
                            <thead class="thead-light" style="color: #000000">
                                <th>ID NUMBER</th>
                                <th>NAME</th>
                                <th>Amount</th>
                                <th>Loan Officer Notes</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                             <?php     
                                    $sql = "SELECT * FROM loan";
                                    $result = $conn->query($sql);
                                    if($result->num_rows > 0){
                                        while($datarows = $result->fetch_assoc()){
                                            $loanID = $datarows["ID"];
                                            $clientID = $datarows["clientID"];
                                            $amount = $datarows["amount"];
                                            $notes = $datarows["notes"];
                                            $status = $datarows["status"];

                                            
                                                //Looking for client's name
                                              //  $sql = "SELECT firstName, lastName FROM client2 WHERE clientID='$clientID' ";
                                                //$result = $conn->query($sql);
                                                //$datarows = $result->fetch_assoc();
                                                //$firstName = $datarows['firstName'];
                                                //$lastName = $datarows['lastName'];

                                         ?>
                                        <tr style="color: #000000" >
                                            <td><?php echo $clientID ?></td>
                                            <td>
                                                <?php                                              
                                                    echo "" ;
                                                     ?>                                      
                                            </td>
                                            <td><?php echo $amount ?></td>
                                            <td><?php echo $notes ?></td>
                                            <td><?php echo $status; ?></td>
                                            <td>
                                                <a type="button" href="approve.php?id=<?php echo $loanID ?>">Approve</a>
                                                
                                                <a type="button" href="disapprove.php?id=<?php echo $loanID ?>">Disapprove</a>
                                            </td>
                                        </tr>
                                         <?php 
                                          }  
                                        }
                                      else{
                                        echo "<h3 style = \"color: red; \" >No results found</h3>";
                                    }
                                 ?>                       
                        </table>
                    </div>
                                     
                </div>
            </div><!-- Ending of row-->
        </div><!-- ending of container-->
        <div id="footer" style="position: fixed; bottom: 0; width: 1360px;">
            <hr><p>Brain Behind | Oscar Hazard | &copy;2018  --- All rights reserved</p>
            <a style="color:white; text-decoration: none; cursor:pointer; fontweight:bold;" href="/">Pasodo</a>
            <p>This site is only for use by PASODO finance group. All rights reseved. No one is allowed to make a copy of this site.</p>
        </div>
        <div style="height: 10px; background: #27AAE1;"></div>
    </body>

</html>