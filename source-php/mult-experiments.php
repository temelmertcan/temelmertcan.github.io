<?php
include 'head.php';

?>

<script>
  updatenav("publications");
</script>


  
  
<style>
  
  .artifact {
  min-width: 530px;
  max-width: 800px;
  font-family:Menlo;
  font-size:14px;
  margin : 0 10px 0 0;
  text-align: justify;
  }
  
 
  tab { margin-left: 40px; }
</style>

  <script>
    document.getElementsByClassName("content")[0].style.backgroundColor = "white";

    window.document.title = "Mertcan Temel - Artifact for Automated and Scalable Verification of Integer Multipliers";
    </script>

  <div class="artifact">

    <h3>Artifact for Automated and Scalable Verification of Integer
    Multipliers by M. Temel, A. Slobodova and W. Hunt
    </h3>
    

    <p>
      This page serves as a guidance to reproduce the experiment
      results and test our tool for new inputs as described in our
      paper "Automated and Scalable Verification of Integer
      Multipliers" by Mertcan Temel, Anna Slobodova, Warren A. Hunt,
      Jr. to be published in CAV
      2020 and a follow-up work published in FMCAD21. In these papers, we present
      a new method to verify various integer multipliers
      efficiently. We implemented and tested our method using the ACL2
      theorem prover. We ran experiments on various multipliers
      including Wallace-tree like multipliers with Booth encoding with
      sizes up to 1024x1024. 
    </p>
    
     <p> Please use this link to download benchmarks: <a                    target="_blank"
      href="https://www.icloud.com/iclouddrive/0c3nLLIeJBAdHImn0pXUQq8cQ#multiplier-experiments-sep2022">[Download
      Here]</a>. This file includes README to guide you through the installation and execution steps. </p>
      
   <p><a href="contact.php">Please Visit the "Contacts" Page for any questions</a></p>
</div>
      
<?php
 include 'foot.php';
 ?>
