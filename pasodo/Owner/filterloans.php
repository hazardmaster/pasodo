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
                        <li><a href="index.php">DASHBOARD</a></li>
                        <li><a href="">TRANSACTIONS</a></li>
                        <li><a href="">SYSTEM USERS</a></li>
                        <li class="active"><a href="">FILTER LOANS</a></li>
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
                    <div class="row">
                        <div class="span col-sm-1 col-md-1" style="padding-left: 20px; ">
                            <span><img src="../img/filter-512.png" width="40px" height="40px"></span>
                        </div>
                        
                        <div class="startDate col-sm-11 col-md-5 filter-input">
                            <div class="input-group">
                                <span class="input-group-addon">From</span>
                                <input type="date" id="startDate" name="startDate" class="calendar calendarMedium fullWidth form-control hasDatepicker" value="2019-02-07" autocomplete="off">
                            </div>
                        </div>

                        <div class="endDate col-sm-12 col-md-5 filter-input"><div class="input-group"><span class="input-group-addon">To</span><input type="date" id="endDate" name="endDate" class="calendar calendarMedium fullWidth form-control hasDatepicker" value="2019-02-07" autocomplete="off"></div>
                        </div>
                    </div>
                     

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