<?php require_once("../include/sessions.php"); 
$conn = mysqli_connect("localhost", "root", "pasodomo_oscar", "pasodomo_pasodo"); 
include('../myHTML/simple_html_dom.php');
?>

<!DOCTYPE>
<html>
    <head>
        <title>Admin Back End</title>        
        <?php           
            echo file_get_html('../myHTML/myLinks.html');
             ?>     

            <style>
                * {
                  box-sizing: border-box;
                }

                /* Create four equal columns that floats next to each other */
                .column {
                    border-radius: 25px;
                  float: left;
                  width: 23%;
                  padding: 10px;
                  height: 150px; /* Should be removed. Only for demonstration */
                  text-align: center;
                }

                /* Clear floats after the columns */
                .row:after {
                  content: "";
                  display: table;
                  clear: both;
                }

                /* Responsive layout - makes the four columns stack on top of each other instead of next to each other */
                @media screen and (max-width: 600px) {
                  .column {
                    width: 100%;
                  }
                }
            </style>   
    </head>
    <body>
        <!--Top navigation bar -->
        <?php           
            echo file_get_html('../myHTML/navbar.html');
             ?>
        <!--The Body part -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <!--<h3 style="color:white">Super Admin!!!</h3>-->
                    <ul id="side_menu" class="nav nav-pills nav-stacked">
                        <li class="active"><a href="index.php">DASHBOARD</a></li>
                        <li><a href="">TRANSACTIONS</a></li>
                        <li><a href="">SYSTEM USERS</a></li>
                        <li><a href="filterloans.php">FILTER LOANS</a></li>
                        <li><a href="">TOP DAIRIES</a></li>
                    </ul>
                </div>
                <div class="col-sm-10">
                    <h1 style="color: red">STRICTLY AUTHENTICATED USER!!. SECURITY LEVEL 3</h1>
                    <div> <?php echo message(); 
                                echo SuccessMessage();
                        ?> 
                    </div>

                    <!--This section row shows major info of interest to the owner.-->
                    <section>
                        <div class="row">
                            <!--Column showing cash in Hand/ capital the owner has-->
                            <div class="column" style="background-color: grey; margin: 1%">
                                <h3 style="color: white">CAPITAL</h3>                              
                            </div>

                            <!--Column showing the total all time loan borrowed-->
                            <div class="column" style="background-color: grey; margin: 1%">
                                <h3 style="color: white">LOAN(TOTAL)</h3>  
                            </div>

                            <!--Column showing all time payments-->
                            <div class="column" style="background-color: grey; margin: 1%">                             
                                <h3 style="color: white">PAYMENTS(TOTAL)</h3>
                            </div>

                            <!--Column showing NET PROFIT. ALL TIME!!-->
                            <div class="column" style="background-color: grey; margin: 1%">
                                 <h3 style="color: white">NET PROFIT</h3>
                            </div>
                        </div> 
                    </section>
                     

                </div><!--ending of col 10-->
            </div><!-- Ending of row-->            

        </div><!-- ending of container-->

        <div id="footer" style="position: relative; bottom: 0; width: 1360px;">
            <hr><p>Brain Behind | Oscar Hazard | &copy;2018  --- All rights reserved</p>
            <a style="color:white; text-decoration: none; cursor:pointer; fontweight:bold;" href="/">Pasodo</a>
            <p>This site is only for use by PASODO finance group. All rights reseved. No one is allowed to make a copy of this site.</p>
        </div>
        <div style="height: 10px; background: #27AAE1;"></div>
    </body>

</html>