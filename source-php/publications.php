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

<h3> 2022 </h3>

<ul>
  <li>Mertcan Temel "Verified Implementation of an Efficient Term-Rewriting Algorithm for
    Multiplier Verification on ACL2". Proceedings Seventeenth International Workshop on the ACL2 Theorem Prover and its Applications, EPTCS, 2022
    <br>
    <ul>
       <li><a href="javascript:showhide('abstract2022')">Abstract</a>
	<div id="abstract2022" style="visibility:hidden;height:0px;">
Automatic and efficient verification of multiplier designs, especially through a provably correct method, is a difficult problem. We show how to utilize a theorem prover, ACL2, to implement an efficient rewriting algorithm for multiplier design verification. Through a basic understanding of the features and data structures of ACL2, we created a verified program that can automatically verify various multiplier designs much faster than the other state-of-the-art tools. Additionally, users of our system have the flexibility to change the specification for the target design to verify variations of multipliers. We discuss the challenges we tackled during the development of this program as well as key implementation details for efficiency and verifiability. Those who plan to implement an efficient program on a theorem prover or those who wish to implement our multiplier verification methodology on a different system may benefit from the discussions in this paper.
      </div></li>
      <li><a target="_blank" href="https://doi.org/10.4204/EPTCS.359.11">Paper</a></li>
      <li><a href="javascript:showhide('bibtexacl222')">Bibtex</a>
	<div id="bibtexacl222" style="visibility:hidden;height:0px;">
	  @inproceedings{TemelACL2-2022,
	  author       = {Mertcan Temel},
	  editor       = {Rob Sumners and Cuong Chau},
	  title        = {Verified Implementation of an Efficient Term-Rewriting Algorithm for
	  Multiplier Verification on {ACL2}},
	  booktitle    = {Proceedings Seventeenth International Workshop on the {ACL2} Theorem
	  Prover and its Applications, Austin, Texas, USA, 26th-27th May 2022},
	  series       = {{EPTCS}},
	  volume       = {359},
	  pages        = {116--133},
	  year         = {2022},
	  url          = {https://doi.org/10.4204/EPTCS.359.11},
	  doi          = {10.4204/EPTCS.359.11},
	  timestamp    = {Tue, 05 Jul 2022 12:50:48 +0200}
	  }
      </div></li>
    </ul>
  </li>
</ul>
<h3> 2021 </h3>

<ul>
  <li>Mertcan Temel, Warren A. Hunt "Sound and Automated Verification of Real-World RTL Multipliers". Formal Methods in Computer Aided Design 2021 (FMCAD21), 8 pages, IEEE 2021.
    <br>
    <ul>
       <li><a href="javascript:showhide('abstract2021')">Abstract</a>
	<div id="abstract2021" style="visibility:hidden;height:0px;">
We have developed an algorithm, S-C-Rewriting, that can automatically and very efficiently verify arithmetic modules with embedded multipliers. These include ALUs, dot- product, multiply-accumulate designs that may use Booth en- coding, Wallace-trees, and various vector adders. Outputs of the target multiplier designs might be truncated, right-shifted, or a combination of both. We evaluate the performance of other state-of-the-art tools on verification problems beyond isolated multipliers and we show that our method applies to a broader range of design techniques encountered in real-world modules. Our verification software is verified using the ACL2 theorem prover, and we can soundly verify 1024x1024-bit isolated mul- tipliers and similarly large dot-product designs in minutes. We can also generate counterexamples in case of a design bug. Our tool and benchmarks are available online.
      </div></li>
      
      <li><a target="_blank" href="https://doi.org/10.34727/2021/isbn.978-3-85448-046-4_13">Paper</a></li>
      <li> <a target="_blank" href="https://youtu.be/GfkpTLvoXf8">Talk (Video)</a> -
	<a target="_blank" href="https://fmcad.org/FMCAD21/slides/rtl-multipliers.pdf">Slides (PDF)</a> </li>
      
      <li><a href="mult-experiments.html"> Experiments</a></li>

     
      <li><a href="javascript:showhide('bibtexcav21')">Bibtex</a>
	<div id="bibtexcav21" style="visibility:hidden;height:0px;">
	  @inproceedings{TemelFmcad21,
	  author       = {Mertcan Temel and Warren A. Hunt},
	  title        = {Sound and Automated Verification of Real-World {RTL} Multipliers},
	  booktitle    = {Formal Methods in Computer Aided Design, {FMCAD} 2021, New Haven,
	  CT, USA, October 19-22, 2021},
	  pages        = {53--62},
	  publisher    = {{IEEE}},
	  year         = {2021},
	  url          = {https://doi.org/10.34727/2021/isbn.978-3-85448-046-4\_13},
	  doi          = {10.34727/2021/isbn.978-3-85448-046-4\_13},
	  timestamp    = {Tue, 07 Dec 2021 17:02:16 +0100}
	  }
      </div></li>
      
    </ul>
  </li>

 <br>

  <li>Mertcan Temel  "Automated, efficient, and sound verification of integer multipliers". University of Texas at Austin, 2021, Dissertation.
    <br>
    <ul>
       <li><a href="javascript:showhide('abstractdiss')">Abstract</a>
	<div id="abstractdiss" style="visibility:hidden;height:0px;">
Formal verification of multiplier designs has been studied for decades. However, the practicality of the state-of-the-art tools has been limited because they do not scale for large designs or they only support certain types of design methodologies. We have developed a new and widely applicable algorithm, S-C-Rewriting, for efficient and automatic verification of signed and unsigned arithmetic modules with embedded multipliers. The architectures of our target designs include Wallace, Dadda, 4-to-2 compressor trees, and more with Booth encoding and various types of final stage adders. The output of these multipliers may be truncated, right-shifted, or a combination of both, and they may be implemented as part of a multiply-accumulate, dot-product, or other arithmetic units with control logic. Our method and tool are verified using the ACL2 theorem prover, and users can trust the soundness of our verification results. Our experiments have shown that our approach scales well in terms of time and memory. We can soundly confirm the correctness of 1024x1024-bit isolated multiplier and similarly large dot-product designs within a few minutes. Additionally, we can quickly generate counterexamples for flawed designs. Our tool and benchmarks are available online for public use.
      </div></li>
      
      <li><a target="_blank" href="https://repositories.lib.utexas.edu/handle/2152/88056">Paper</a></li>
    
      <li><a href="javascript:showhide('bibtexdiss')">Bibtex</a>
	<div id="bibtexdiss" style="visibility:hidden;height:0px;">
@phdthesis{TemelDissertation,
    title    = {Automated, Efficient, and Sound Verification of Integer Multipliers},
    school   = {The University of Texas at Austin},
    author   = {Temel, Mertcan},
    year     = {2021}
}
      </div></li>
      
    </ul>
  </li>
</ul>


<h3> 2020 </h3>

<ul>
  <li>Mertcan Temel, Anna Slobodova, Warren A. Hunt "Automated and Scalable Verification of Integer Multipliers". Computer Aided Verification 2020 (CAV20), 20 pages, Springer 2020.
    <br>
    <ul>
       <li><a href="javascript:showhide('abstractcav2020')">Abstract</a>
	<div id="abstractcav2020" style="visibility:hidden;height:0px;">
The automatic formal verification of multiplier designs has been pursued since the introduction of BDDs. We present a new rewriter-based method for efficient and automatic verification of signed and unsigned integer multiplier designs. We have proved the soundness of this method using the ACL2 theorem prover, and we can verify integer multiplier designs with various architectures automatically, including Wallace, Dadda, and 4-to-2 compressor trees, designed with Booth encoding and various types of final stage adders. Our experiments have shown that our approach scales well in terms of time and memory. With our method, we can confirm the correctness of 1024×1024-bit multiplier designs within minutes.
      </div></li>
      
      <li><a target="_blank" href="https://link.springer.com/chapter/10.1007/978-3-030-53288-8_23">Paper</a></li>
      <li><a target="_blank" href="https://youtu.be/XcP5o-DrTNs">Preview (Video)</a> -
	<a target="_blank" href="https://youtu.be/Ucdrut__Z-w">Talk (Video)</a> -
	<a target="_blank" href="https://www.cs.utexas.edu/~mert/CAV20_62_slides.pdf">Slides (PDF)</a>
      </li>

      
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
      <li><a href="javascript:showhide('abstractacl22020')">Abstract</a>
	<div id="abstractacl22020" style="visibility:hidden;height:0px;">
RP-Rewriter (Retain-Property) is a verified clause processor that can use some of the existing ACL2 rewrite rules to prove conjectures through term rewriting. Optimized for conjectures that can expand into large terms, the rewriter tries to mimic some of the ACL2 rewriting heuristics but also adds some extra features. It can attach side-conditions to terms that help the rewriter retain properties about them and prevent possibly some very expensive backchaining. The rewriter supports user-defined complex meta rules that can return a special structure to prevent redundant rewriting. Additionally, it can store fast alists even when values are not quoted. RP-Rewriter is utilized for two applications, multiplier design proofs and SVEX simplification, which involve very large terms.
      </div></li>
      <li><a target="_blank" href="https://doi.org/10.4204/EPTCS.327.5">Paper</a></li>
      <li><a target="_blank" href="pdfs/temel-acl2-2020-slides.pdf">Slides</a></li>
      <li><a href="javascript:showhide('bibtexacl220')">Bibtex</a>
	<div id="bibtexacl220" style="visibility:hidden;height:0px;">
	  @inproceedings{TemelACL2-2020,
	  author       = {Mertcan Temel},
	  editor       = {Grant O. Passmore and
          Ruben Gamboa},
	  title        = {RP-Rewriter: An Optimized Rewriter for Large Terms in {ACL2}},
	  booktitle    = {Proceedings of the Sixteenth International Workshop on the {ACL2}
          Theorem Prover and its Applications, Worldwide, Planet Earth, May
          28-29, 2020},
	  series       = {{EPTCS}},
	  volume       = {327},
	  pages        = {61--74},
	  year         = {2020},
	  url          = {https://doi.org/10.4204/EPTCS.327.5},
	  doi          = {10.4204/EPTCS.327.5},
	  timestamp    = {Tue, 29 Dec 2020 18:21:25 +0100}
	  }
      </div></li>
      
    </ul>
  </li>
  <br>
</ul>

<?php
 include 'foot.php';
 ?>
