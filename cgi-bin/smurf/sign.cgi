#!/usr/local/bin/perl -w
# Purpose: Perl-CGI web interface for testing
# A simple web interface.
# File: sign.cgi
# Usage: http://natalief-lx:8080/cgi-bin/sign.cgi
# Author: Fayaz Seifuddin
# Sources of Code: Orginally created by Fayaz Seifuddin
# Date Created: 07/16/07
# Last Date Modified: 07/16/07
# cookie-set.cgi - set a cookie

use warnings;
use strict;
use CGI;
use CGI qw(:standard);
use CGI::Carp  qw/fatalsToBrowser/;
use DBI;
use HTML::Template;
use CGI::Cookie;

my $q = new CGI;

my $redir = '/smurf/upload.php';
my $redir1 = '/smurf/runsmurf.php';

#my $username = 'fseifudd';
#my $password = '#########';
#my $database = 'smurf';
#my $hostname = 'mysql.tigr.org';

my $username = 'smurf_rw';
my $password = '#################';
my $database = 'smurf';
my $hostname = 'mysql51-dmz-pro';

my $dbh = DBI->connect("DBI:mysql:host=$hostname;db=$database", $username, $password, {RaiseError => 1, PrintError => 1});

my $email = $q->param('email');

my $sth = $dbh->prepare("SELECT emailid, affiliation FROM smurfusers where emailid=?");

$sth -> execute($email) || die "Could not execute SQL statement ... check emailid ... record may not exist?";;

my @row = $sth->fetchrow_array;

if(@row){
    my $to_set = $q->cookie(-name  => "smurfs",-value => $row[0],-expires=>"+4M");
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
