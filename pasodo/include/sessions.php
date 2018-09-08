<?php
    session_start();
    function message(){
        if(isset($_SESSION["ErrorMessage"])){
            $output="<div class=\"alert alert-danger\">";
            $output.=($_SESSION["ErrorMessage"]);
            $output.="</div>";
            $_SESSION["ErrorMessage"]=null;
            return $output;
        }
    }
    function SuccessMessage(){
      if(isset($_SESSION["SuccessMessage"])){
                $output="<div class=\"alert alert-success\">";
                $output.=($_SESSION["SuccessMessage"]);
                $output.="</div>";
                $_SESSION["SuccessMessage"]=null;
                return $output;
            }
        }  
    function InfoMessage(){
      if(isset($_SESSION["InfoMessage"])){
                $output="<div class=\"alert alert-info\">";
                $output.=($_SESSION["InfoMessage"]);
                $output.="</div>";
                $_SESSION["InfoMessage"]=null;
                return $output;
            }
        }  
    
     
    ?>


