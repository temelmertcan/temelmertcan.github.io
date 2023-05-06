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

   
<h3> MULTIPLIER EXPERIMENT NOTES 2023</h3>

I collected my notes about gathering benchmarks and running tools for multiplier verification.

<h4> Gathering Benchmarks </h4>

Here is the list of generators we used when generating the designs given in
the paper:

<ol>
<li> All combinations  from multiplier generator from  Homma Labotory.  The
benchmarks         used        to         be        generated         here:
<a href="https://www.ecsis.riec.tohoku.ac.jp/views/amg-e">https://www.ecsis.riec.tohoku.ac.jp/views/amg-e</a>.
However, it seems  this website is taken down now.   For 64x64, we gathered
all the possible combinations when  running our experiments, which amounts to
192 different design samples.</li>

<li>A     small    set     of    benchmarks    are     generated    from
  <a href="https://github.com/amahzoon/genmul">https://github.com/amahzoon/genmul</a>. This
generator  does  not  have  Booth  encoding, and  it  was  very  slow  when
generating larger multipliers.</li>

<li> Finally,   a   large   set   of   multiplier   are   generated   using
 <a href="https://github.com/temelmertcan/multgen">https://github.com/temelmertcan/multgen</a>.
For isolated nxn-bit multipliers, we have all the possible combinations for
all sizes  up to  256x256-bit multipliers.   This generator  supports Booth
radix-2/4/8/16.  This generator also creates dot-product, multiply-add, and
truncated and/or shifted multipliers.

<p>  We  used   a  python  script  to  also  create   over  10000  randomly
parameterized benchmarks  from this generator. These  include multiply-add,
dot-product, truncation, shifting, and random  operand sizes. We used these
to stress-test our tool.</p>

<p>
As an example, below are the commands to generate an example testbench:

<code>
  git clone https://github.com/temelmertcan/multgen tem-multgen
</code>
<code>
  cd tem-multgen
</code>
<code>make</code>
<code>
./multgen -type FourMult -tree WT -pp SB4 -adder KS -in1size 32 -in2size 32
</code>
This  will  generate  a  32x32-bit multiplier  with  signed  Booth  radix-4
encoding with Wallace tree and Kogge-Stone  adder. Name of the output file is
<code>Merged_WT_SB4_KS_32x32_multgen.sv</code>      with      top      module      name:
<code>Merged_WT_SB4_KS_32x32</code></p>

</li>

</ol>

<h4> Running our tool (S-C-Rewriting)</h4>

<ol>
  <li>
    Running our tool  requires ACL2 installation from the  master branch of
its public repository, Our multiplier  rewriter library is included in this
ACL2  distribution. <code>  git clone  https://github.com/acl2/acl2 </code>
And                   follow                    the                   steps
from <a href="https://www.cs.utexas.edu/users/moore/acl2/v8-5/HTML/installation/installation.html">
here</a>.   You NEED  to get  ACL2 from  github master,  and not  a release
model, unless you are reading this far  in the future (from April 2023). We
used SBCL 2.2.9 to  build ACL2.  CCL works well too in  Intel Mac and Linux
machines but tend to be slower than SBCL. There are some problems
with SBCL's later versions (as of April 2023).  </li>

  <li> To make sure ACL2 is built properly and books are certified, run the following:
    <code> $ACL2DIR/books/build/cert.pl $ACL2DIR/books/projects/rp-rewriter/lib/mult3/demo/*.lisp -j 3</code> where $ACL2DIR points to your ACL2 installation directory (aka where you cloned it).
  </li>

  <li> Start ACL2 in the directory where the multiplier file is located: <code> $ACL2DIR/saved_acl2 </code> </li>

  <li> Submit these events to parse the Verilog file (including books in a new ACL2 session may take around a minute):
    <code> (include-book "projects/rp-rewriter/lib/mult3/parse-design" :dir :system) </code>
    <code> (in-package "RP") ;; switch package/namespace </code>
  </li>
  <li> Parse the design and create svtv for it:
    <code> (parse-and-create-svtv :file "Merged_WT_SB4_KS_32x32_multgen.sv" :topmodule "Merged_WT_SB4_KS_32x32") </code>
  </li>

  <li> State the correctness conjecture to verify:

    <code2>(defthmrp-multiplier multiplier-correct
  (implies (merged_wt_sb4_ks_32x32-autohyps)
           (b* (((sv::assocs result) ;;  should correspond to output signal name
                 (sv::svtv-run (merged_wt_sb4_ks_32x32)
                               (merged_wt_sb4_ks_32x32-autoins))))
             (equal result 
                    (loghead 64 (* (logext 32 IN1) 
                                   (logext 32 IN2))))))) </code2>
    This event should finish quickly. 
  </li>
  
</ol>

Some notes:

<ul>
  <li> Any variables referred to in this conjecture should correspond to signal names in the original design (e.g., result, IN1, IN2).</li>
  <li> We measure the time spent in this defthmrp-multiplier event. </li>
  <li> Some heuristics may be disabled or enabled to make the proofs go faster. For example submitting below events before proofs can make the proofs go faster: <code> (enable-merge-fa-chains t) </code><code>(enable-aggressive-find-adders-in-svex nil)</code> Also, algebraic term rewriting limit may need to be increased for large Booth encodings --see the documentation <a href="https://www.cs.utexas.edu/users/moore/acl2/manuals/current/manual/?topic=RP____MULTIPLIER-VERIFICATION-HEURISTICS">page</a> for our modifiable heuristics</li> 
  <li> logext means sign-extend, replacing that with loghead will make it zero-extend. </li>
  <li> As we run experiments on thousands of different designs, we used python and ACL2 scripts to automate the process and collect the results.</li>
  <li> Memory allocation goes up for very large multipliers (e.g., 1024x1024). This will likely require increasing allowed stack size and memory of ACL2. That usually means modifying the ACL2 executable ($ACL2DIR/saved_acl2). What the modifications should be depends on your system.</li>
  <li> ACL2 images might be saved to disk to save time when including books. See the doc page <a href="https://www.cs.utexas.edu/users/moore/acl2/manuals/current/manual/index-seo.php/ACL2____SAVE-EXEC">here</a>. This will eradicate include book time if you end up restarting ACL2 a lot.
    </li>
</ul>

<h4> Running RevSCA2</h4>

<ol>

<li> First  step is to  create AIGs from  Verilog designs. There  are various
ways to do this. We used yosys and abc because they are easier to call from
shell when running hundreds or thousands of experiments.

<p> Below  are  the commands we used  to  parse  combinational Verilog  designs  and
   convert them to AIGs:</p>

<code>yosys Merged_WT_SB4_KS_32x32_multgen.sv -p "hierarchy -top Merged_WT_SB4_KS_32x32" -p proc -p techmap -p flatten -o tmp2.blif</code>
<code>abc </code>
<code2>  read "tmp2.blif" </code2> 
<code2>  strash</code2>
<code2>  write "origdesign.aig" </code2>
  
  <p>These commands will create an AIG file named origdesign.aig.</p>
  </li>


<li>       We       pull      revsca      from      this       git      repo:
<a href="https://github.com/amahzoon/RevSCA-2.0">https://github.com/amahzoon/RevSCA-2.0</a>. It
appears that the source code is  not available and only an executable (that
runs on Linux) is given.</li>

<li>Then we run revsca2 as follows:</li>

<code>./revsca2 origdesign.aig revsca.out -s</code>

</ol>

<p> Some notes and observations: </p>

<ul>

  <li>We measure the time consumed only when revsca is running  for proof-time averages
    and not Verilog processing times.</li>

<li>For some multipliers (e.g., Merged_WT_SB4_KS_32x32), revsca2 claimed them to
be buggy, and printed:
<code>
"The multiplier is buggy! <br>
Remainder:[1;37m-92233...."</code>

<p>This is a  false-negative as we can prove this  multiplier to be correct
using our provably correct tool.   For other similar configurations, revsca
said some of them to be correct and some to be buggy, where all of them are
actually proved to be correct.</p>

</li>

<li> To run  the 1000+ experiments given  in the paper, I  created a python
script  to  run  all of  them  and  collect  the  results in  a  systematic
manner. </li>

</ul>

<h4> Running AMulet2 </h4>

<ol>

  
<li> Followed the same steps when running Revsca to create AIGs from Verilog:

<code>yosys Merged_WT_SB4_KS_32x32_multgen.sv -p "hierarchy -top Merged_WT_SB4_KS_32x32" -p proc -p techmap -p flatten -o tmp2.blif</code>
<code>abc </code>
<code2>  read "tmp2.blif" </code2> 
<code2>  strash</code2>
<code2>  write "origdesign.aig" </code2>
  
  <p>These commands will create an AIG file named origdesign.aig.</p>
  </li>

<li> We pull AMulet2 from <a href="https://github.com/d-kfmnn/amulet2">https://github.com/d-kfmnn/amulet2</a>.</li>


<li>Amulet2 requires other tools to be installed for the complete verification flow. These are:
  <ul> 
    <li>libgmp (https://gmplib.org/) to build amulet2</li>
    <li>Cadical SAT solver to check equivalence after adder substitution. (we used version 1.2.1)</li>
    <li>DRAT-trim to check the proof done by Cadical</li>
    <li>Pacheck2 to check the correctness of proof run by amulet2 (https://github.com/d-kfmnn/pacheck2)</li>
  </ul>
</li>


<li> After building all the tools, below commands are used to verify multipliers and check the proof certificates:

<code>src/amulet2/amulet -substitute origdesign.aig out2.cnf out2.aig</code>
<code>src/cadical/build/cadical out2.cnf out2.proof</code>
<code>src/amulet2/amulet -certify out2.aig out2.polys out2.pac out2.spec -signed</code>
<code>src/drat-trim/drat-trim out2.cnf out2.proof</code>
<code>src/pacheck2/pacheck out2.polys out2.pac out2.spec</code>

</li>

</ol>

<p> Some notes and observations: </p>

<ul>

  <li>We  measured  the  total  time  from  these  events  excluding  Verilog
    processing times.</li>
  
  <li> Amulet2 sometimes  returned 1, which usually indicate an  error in a
    program,  but  apparently  this  program  does  not  actually  mean  an
    error. For example, in the substitute  stage, it looks like returning 0
    vs 1 is to indicate that the program made a change in the AIG.</li>
  
  <li> Certificates seem  to occupy a large  space in disk. I  did not save
    the exact  numbers but as multipliers  grow, I was running  out of disk
    space  (allocated 200GB).  So I  ended  up having  to skip  certificate
    generation and just verify without any check.</li>
  
  <li>Some  problem in  Amulet2  seems to  be causing  timeout  in a  large
    majority of the benchmarks I tried. It looks like amulet2 is working ok
    for Homma designs  (#1 multiplier generator above) but  not others. The
    proofs  were  running  for  a  very  long  time  even  for  simple  8x8
    multipliers. This is  observed in April 2023. I  notified the owner
    of the amulet2 repo  of the problem. Because of this,  I ended up using
    Amulet1 when I collected proof-time results.</li>

</ul>


<h4> Running AMulet1 </h4>

Similar to amulet2. Details are to be added.


</div>
      
<?php
 include 'foot.php';
 ?>
