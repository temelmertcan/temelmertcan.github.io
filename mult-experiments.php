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
      2020 <a href="https://cs.utexas.edu/~mert/temel-cav2020.pdf"
      target="_blank"> [available here]</a>. In this paper, we present
      a new method to verify various integer multipliers
      efficiently. We implemented and tested our method using the ACL2
      theorem prover. We ran experiments on various multipliers
      including Wallace-tree like multipliers with Booth encoding with
      sizes up to 1024x1024. In the first section below, we list the
      steps to be taken in order to run the same experiments as given
      in the paper to reproduce the results. In the following section,
      we describe how users may verify some other integer multiplier
      circuits.
    </p>
    
    <h3>1. REPRODUCING THE RESULTS </h3>
    <h3>1.1 Running the benchmarks for our tool </h3>
    
    <p>  We  provide  a  zipped  VM image  in  OVA  format  generated  with
      VirtualBox.                     <a                    target="_blank"
      href="https://www.icloud.com/iclouddrive/0r7JWWviMtidOvLqLNFnjwjmw#CAV-mult-2">[Download
      Here ~8.4GB]</a>.  This is a  minimal Linux Debian image  without any
      GUI, and it has  all the tools and benchmarks included.  It is set up
      for anyone to rerun our experiments easily.</p>

    <p>We have tested this image on a Late 2014 model iMac 4 GHz
    Quad-Core Intel Core i7 with a 32 GB memory on OS X Catalina with
    VirtualBox 6.1. We set the memory of this image to be 24GB. Our
    experiments for very large circuits require a lot of memory. If
    you want to run the experiments for 512x512 or 1024x1024-bit
    multipliers, you should not reduce this memory limit and your host
    machine should have at least 32 GB of memory. If you do not have
    access to a system with this much memory, then you can reduce the
    memory of the image with respect to the available sources in your
    host machine, and still run some of the smaller experiments. The
    CPU speed does not need to be as high for any of the
    experiments.</p>

    <p>Below are the steps to reproduce our results:</p>

    <p><i>Step 1.</i> Load the provided VM image using Virtual Box, or a
      similar program of your preference. Upon booting the image, you
      should see a terminal prompting for login credentials. Username
      is "root" and the password is "mert" (without quotes). If you
      need to use multiple terminals, you can switch to a different
      one with alt+right or alt+left.</p>
    <code>
      debian login: root <br>
      Password: mert </code>

    <p><i>Step 2.</i> The home directory is /root/. Benchmarks and a Makefile
      are located under /root/benchmarks/. Type:</p>
    <code> cd benchmarks </code>

    <p><i>Step  3.</i>  ACL2  has  a mechanism  to  save  certificates  for
    finished proofs so  that the user wouldn't have to  run the same proofs
    again.  We  released  this  VM   image  with  proofs  already  run  and
    certificates saved.  You may  see the  timing results  from our  run in
    "results.txt"  (use "less  results.txt" to  view the  contents of  that
    file). See  Section 1.2  to interpret  the results.  In order  to clean
    those  certificates   and  run   the  experiments  again,   type  "make
    clean".</p>
    <code> make clean </code>

    <p><i>Step  4.</i> You  may  run  different make  commands  to run  the
    experiments. If you  want to run all the experiments  you may run "make
    all". If  you want to  run a specific size  of multipliers you  may run
    "make 64"  (for 64x64-bit multipliers),  "make 128", "make  256", "make
    512" or "make  1024". If you cannot run larger  multipliers, start from
    the smallest  and increase as  memory allows  (if memory runs  out, the
    program may  be terminated  by the  OS without  any warning).   All the
    experiments finished  in around  90 minutes on  our machine.  Note that
    there is a  constant overhead while starting ACL2,  therefore the total
    run  time  will be  greater  than  the total  accumulated  verification
    time.</p>

    <code> make all </code>
    <br>OR<br>
    <code> make 64 && make 128 <b> ... </b> </code>

    <p><i>Step 5.</i> The timing results  from these experiments are parsed
    using a python script that goes  through the certificate files and puts
    all  the  timing   results  in  "result.txt"  on   the  same  directory
    (/root/benchmarks/). See the Section 1.2 to interpret the results.</p>

    <code> less result.txt </code>

     <p>  "result.txt"  will   only  have  the  timing   results  for  each
    benchmark. If  you would  like to  see the  actual theorems  proved for
    these multipliers,  see the  discussion in Section  1.4.  Additionally,
    "result.txt" will  only have  results from  our tool.  We set  up other
    scripts to run the other tools from related work as given in Table 3 in
    our paper.  In  order to run those scripts, follow  the instructions in
    Section 1.5.</p>
    
    <p></p>
    
    <p><h3>1.2 Interpreting "result.txt" </h3></p>

    <p>When experiments finished running, the timing results for each
      multiplier correctness proofs are collected and saved in file
      "result.txt" under /root/benchmarks/. You may see the content of that
      file by typing "less result.txt".</p>

     <p> An example snippet from "result.txt":</p>

    <code2>
"64x64 - UNSIGNED - SCA SP-DT-BK" 
Time:  0.50 seconds (prove: 0.47, print: 0.00, other: 0.02)
      
"128x128 - UNSIGNED - TEM SP-DT-KS"
Time:  2.82 seconds (prove: 2.77, print: 0.00, other: 0.05)
    </code2>

    <p>If you ran all the experiments, you will see timing results for
    almost 100 different multiplier circuits. Note that there are more
    benchmarks here than we listed in our paper, so you may see some
    results that are not present in our paper.</p>

    <p>In result.txt, a descriptor line for  a benchmark is followed by its
      timing results.  An example descriptor  line: "64x64 - UNSIGNED - SCA
      BP-4:2-CLA". This  format and  abbreviations are the  same as  in our
      paper.  First part of the  descriptor is the multiplication size (can
      be 64x64  through 1024x1024), the  second is signed or  unsigned, the
      third is the  generator name (HOM, TEM,  or SCA) and the  last one is
      the  type of  multiplier  with the  same acronyms  as  listed in  the
      paper. The complete list of such acronyms is given as follows. </p>

    <p><i>Partial Product Encoding:</i></p>
    <ul>
      <li>BP =  Booth Encoding</li>
      <li>SP = Simple Partial Products</li>
    </ul>
    <p><i>Summation Tree:</i></p>
    <ul>
      <li>WT = Wallace Tree</li>
      <li>DT = Dadda Tree</li>
      <li>OS = Overturned Stairs Tree</li>
      <li>BDT = Balanced Delay Tree</li>
      <li>4:2 - 4:2 Compressor Tree</li>
      <li>CWT = Counter-based Wallace Tree</li>
      <li>AR = Array Multiplier (this is a regular shaped multiplier, not
      Wallace-tree like)</li>
    </ul>
    <p><i>Final Stage Adder:</i></p>
    <ul>
      <li>BK = Brent-Kung</li>
      <li>HC = Han-Carlson</li>
      <li>KS = Kogge-Stone</li>
      <li>LF = Ladner-Fischer</li>
      <li>RBCLA = Ripple-block Carry-look-ahead</li>
      <li>CLA = Carry Look-ahead</li>
      <li>CSKF = Carry skip adder with fixed block size</li>
      <li>RC or RP = Ripple-carry</li>
    </ul>
    <p>Note that the timing results we give in our paper are produced
    on a machine with 32 GB memory and Intel(R) Xeon(R) CPU E1270 @
    3.50GHz (a 2011 model). If you run these experiments with a more
    limited memory (say 24GB), the garbage collector will be deployed
    more frequently, and you may see slightly poorer results for some
    larger multipliers.</p>

    <p>If you  are going  to use  these benchmarks  for your  paper, please
       refer to  the generators' web  pages for more  information:
      <a href="https://www.ecsis.riec.tohoku.ac.jp/topics/amg/i-amg/request/multiplier"
      target="_blank">HOM</a>, 
      <a href="http://www.informatik.uni-bremen.de/agra/sca-verification/genmul.html"
      target="_blank">SCA</a>, 
    <a href="https://github.com/temelmertcan/multgen"
       target="_blank">TEM</a>.</p>

   

    <p><h3>1.3 Organization of Benchmarks </h3></p>

    <p>In this section, we describe how benchmarks are organized and
    how our Makefile runs and collects the results.</p>

    <p>There  are  three  sub-directories  for  each  multiplier  benchmark
    generator  under  /root/benchmark/.  These  are:  tem,  sca-genmul  and
    homma.  Each  of these  folders  have  three relevant  sub-directories:
      verilog-files, parsed-modules, and proofs2.</p>

    <ul>
      <li>tem/verilog-files/</li>
      <li>tem/parsed-modules/</li>
      <li>tem/proofs2/</li>
      <li>sca-genmul/verilog-files/</li>
      <li>sca-genmul/parsed-modules/</li>
      <li>sca-genmul/proofs2/</li>
      <li>homma/verilog-files/</li>
      <li>homma/parsed-modules/</li>
      <li>homma/proofs2/</li>
    </ul>
    
    <p>All the benchmarks in their originally generated forms (Verilog) are
      stored under /root/benchmark/&lt;generator-name&gt;/verilog-files/.</p>
    
    <p>We need to  convert these Verilog files to SVL  format (refer to the
      preliminaries in the paper) in order to reason about them in ACL2. This
      is         done         with         *.lisp         files         under
      /root/benchmark/&lt;generator-name&gt;/parsed-modules/.   Those  *.lisp
      files are ACL2 "books" that can be included by other books or during an
      interactive ACL2 session,  and they contain parsed and  SVL versions of
      each benchmark.  You may  view one  of those LISP  files by  going into
      those  directories  in  order  to  see  how  we  parsed  those  Verilog
      designs.</p>
    
    <p>The     ACL2    books     for    proofs     are    located     under
      /root/benchmark/&lt;generator-name&gt;/proofs2/.   Here you  will see
      various sets of  LISP files, each stating  (provable) conjectures for
      correctness of  the benchmarks.  Our  Makefile calls ACL2  to certify
      these  books,  and  calls  a  python script,  which  parses  all  the
      *.cert.out  files  under  these  directories to  collect  the  timing
      results for each multiplier proof  in a single file "result.txt". You
      may view these LISP files to see what is proved, but the theorems are
      generated automatically using a  macro.  Translating these macros may
      be  challenging for  users who  are  not familiar  with ACL2.   These
      macros  also  save  the  theorems  in  a  separate  file  in  a  more
      user-friendly  fashion.   See  Section   1.4  for  a   more  detailed
      discussion.</p>
    
    <p>Also  note that  we  use the  utility "cert.pl"  to  have ACL2  save
      certificates for  *.lisp.  Our  Makefile actually calls  "cert.pl" to
      save the  certificates for each  *.lisp book.   If you would  like to
      certify a book, you can type "cert.pl &lt;file-name&gt;".</p>
    

    <!-- <p><i>Step 1</i>. Start ACL2 by typing "acl2" on command prompt -->
    <!--   (without quotes)</p> -->
    <!-- <code> acl2 </code> -->

    <!-- <p>Step 2. Type (include-book "/root/benchmarks/tem/proofs2/set1") -->
    <!-- You may choose any other set you desire. This may take 20-30 -->
    <!-- seconds due to the overhead of including Verilog parsing -->
    <!--   books.</p> -->
    <!-- <code> (include-book "/root/benchmarks/tem/proofs2/set1") </code> -->

    <!-- <p>Step 3. Type (take 15 (ACL2::CURRENT-THEORY-FN :HERE (w -->
    <!-- state))) This will print the last 15 theorems proved in the ACL2 -->
    <!-- systems. Since the last thing you did was including our proofs -->
    <!-- book, you will see the names of the theorems we proved. You may -->
    <!--   adjust the number as desired.</p> -->
    <!-- <code> (take 15 (ACL2::CURRENT-THEORY-FN :HERE (w state))) </code> -->

    <!-- <p>Step 4. Select a proved theorem you want to see and type ":pe " -->
    <!-- followed by its name. For example, if you want to view the -->
    <!-- conjecture given with the rule name (:REWRITE -->
    <!-- DT_USP_KS_64_64_OF_*DT_USP_KS_64_64*_IS-CORRECT), you need type: -->
    <!-- :pe DT_USP_KS_64_64_OF_*DT_USP_KS_64_64*_IS-CORRECT This will show -->
    <!-- you the proved theorem. Note that this is only available for 64x64 -->
    <!-- multipliers because the cost of saving the proofs (in terms of -->
    <!-- disk space) increases with larger multipliers. If you would like -->
    <!-- to see the theorems for larger multipliers, find the relevant file -->
    <!-- under proofs2 directory, start ACL2 and load that file with (ld -->
    <!-- "&lt;file-name&gt;.lisp"). Then follow the same procedure as -->
    <!-- above.</p> -->
    <!-- <code> :pe DT_USP_KS_64_64_OF_*DT_USP_KS_64_64*_IS-CORRECT </code> -->
    
    
    <!-- <p>If you would like to look at the source files running these -->
    <!-- proofs, you may navigate to -->
    <!-- /root/acl2/books/projects/rp-rewriter/lib/mult2 and check the LISP -->
    <!-- files for implementation of our method. However, this is not -->
    <!-- recommended as we used very complex meta rules which involve many -->
    <!-- optimizations for improved performance, and it is not easy to -->
    <!-- follow the events unless you are a very experienced and patient -->
    <!--   ACL2 user.</p> -->

    <p><h3>1.4 Viewing the Statement of Actual Theorems  </h3></p>

    <p>  In this  section, we  describe  how users  may view  the statement  of
      theorems proved for multiplier designs. </p>
    
    <p> A static library we proved and use to verify multiplier designs are
      distributed  with  ACL2.   Users  may  view  the   LISP  files  under
      /root/acl2/books/projects/rp-rewriter/lib/mult2.  The events in these
      files  follow  the  rewriting   algorithm  described  in  our  paper.
      However, we implemented our rewriting  method using some complex meta
      rules. Therefore, the events in these  files may be very difficult to
      interpret for an inexperienced ACL2 user. </p>

    <p> During  our proofs, we  do not introduce  any axioms, and  we prove
      everything with the default configuration  of ACL2. The discussion of
      axioms  that  ACL2  is  built  upon are  given  in  the  source  file
      /root/benchmarks/acl2/axioms.lisp. The only part we have not verified
      is translation of  Verilog designs into SVL designs, which  is out of
      scope of our multiplier verification work. </p>

    <p>  When we  run a  proof for  a specific  design in  our benchmarking
    tests, a macro  automatically generates the conjectures  to prove. This
    macro also saves the statement of  these conjectures in a separate file
    when all the proofs are finished.  After you follow the instructions in
    Section 1.1 and run the make command, *.summary files will be generated
    and    saved   under    /root/benchmark/&lt;generator-name&gt;/proofs2/
    directory. For  example, if you run  "make" or "make 64",  you will see
    "64x64-proof.summary"  files for  each  generator. You  may view  these
    files to see the theorems proved  for each multiplier design. A snippet
      from such a file is given below. </p>

    <code2 style="white-space: pre-wrap; font-size:12px;">
--- Starting the proofs for 64x64 - SIGNED - SCA SP-DT-BK (SVL design: *64_64_S_SP_DT_BK*) ---

This lemma will prove the final stage adder module correct to replace it later with s and c functions.

(defthmrp bk_127_126_of_*64_64_s_sp_dt_bk*_is-correct
          (implies (and (integerp in1) (integerp in2))
                   (equal (svl::svl-run-phase-wog "BK_127_126" (list in1 in2)
                                                  '(nil nil)
                                                  *64_64_S_SP_DT_BK*)
                          (list (list (4vec-adder (svl::bits in1 0 127)
                                                  (svl::bits in2 0 126)
                                                  0 128))
                                (svl::make-svl-env))))
          :disable-meta-rules (s-c-spec-meta c-spec-meta s-spec-meta)
          :enable-rules *adder-rules*)

Below is the proof for the multiplier module.

(defthmrp |mult_64_64_of_*64_64_s_sp_dt_bk*_is-correct|
          (implies (and (integerp in1) (integerp in2))
                   (equal (svl::svl-run-phase-wog "Mult_64_64" (list in1 in2)
                                                  '(nil nil)
                                                  *64_64_S_SP_DT_BK*)
                          (list (list (loghead 128
                                                       (* (sign-ext in1 64)
                                                          (sign-ext in2 64))))
                                        (svl::make-svl-env)))))

Proofs for this multiplier module with its adder modules finished in -- 0.560 seconds --.
    </code2>

    <p> This snippet has some user-friendly comments and two events stating
    the conjectures to be proved specific  for a multiplier module (in this
    case, a  64x64 Dadda Tree  multiplier with simple partial  products and
    Brent-Kung final  stage adder). For  our method, we reason  about adder
    modules before the multiplier module, so  we first prove that the final
    stage adder  is equivalent to  our adder specification. Then,  we prove
    the multiplier design correct. The *.summary file also has the theorems
      for half/full-adder but we omit these here for brevity. </p>

    <p> This  snippet has more components  than described in our  paper (we
    had summarized it  for simplicity).  In this  snippet, "defthmrp" calls
    our  verified  clause  processor  that  is  designed  specifically  for
    conjectures  that  can  grow  into   very  large  terms  as  multiplier
    designs. The keyword  next to "defthmrp" is a unique  name, and will be
    the name of the theorem proved. "svl::svl-run-phase-wog" is a primitive
    function  that  "svl-run"  (described   in  our  paper)  calls.   Since
    multiplier designs are  combinational we call this  function instead of
    "svl-run" to  have a slightly  better performance. "4vec-adder"  is our
    specification  function for  vector-adder  functions, and  it is  later
    rewritten in terms of s and  c functions. "svl::bits" selects a portion
    of the  given vector. "loghead"  is equivalent to "truncate".  And, the
    other part this  snippet are fixed components that we  have for all the
      multiplier design proofs. </p>

    <p><h3>1.5 Running the Other Tools from Related Work  </h3></p>

    <p> In order to  compare the results on the same  platform, we also set
    up the tools  from related work (D.  Kaufmann et al. and  A. Mahzoon et
    al.)  on the given VM image. We used the same tools as given in Table 3
    in our paper. These tools are  stand-alone C programs, and they run for
    one multiplier design  at a time. We followed  the owners' instructions
    to  run  these tools,  and  we  created a  Python  script  to run  them
      consecutively for each multiplier design. </p>

    <p> To run  the experiments for D.Kaufmann et al.  or A.Mahzoon et al.,
      follow these steps: </p>

     <p><i>Step 1.</i> Navigate to the directory where the tools are located. </p>
    <code>
      cd /root/related-work/dk
    </code> <br> OR </br>
     <code>
      cd /root/related-work/am
     </code>
    <p><i>Step 2.</i> Run the python scripts. </p>
    <code>
      python3 test-dkaufmann.py
    </code> <br> OR </br>
     <code>
     python3 test-revsca.py
     </code>

     <p>  These  scripts will  run  these  tools  for  all the  designs  we
     use. They  will first convert the  Verilog designs to AIG  using yosys
     and abc (as described in the paper). Then it will run these tools with
     the  arguments and  configuration given  by the  owners. Then  it will
     print a summary with timing results (conversion from Verilog to AIG is
     not included.) A snippet of the output is given below. </p>

     <code2 style="white-space: pre-wrap;">
>>> python3 test-dkaufmann.py
       
2020-05-12 12:42:49.850782
reading ../mult-tests/sca-genmul/verilog-files/64_64_U_SP_DT_BK_GenMul.v
creating aig... 
2020-05-12 12:42:51.565806
Testing amulet for ../mult-tests/sca-genmul/verilog-files/64_64_U_SP_DT_BK_GenMul.v
Running cadical 
Running Certify 
remaining time  181
Running DRAT-trim 
Running Pactrim 
Remaining time in seconds before time-out: 177
2020-05-12 12:42:57.635104
Elapsed time = 6.07

2020-05-12 12:42:57.635184
reading ../mult-tests/sca-genmul/verilog-files/64_64_U_SP_WT_LF_GenMul.v
...
     </code2>

     <p> Users may change the time limit for time-out and/or the benchmarks
       for these tools by updating these Python scripts. </p>
    <code>
      vim test-dkaufmann.py
    </code> <br> OR </br>
     <code>
     vim test-revsca.py
     </code>
     <p>You will see the time-out value at the beginning of these files. Below
     that, you will see the list of multiplier designs that the script will
     run. If you want  to exclude some of them, you  can simply comment out
       their corresponding lines.</p>

     <p> We have observed that the tool  from D. Kaufmann et al. can have a
     varying  performance depending  on the  OS  it is  running on.   After
     submitting our  paper for final  version, we  realized that It  can be
     twice as slow  on a OSX as  compared to Debian.  In our  paper, we ran
     D. Kaufmann et al.  on OSX and  ran A. Mahzoon et al.  on Debian (they
     only released a Linux executable). If you are going to use this work in
     your paper(s), please refer to the owners' work. </p>
      
    
     <h3>2. USING THE TOOL FOR OTHER MULTIPLIER DESIGNS (NEW INPUT) </h3>
    
    <p>A demo and instructions to use our tool on new inputs are
      <a target="_blank"
	 href="http://www.cs.utexas.edu/users/moore/acl2/manuals/current/manual/?topic=RP____MULTIPLIER-PROOFS-2">available
	online</a>. The demo files from this link are also included in the
      provided VM image.</p>
    
    <p>If you would like to use our tool on your system without this
      VM image, you need to set up ACL2 8.3 or later. Follow the
      instructions <a target="_blank"
		      href="http://www.cs.utexas.edu/users/moore/acl2/v8-2/HTML/installation/installation.html">
	here</a>. Run a regression as the instructions suggests or certify
      the books you will include with cert.pl (located at
      &lt;your-acl2-directory&gt;/books/build/cert.pl). SBCL for the
      base LISP distribution is faster but CCL manages memory better,
      which can be essential for larger circuits.
    </p>
    
    <p>If you would like to use the provided VM image, you can start
      ACL2 by simply typing "acl2" (without quotes). If you plan to test
      a large multiplier (say 512x512), it is recommended to use
      "acl2-ccl" (and use set-max-mem as described in the demo web-site
      above), which is slower but manages memory better. We use this for
      512x512 and 1024x1024-bit multipliers.</p>
    
    <p>A demo is included in /root/demo/demo.lisp with a 64x64 Booth
      Encoded Wallace-tree multiplier. You may navigate to that
      directory and start ACL2 and load that file by typing (ld
      "demo.lisp"). Even though this multiplier is small (64x64),
      including the libraries for Verilog parsing takes a while, so this
      operation may take a minute. You can tweak this file by following
      the given instructions from the link above to verify some other
    multiplier circuits. You may exit ACL2 by typing (exit).</p>
    
    <p>If you plan to test some other circuits using the same
      generators as we have, you may simply copy/modify the existing
      files and add your circuit. Please refer to Section 1.3 to
      understand the organization of our benchmarks.</p>
    
    
    <h3>3. CONTACT </h3></p>

   <p><a href="contact.php">Visit the "Contacts" Page</a></p>
</div>
      
<?php
 include 'foot.php';
 ?>
