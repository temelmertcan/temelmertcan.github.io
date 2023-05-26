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

<ol>  <li>  All  combinations  from multiplier  generator  from  Homma/AOKI
Labotory.     The   benchmarks    used   to    be   obtained    here:   <a
href="https://www.ecsis.riec.tohoku.ac.jp/views/amg-e">https://www.ecsis.riec.tohoku.ac.jp/views/amg-e</a>.
However, it seems  this website is taken down now.   For 64x64, we gathered
all the possible  combinations when running our  experiments, which amounts
to 192 different design samples.</li>

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
to stress-test our tool. Other tools do not support these configurations.</p>

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
<code>Merged_WT_SB4_KS_32x32_noX_multgen.sv</code>      with      top      module      name:
<code>Merged_WT_SB4_KS_32x32_noX</code></p>

<p> The  <tt>noX</tt> suffix indicate  that the  design is free  of Verilog
don't-care (X)  values. Our tool  can handle these  cases but it  seems the
yosys-abc route to generate the AIGs for  other tools do not support Xes in
the design,  so the program outputs  a design that specifically  excludes X
values. This is  a subtle hardware verification problem that  does not seem
to be addressed frequently in publications. </p>

</li>

</ol>


<h4> Running RevSCA2</h4>

<ol>

<li> First  step is to  create AIGs from  Verilog designs. There  are various
ways to do this. We used yosys and abc because they are easier to call from
shell when running hundreds or thousands of experiments. This was also the route that was suggested to us.

<p> Below  are  the commands we used  to  parse  combinational Verilog  designs  and
   convert them to AIGs:</p>

<code>yosys Merged_WT_SB4_KS_32x32_noX_multgen.sv -p "hierarchy -top Merged_WT_SB4_KS_32x32_noX" -p proc -p techmap -p flatten -o tmp2.blif</code>
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

<li>For some multipliers (e.g., Merged_WT_SB4_KS_32x32_noX), revsca2 claimed them to
be buggy, and printed:
<code>
"The multiplier is buggy! <br>
Remainder:[1;37m-92233...."</code>

<p>This seems to be a false-negative as Amulet and VeSCmul could prove this
multiplier correct.  For other similar  configurations, revsca said some of
them to  be correct and some  to be buggy,  where all of them  are actually
proved to be correct.</p>

</li>

<li> To run  the 1000+ experiments given  in the paper, I  created a python
script  to  run  all of  them  and  collect  the  results in  a  systematic
manner. </li>

</ul>

<h4> Running AMulet2 </h4>

<ol>

  
<li> Followed the same steps when running Revsca to create AIGs from Verilog:

<code>yosys Merged_WT_SB4_KS_32x32_noX_multgen.sv -p "hierarchy -top Merged_WT_SB4_KS_32x32_noX" -p proc -p techmap -p flatten -o tmp2.blif</code>
<code>abc </code>
<code2>  read "tmp2.blif" </code2> 
<code2>  strash</code2>
<code2>  write "origdesign.aig" </code2>
  
  <p>These commands will create an AIG file named origdesign.aig.</p>
  </li>

<li> Pull AMulet2 from <a target=_blank href="https://github.com/d-kfmnn/amulet2">https://github.com/d-kfmnn/amulet2</a>.</li>


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
  
  <li> Amulet2  sometimes returned  1, which usually  indicate an  error in
    unix, but apparently this program does  not actually mean an error. For
    example, in the substitute stage, it looks  like returning 0 vs 1 is to
    indicate that the program made a change in the AIG.</li>
  
  <li> Certificates seem  to occupy a large  space in disk. I  did not save
    the exact  numbers but as multipliers  grow, I was running  out of disk
    space  (allocated 200GB). </li>
  
  <li>Some  problem in  Amulet2  seems to  be causing  timeout  in a  large
    majority of the benchmarks I tried. It looks like amulet2 is working ok
    for Homma designs  (#1 multiplier generator above) but  not others. The
    proofs  were  running  for  a  very  long  time  even  for  simple  8x8
    multipliers. This is  observed in April 2023. I  notified the owner
    of the amulet2 repo  of the problem. Because of this,  I ended up using
    Amulet1 when I collected proof-time results.</li>

</ul>


<h4> Running AMulet1 </h4>

Very similar to the commands for amulet2. Details are to be added.


</div>
      
<?php
 include 'foot.php';
 ?>
