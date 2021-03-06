<?php
  require_once('/usr/local/common/web'.$_SERVER['WEBTIER'].'/templates/class.template.php');
  require_once('scripts/php/config.php');
  
  $template = new template();

  $side_menu[(!isset($_COOKIE['smurfs']) ? 3 : 4)]['class'] = 'no_sub side_active';
  
  $content = '
    <p><a href = "#FASTA">How do I get non-redundant protein sequences in the FASTA format for my species?</a></p>
    <p><a href = "#COORDINATES">How do I get gene coordinates for my species?</a></p>
    <p><a href = "#FASTA_2">How do I get protein sequences for my species, if unavailable from NCBI?</a></p>
    <p><a href = "#COORDINATES2">How do I get gene coordinates for my species, if unavailable from NCBI?</a></p>
    <p><a href = "#RunSMURF">Can I run SMURF on just one assembly (supercontig)?</a></p>
    <p><a href = "#COORDINATES3">Which gene coordinates are needed to Run SMURF?</a></p>

    <p><a name = "FASTA"><b>How do I get non-redundant protein sequences in the FASTA format for my species?</b></a><a name = "FASTA"></a></p>
    <p>Go to NCBI <a href="http://www.ncbi.nlm.nih.gov/">NCBI</a> RefSeq, choose "Protein" from the pull-down menu and type your query like so: <b>Aspergillus fumigatus[orgn] AND srcdb refseq[properties].</b> Alternatively you can go to the <a href="http://www.ncbi.nlm.nih.gov/projects/WGS/WGSprojectlist.cgi">WGS project list</a> page, click on your species name and then on the Protein link in the Entrez records table.</p>
						
    <p><a name = "COORDINATES"><b>How do I get gene coordinates for my species?</b></a><a name = "COORDINATES"></a></p>
    <p>From the <a href="http://ncbi.nlm.nih.gov">NCBI</a> ftp site:</p>
    <p>ftp.ncbi.nih.gov/gene/DATA/ASN_BINARY/Fungi/All_Fungi.ags.gz</p>
    <p>Get the gene2xml tool from:</p>
    <p>ftp.ncbi.nih.gov/toolbox/ncbi_tools/cmdline/</p>
	
    <p>and convert the file to xml and parse it instead. You may need to check the taxid fields to make sure you are getting the fields for the correct organism.</p>
    <p>prefix ./ before the executable name to force shell to look in the current directory:</p>
    <p>./gene2xml</p>
    <p>This should print out a set of switches to the screen.</p>

    <p>The requirements for SMURF gene coordinates are outlined below in:</p>
    <p><a href = "#COORDINATES3"><em>Which gene coordinates are needed to Run SMURF?</em></a></p>

    <p><a name = "FASTA_2"><b>How do I get protein sequences for my species, if unavailable from NCBI?</b></a></p>
    <p>See <a href="links.php">Links </a> for the list of sequencing centers.</p>
			
    <p><a name = "COORDINATES2"></a><b>How do I get gene coordinates for my species, if unavailable from NCBI?</b><a name = "COORDINATES2"></a></p>
    <p>See <a href="links.php">Links </a> for the list of sequencing centers and download the gene information in a GFF-formatted file which maps the coordinates to the largest chunk-the supercontig.</p>

    <p>The requirements for SMURF gene coordinates are outlined below in:</p>
    <p><a href = "#COORDINATES3"><em>Which gene coordinates are needed to Run SMURF?</em></a></p>

    <p><a name = "RunSMURF"><b>Can I run SMURF on just one assembly (supercontig)?</b></a><a name = "RunSMURF"></a></p>
    <p>Yes you can, as long as you have proteins sequences and gene coordinates. SMURF does not require a completely sequenced genome.</p>

    <p><a name = "COORDINATES3"><b>Which gene coordinates are needed to Run SMURF?</b></a></p>
    <ul>
      <li>protein ID: unique gene ID assigned to your gene set. Make sure that the gene ID in your gene coordinate file matches your gene ID in the protein FASTA file.</li>
      <li>chromosome: contig/chromosome ID on which your genes are located.</li>
      <li>5\' gene start: starting position of your genes (5\' end).</li>
      <li>3\' gene end: ending position of your genes (3\' end).</li>
      <li>protein name/function/definition: any functional information you want to include.</li>
    </ul>
    <p>Please make sure that your gene coordinate file is in this order and use \'tab\' as the separator between columns i.e. \'tab delimited gene coordinate file.\'</p>';
  
  $breadcrumb = array(
    array(
      'link' => 'faq.php',
      'name' => 'FAQ',
    ),
  );
  
  $template->assign('title', $title.'FAQ');
  $template->assign('top_menu', $top_menu);
  $template->assign('side_menu', $side_menu);
  $template->assign('page_header', 'Frequently asked questions');
  $template->assign('home_page', $home_page);  
  $template->assign('project_name', $project_name);
  $template->assign('main_content', $content);
  $template->assign('right_content', $right_content);
  $template->assign('site', 'SMURF');
  $template->assign('section_header', $section_header);
  $template->assign('breadcrumb', $breadcrumb);
  
  $template->display('3_column_fixed_width.tpl');
?>
