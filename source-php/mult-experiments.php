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

    <h2>Experiment notes and instructions to run VeSCmul for multiplier verification
    </h2>
    

    <p> This page serves as a  guidance to reproduce the experiment results
      for the VeSCmul  tool. VeSCmul is a verified program  that can automaticaly
      and  very quickly  verify various  integer multiplier-based  designs.
      For  further  details, please  see  the  Publications page  and  view
      related papers.  </p>


<h3> Rerun VeSCmul experiments (updated 2023) </h3>

<p> Please use this link to download benchmarks and scripts to rerun experiments for VeSCmul: <a target=_blank href="https://www.icloud.com/iclouddrive/001i3Rv4zuU4r7YMudQlscQ0Q#vescmul-experiments-2023">[Download
      Here]</a>.  This package includes a README file to guide you through the installation and execution steps.  </p>

<p> <b> VeSCmul source code </b> is distributed with ACL2 on <a target=_blank href="https://github.com/acl2/acl2/tree/master/books/projects/rp-rewriter/lib/mult3">github</a>. The most recent version can be obtained from the master branch. Note that this is a large and complex program.</p>

<p> <b>Experiment notes:</b> I kept notes as to how I ran multiplier verification experiments particularly for other state-of-the-art tools. See those notes <a href="mult-experiment-notes-2023.php">here</a>.


<h3> Experiments from FMCAD 2021 </h3>

     <p> Please use this link to download benchmarks as seen in the FMCAD21 publication: <a                    target="_blank"
      href="https://www.icloud.com/iclouddrive/078NOvy0SsvRaQ6e9YizJIP-w#multiplier-experiments-sep2022_2">[Download
      Here]</a>. This package includes a README file to guide you through the installation and execution steps. Note that this will not be maintained for long and you are recommended to use the updated package above.</p>
      
   <p><a href="contact.php">Please Visit the "Contacts" Page for any questions</a></p>
</div>
      
<?php
 include 'foot.php';
 ?>
