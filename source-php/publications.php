<?php
include 'head.php';

?>

<script>
  updatenav("publications");

  function show_bibtex (id){
  document.getElementById(id)
  }


  window.document.title = "Mertcan Temel - Publications";
  
</script>




<h3> 2020 </h3>

<ul>
  <li>Mertcan Temel, Anna Slobodova, Warren A. Hunt "Automated and Scalable Verification of Integer Multipliers". Computer Aided Verification 2020 (CAV20), 20 pages, Springer 2020.
        <br>
<ul>
    <li><a target="_blank" href="https://link.springer.com/chapter/10.1007/978-3-030-53288-8_23">Paper</a></li>
    <li><a target="_blank" href="https://youtu.be/XcP5o-DrTNs">Preview (Video)</a> -
    <a target="_blank" href="https://youtu.be/Ucdrut__Z-w">Talk (Video)</a> -
    <a target="_blank" href="https://www.cs.utexas.edu/~mert/CAV20_62_slides.pdf">Slides (PDF)</a>
</li>
 <li><a href="mult-experiments.php"> Experiments</a></li>

    <li><a href="javascript:showhide('bibtexcav20')">Bibtex</a>
    <div id="bibtexcav20" style="visibility:hidden;height:0px;">
@InProceedings{TemelCAV2020,
  author="Temel, Mertcan and Slobodova, Anna and Hunt, Warren A.",
  editor="Lahiri, Shuvendu K. and Wang, Chao",
  title="Automated and Scalable Verification of Integer Multipliers",
  booktitle="Computer Aided Verification",
  year="2020",
  publisher="Springer International Publishing",
  address="Cham",
  pages="485--507",
  isbn="978-3-030-53288-8",
  doi="10.1007/978-3-030-53288-8_23"
}
</div></li>


</ul>
  </li>
  
  <br>
  <li>Mertcan Temel  "RP-Rewriter: An Optimized Rewriter for Large Terms in ACL2".
     ACL2 Workshop 2020 (ACL2-2020), 13 pages, EPTCS 2020.
  <br>
  <ul>
    <li><a target="_blank" href="https://www.cs.utexas.edu/~mert/temel-acl2-2020-rp-rewriter.pdf">Preprint</a></li>
    <li><a target="_blank" href="https://www.cs.utexas.edu/~mert/rp_pres.pdf">Slides</a></li>
    <li><a href="javascript:showhide('bibtexacl220')">Bibtex</a>
    <div id="bibtexacl220" style="visibility:hidden;height:0px;">
@inproceedings{TemelRPRewriter,
 author    = {Mertcan Temel},
 title     = {{RP-Rewriter: An Optimized Rewriter for Large Terms in ACL2}},
 booktitle = {ACL2 2020},
 year      = {2020}
}
    </div></li>
    
  </ul>
  </li>
  <br>
</ul>

<?php
 include 'foot.php';
 ?>
