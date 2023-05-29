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
      for  the VeSCmul  tool (<i>Verified  implementation of  S-C-Rewriting
      algorithm  for multiplier  verification</i>). VeSCmul  is a  verified
      program that can automaticaly and very quickly verify various integer
      multiplier-based  designs.   For  further  details,  please  see  the
      Publications page and view related papers.  </p>



<p> <b>Experiment notes</b>. I kept notes when I ran multiplier verification
experiments particularly for other  state-of-the-art tools. See those notes
<a href="mult-experiment-notes-2023.php">here</a>.</p>

<p>  <b>  VeSCmul  source  code  </b>   is  distributed  with  ACL2  on  <a
target=_blank
href="https://github.com/acl2/acl2/tree/master/books/projects/rp-rewriter/lib/mult3">github</a>. The
most recent  version can  be obtained  from the master  branch. A  short <a
target=_blank
href="https://www.cs.utexas.edu/users/moore/acl2/manuals/current/manual/?topic=RP____MULTIPLIER-VERIFICATION">
documentation</a>  for the library  is also  present in the  public ACL2
documentation pages.  </p>

<p> <b> To run VeSCmul Experiments (updated 2023)</b>, please use this link to
download  benchmarks  and scripts  to  rerun  experiments for  VeSCmul:  <a
target=_blank
href="https://www.icloud.com/iclouddrive/001i3Rv4zuU4r7YMudQlscQ0Q#vescmul-experiments-2023">[Download
Here  (~80 MB)]</a>.   This package  includes a  README file  to guide  you
through the installation and execution steps.  </p>



     <p>  <b> Older experiments  from FMCAD  2021</b>.  Please use  this link  to
 download benchmarks as seen in the FMCAD21 publication: <a target="_blank"
 href="https://www.icloud.com/iclouddrive/078NOvy0SsvRaQ6e9YizJIP-w#multiplier-experiments-sep2022_2">[Download
 Here]</a>. This  package includes a README  file to guide you  through the
 installation and execution steps. Note that this package is not maintained
 anymore and you are recommended to use the updated package above.</p>


<br />
   <p><a href="contact.php">Please Visit the "Contacts" Page for any questions/problems</a></p>
</div>
      
<?php
 include 'foot.php';
 ?>
