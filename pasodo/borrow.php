<?php
    if(isset($_POST["submitborrowed"])){
        $ID = $_POST["id"];
            echo $ID;
    }
?>


                    
                   <!--Pay Loan and Borrow Loan Buttons -->

                    <!--Pay Loan Button-->
                    <a href="transaction.php? id =" <?php 
                        if (isset($_POST["submit"])){
                            $clientID = $_POST["clientID"];
                             echo $clientID;
                        }
                             
                        ?> class="btn btn-light btn-small"><span>Pay loan</span></a>

                    <!--Borrow Loan Button-->
                        <a href="" class="btn btn-light btn-small" data-toggle="modal" data-target="#borrowloan"><span>Borrow loan </span></a>


                    
                  
                   
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>ID NUMBER</th>
                            <th>NAME</th>
                            <th>CATEGORY</th>
                            <th>PHONE NUMBER</th>
                            <th>Date Added</th>
                        </tr>

                             <?php                        
                                if(isset($_POST["submit"])){
                                    if($conn->connect_error){
                                        die("Connection failed:" .$conn->connect_error);
                                         }else{

                                    $clientID = $_POST['clientID'];
                                            
                                    $sql = "SELECT * FROM client2 WHERE clientID = '$clientID' ";
                                        
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($datarows = $result->fetch_assoc()) {
                                            $ID = $datarows["clientID"];
                                            $name = $datarows["firstName"];
                                            $category_id = $datarows["category_id"];
                                            $phone = $datarows["phone"];
                                            $date = $datarows["created_at"];  ?>
                                
                                    <input type="hidden" name="hazard" value="<?php echo $ID ?>">
                                    <tr>
                                        <td><?php echo $ID ?></td>
                                        <td><?php echo $name ?></td>
                                            <td><?php 
                                                $sql = "SELECT name FROM category WHERE ID = '$category_id' ";
                                                $result = $conn->query($sql);
                                                $datarows = $result->fetch_assoc();
                                                $catname = $datarows["name"];
                                                echo $catname;
                                                ?>                                            
                                            </td>
                                        <td><?php echo $phone ?></td>
                                        <td><?php echo $date ?></td>
                                    </tr>
                                    <?php                                        
                                    }
                                  }
                                } 
                            }
                            ?>                               
                             
                    </table> 


                    

  <div class="modal fade" id="borrowloan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                             <h3>Borrow Loan <?php echo $clientID?></h3> 
                                </div>
                                <?php $fetch_array = "SELECT * FROM clients2 WHERE ID = '$clientID' ";                                        
                                    $execute = mysqli_query($conn, $fetch_array);                                     
                                while($datarows = mysqli_fetch_array($execute)){
                                    $ID = $datarows["ID"];
                                    $name = $datarows["Name"];
                                    $category = $datarows["Category"];
                                    $phone = $datarows["Phone"];
                                    $date = $datarows["Date"];
                                    ?>
                        
                                    
                                        
                        
                       <?php } 
                                

                            
                            ?>
                                
                                <form action="borrow.php" method="post" enctype="multipart/form-data">                                  
                                    <label for="Borrowername" class="col-sm-4 col-form-label">Name:</label>                            
                                    <input type="text" readonly class="form-control-plaintext" name='name' id="Borrowername" value="<?php echo $name; ?>"><br><br>
                                    <label for="BorrowerID" class="col-sm-4 col-form-label">ID Number:</label>
                                    <input type="text" readonly class="form-control-plaintext" id="BorrowerID" name='id' value="<?php echo $ID;?>"><br><br>
                                    <br><br>              
                                    <label class="col-sm-12 col-form-label">How Much Do you want to borrow Mr. <?php echo $name?>:</label><br>     <label for="Borroweramount" class="col-sm-4 col-form-label">Amount:</label>
                                    <input type="text" class="form-control-plaintext" name="amount" id="amount" placeholder="Min 500 - Max 20,000"><br><br>
                                    <label for="Borroweramount" class="col-sm-4 col-form-label">Transaction Date:</label>
                                    <input type="date" name="T_Date" class="form-control-plaintext" id="T_Date" placeholder="<?php                         date_default_timezone_set("Africa/nairobi");
                                            $date = time();
                                            $datetime=strftime("%d-%m-%Y %H:%M:%S", $date);
                                            echo $datetime; ?>" ><br><br>
                                    <label for="scanned" class="col-sm-4 col-form-label">Transaction image:</label>
                                    <input type="file" name="scanned" class="form-control-plaintext" id="scanned"  ><br><br>
                                    
                                    <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <input class="btn btn-dark btn-small col-md-4 offset-md-4" type="submit" name="submitborrowed" value="borrow"><br><br> 
                                    </div>
                                    </div>
                                    <input type="hidden" name="categories" class="form-control-plaintext" id="Categories" value="<?php echo $category ?>" ><br>
                                               
                                </form>
                            </div>
                        </div>
                    </div>
                        <br>
                    