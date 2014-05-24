<? /*+++
|
| Author :huhu
| 使用方法
| $shtml = new Shtml($Url,$FileBag,$FolderName,$fileid)
| $Url： 页面 URL 地址
| $FileBag： 文件夹标记 1 为：指定文件夹
| 2 为：默认文件夹(时间(年月日))
| $FolderRoot html文件存放路径
| $FolderName 指定文件夹的名称 $FileBag为2时 可以写为空("");
| $fileid 静态页面名称(后缀 默认为 .html)
|
|
|
/*++*/
class Yummy_Util_Html
{
    public $message1="Error 1: You write class Shtml is Wrong ! The second parameter is 1 or 2 in this class!.";
    public $message2="Error 2: The file write Error.";
	public $path;
	public $over;

    function __construct (){

    }

    /*************获取数据*******************/
    public function loadcontent ($Folder)
    {
        ob_start();
        $a = self::writehtml ($Folder,$this->data);
        ob_clean();
        return $a;
    }

    /********** 指定文件夹*****************/
    public function useFolder ()
    {
        if($this->flag==1)
        {
            $Folder=$this->fileDir;
        }
        else if($this->flag==2)
        {
            $Folder=$this->fileDir.'/'.date('Ymd',time());
        }
        else
        {
            exit($this->message1);
        }
        if(!is_dir($Folder)){ mkdir($Folder,0700);}

        $a = self::loadcontent ($Folder);
		return $a;
    }
    /********** 生成静态页面*****************/
    public function writehtml ($Folder,$cache_value)
    {
    	$dir = $Folder.'/';
    	$this->path = $dir.$this->fileName.'.'.$this->pix;
    	if(!$this->over && file_exists($this->path)) return true;
    	if(is_dir($dir)){
	        $file = fopen($this->path,'w+');
	        chmod($dir,0777);
	        chmod($this->path,0777);
	        fwrite($file,$cache_value);
	        fclose($file);
    	}else{
    		//echo "dir:{$dir} is'not exist!";
    		return false;
    	}
    	return true;

    }
    /**
     * 生成页面
     *
     * @param string $data 要生成的数据
     * @param int $flag 生成规则
     * @param string $fileName 文件的名称
     * @param string $pix 文件后缀名
     * @param string $fileDir 文件生成目录
     * @param bool $over true 覆盖存在的文件 fasle反之
     * @return bool true or false
     */
    public function creat($data="content is null!",$flag=1,$fileName="",$pix="html",$fileDir="./html",$over=true){
        $this->fileDir = $fileDir;
        $this->data = $data;
        $this->flag = $flag;
        $this->fileName = !empty($fileName)?$fileName:time();
        $this->pix = $pix;
        $this->over = $over;
        $a = self::useFolder();
        return $a;
    }
}
?>