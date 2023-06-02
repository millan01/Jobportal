<?php 
require_once('./database/connection.php');

if(isset($_Get['job_id'])){
  header("location:companyprofile.php#postjob");
}
?>
