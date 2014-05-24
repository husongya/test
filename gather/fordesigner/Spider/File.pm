package Spider::File;

$VERSION=0.1;

use LWP::UserAgent;
use HTTP::Request;
use HTML::TokeParser;
use Carp;
use DBI;
use File::Basename;
use File::Path;
use POSIX qw(strftime);
use strict;

my $self = {};
my $conn;

BEGIN {
}

END {
    clean();
}

sub new {
    my ($caller, %args) = @_;
    my $caller_is_obj = ref($caller);
    my $class = $caller_is_obj || $caller;
    my $self = bless {}, $class;
    foreach my $key (keys %args){
        $self->{$key} = $args{$key};
    }
    return $self;
}
#连接数据库，初始化数据
sub init{
    my $self = shift;
    my $database = $self->{'database'};
    my $host = $self->{'host'};
    my $database_user = $self->{'database_user'};
    my $database_pass = $self->{'database_pass'};
    $conn = DBI->connect("DBI:mysql:database=$database;host=$host",$database_user,$database_pass,{'RaiseError' => 1}) or die "Can't connect to database $database";
    $conn->{mysql_auto_reconnect} = 1;
    $conn->do("SET names utf8");
}
#插入测试数据
sub test{
    my $sth = $conn->prepare('
        INSERT INTO `gather_source` (`url` ,`state` ,`source_type` ,`created_on` ,`updated_on`)VALUES (?, ?, ?, ?, ?)
    ');
    for((1..10000)){
        $sth->execute("http://www.fordesigner.com/maps//$_-0.htm",0,"fordesigner","","");
    }
}
#获取数据库中可采集的链接
sub get_url{
    my $self = shift;
    my $source_table = $self->{'source_table'};
    my $source_type = $self->{'source_type'};
    my $rows_ref = $conn->selectall_arrayref("SELECT * FROM `$source_table` WHERE `source_type`=? AND `state`=0 order by id asc LIMIT 0 , 10000 ",{ Slice => {} },$source_type);
    return $rows_ref;
}
#分析url，匹配数据
sub analyse_url {
    my ($self,$get_url,$id) = (shift,shift,shift);
    $get_url =~ m/^http:\/\/(.*?)\//;
    my $c_host = $1;
    my $host = "http://".$c_host;
    $self->{'host'} = $host;
    my $ua = LWP::UserAgent->new();
       $ua->timeout(30);
    my ($req,$res);
    $req = new HTTP::Request('GET', $get_url);
    $res = $ua->request($req);
    my @all_file_url;
    my @all_image;
    my $keywords = "";
    my $description = "";
    my $title = "";
    my $source_table = $self->{'source_table'};
    
    if($res->is_success()){
        my $content = $res->content;
        utf8::decode($content);
        $content =~ m/<div class=\"spacer2\">(.*?)<\/div>(.*)<img src=\"\/images\/rss.gif\" \/><\/a>(.*?)<div class="topnews_info">/sg;
        my $stuff_content = $1;
        my $img_content = $3;

        my $p = HTML::TokeParser->new(\$content);
        my $ps = HTML::TokeParser->new(\$img_content);
        my $t = HTML::TokeParser->new(\$content);
        my $m = HTML::TokeParser->new(\$content);
        $t->get_tag("title");
        $title = $t->get_trimmed_text;
        $title =~ s/$c_host//;
        while (my $token = $m->get_tag("meta")) {
            if($token->[1]{name}){
                if ($token->[1]{name} =~ m/keywords/i){
                    $keywords = $token->[1]{content};
                    $keywords =~ s/$c_host//;
                }
                if ($token->[1]{name} =~ m/description/i){
                    $description = $token->[1]{content};
                    $description =~ s/$c_host//;
                }
            }
        }
        #print "title:$title\n keywords:$keywords\n description:$description\n";
        while (my $token = $p->get_tag("a")) {
            my $url = $token->[1]{href} || "";
            push(@all_file_url,$url),if $url =~ m/http:\/\/downno/s;
        }
        while (my $tokens = $ps->get_tag("img")) {
            my $src = $tokens->[1]{src};
            push(@all_image,$host.$src),if $src =~ m/.(jpg||gif||png)/s;
        }
        ###
        my $image_url = $all_image[0];
        my $file_url = $all_file_url[1];

        my $source_type = $self->{'source_type'};
        if(!defined $file_url or $file_url eq ""){
            $self->log("get content is error:url is $get_url:path is null");
            #return 0;
        }
        #print "c:$stuff_content\n image:$image_url, file:$file_url\n";
        $image_url =~ m/\.com(.*)/sg;
        my $insert_image_url = $source_type."/images".$1;
        $file_url =~ m/\.com(.*)/sg;
        my $insert_file_url = $source_type."/files".$1;

        my $image = $self->save_file($image_url,"images");
        my $file = $self->save_file($file_url,"files");
        if($image && $file){
            my $gather_table = $self->{'gather_table'};
            my $sth = $conn->prepare("
    INSERT INTO `$gather_table` (`title` ,`gather_source_id` ,`keywords` ,`description` ,`content` ,`image_url` ,`down_url` ,`note` ,`gather_source` ,`created_on` )VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");
            my $created_on = strftime "%Y-%m-%d %T", localtime();
            ###存储采集素材
            $sth->execute($title,$id,$keywords,$description,$stuff_content,$insert_image_url,$insert_file_url,$description,$get_url,$created_on);
            ### 更新源状态
            my $source = $conn->prepare("UPDATE `$source_table` SET `state` = '1' WHERE `id` =? LIMIT 1");
            $source->execute($id);
        }
        
    }else{

        my $rows_ref = $conn->selectall_arrayref("SELECT `err_count` FROM `$source_table` WHERE `id`=?",{ Slice => {} },$id);
        my $num = @$rows_ref[0]->{'err_count'};
        if($num gt 5){
            $conn->do("DELETE  FROM `$source_table` WHERE `id`=$id");
            $self->log("DELETE error_url : $get_url FROM TABLE $source_table");
        }else{
            $conn->do("UPDATE `$source_table` SET `err_count`=`err_count`+1 WHERE `id`=$id");
        }
        $self->log("get content is error:url is $get_url");
    }
}

sub save_file{
    my ($self,$get_url,$type) = (shift,shift,shift);
    my $ua = LWP::UserAgent->new();
       $ua->timeout(30);
    my ($req,$res);
    my $state = 1;
    print "get url:$get_url\n";
    $req = new HTTP::Request('GET', $get_url);
    $req->referer("http://www.fordesigner.com/");
    $res = $ua->request($req);
    if($res->is_success()){
        my ( $name, $path, $extension ) = fileparse ( $get_url, '\..*' );
        my $filename = $name.$extension;
        my $host = $self->{'host'}."/";
        my $dir = $self->{'save_path'}.$type."/";
        $path =~ s/^http:(.*)\.com\//$dir/;
        my $save_path = $path.$filename;
    
        unless(-e "$save_path" ) {
            unless(-d $path){
                eval{mkpath($path,0,0755)};
                $self->log("make dir:$path");
                if($@){
                    return 0;
                    $self->log("Make path [$path] failed:\n$@");
                }
            }
            open(FILE,">$save_path") or die("$!");
            $self->log("    save file to: $save_path");
            print FILE $res->content;
            close FILE;
        }
    }else{
        $self->log("save file $get_url failed.");
        $state = 0;
    }
    return $state;
}
sub log{
    shift;
    my $msg = shift || "value is null!";
    print $msg,"\n";
}
sub rtrim()
{
	my $string = shift;
	$string =~ s/\///;
	return $string;
}
#断开连接
sub clean{
    $conn->disconnect() if $conn;
    $conn = undef;
}

1;
__END__
