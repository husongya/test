#!/opt/local/bin/perl -w
use Spider::File;
my $spider;
my %avg = (
            'database'=>'imgskycom',
            'host'=>'localhost',
            'database_user'=>'root',
            'database_pass'=>'admin',
            'source_table'=>'gather_source',
            'gather_table'=>'gather_stuff',
            'source_type'=>'fordesigner',
            'save_path'  => '/opt/project/mysites/imgsky.com/web/store/fordesigner/',
            'log_path'  => '/opt/project/mysites/imgsky.com/gather/fordesigner/log/file.log'
          );
          
          
$spider = Spider::File->new(%avg);
$spider->init();
#$spider->test();exit;
my $source_ref = $spider->get_url();

foreach my $row (@$source_ref) {
    $spider->analyse_url($row->{'url'},$row->{'id'});
}
