#!/usr/local/bin/perl -w
# Purpose: Perl-CGI web interface for testing
# A simple web interface.
# File: registration.cgi
# Usage: http://natalief-lx:8080/cgi-bin/registration.cgi
# Author: Fayaz Seifuddin
# Sources of Code: Orginally created by Fayaz Seifuddin
# Date Created: 07/11/07
# Last Date Modified: 07/11/07

use warnings;
use strict;
use CGI;
use CGI qw(:standard);
use CGI::Carp  qw/fatalsToBrowser/;
use DBI;
use HTML::Template;

my $q = new CGI;

my $redir = '/smurf/upload.php';
my $redir1 = '/smurf/runsmurf.php';

my $username = 'smurf_rw';
my $password = 'JAxZLH.mfCS6JrcQ8';
my $database = 'smurf';
my $hostname = 'mysql-dmz-pro';

my $dbh = DBI->connect("DBI:mysql:host=$hostname;db=$database", $username, $password, {RaiseError => 1, PrintError => 1});

my $sth = $dbh->prepare("INSERT INTO smurfusers(emailid, affiliation) VALUES (?,?)");

my $email = $q->param('email');
my $affiliation = $q->param('affiliation');

$sth -> execute($email,$affiliation) || die "Could not execute SQL statement ... check email and affiliation ... duplicate record may exist?";

if($sth){
  my $to_set = $q->cookie(-name  => "smurfs",-value => $email,-expires=>"+4M");
  print $q->header(-cookie=>$to_set);
  print_redirect($redir);
}
else{
  print_redirect($redir1); 
}

$dbh->disconnect;

exit;

sub print_redirect {
  my ($url) = @_;
  # get the redirector template
  my $tmpl = HTML::Template->new( filename => '../../htdocs/smurf/templates/redirect.tmpl',die_on_bad_params => 1);
  $tmpl->param( REDIR => $url );
  print $tmpl->output;
}
