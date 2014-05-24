#!/opt/local/bin/perl -w
use strict;
use DBI;
my $dir = "/opt/project/mysites/imgsky.com/web/upload/init/09/";
my $conn;
my @ids = (1);

init();
for(@ids){
    openFileDir($_);
}


sub init{
    $conn = DBI->connect("DBI:mysql:database=imgskycom;host=localhost","root","admin",{'RaiseError' => 1});
    $conn->do("SET names utf8");
}
sub openFileDir{
    my $id = shift;
    my $some_dir = $dir;
    my @jpg;
    my $zz;
    my $other;
    opendir(DIR, $some_dir) || die "can't opendir $some_dir: $!";
    grep {
     if(-f "$some_dir/$_"){
        if($_ =~ m/.png$/){
            #$jpg = $_;
            push @jpg,$_;
        }
     }
    } readdir(DIR);
    closedir DIR;
    for(@jpg){
        my $j = $_;
        $j =~ s/\.png/\.zip/;
        updateData($_,$j);
    }

}

sub updateData{
    my $png = shift;
    my $zip = shift;
    `curl "http://www.imgsky.com/admin/index.php?action=editSavePerl&png=$png&zip=$zip"`;
    print "$png/$zip\n";
}

