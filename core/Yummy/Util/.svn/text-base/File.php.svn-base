<?php
/**
 * 文件处理类
 *
 * port from EPS project
 */
class Yummy_Util_File extends Yummy_Object {
    /**
     * 创建目录结构
     *
     * @param string $path
     * @param int $mode
     * @return bool
     */
    public static function mk($path,$mode=0777){
        if(file_exists($path)) return true;
        $dirs = split('/',$path);
	    $p = '';
	    for($i=0;$i<count($dirs);$i++){
	        $p.= $dirs[$i].'/';
	        if(is_dir($p))continue;
	        mkdir($p);
	        chmod($p,$mode);
	    }
	    return true;
    }
   
    /**
     * 重命名
     *
     * @param string $old
     * @param string $new
     * @return bool
     */
    public static function rename($old,$new){
        if(!file_exists($old)) return false;
        if (!@rename($old,$new)) {
            self::mk(dirname($new));
            if (@copy ($old,$new)) {
                @unlink($old);
                return TRUE;
            }
            return FALSE;
         }
         return TRUE;
    }
    public static function mv($old,$new){
        self::mk(dirname($new));
        if (@copy ($old,$new)) {
            @unlink($old);
            return TRUE;
        }
        return false;
    }
    /**
	 * Get file extension
	 *
	 * @param string $filename
	 * @return string $ext return file extension
	 */
	public static function getFileExtension($filename){
    	return strtolower(substr(strrchr($filename,'.'),1));
	}
	/**
	 * Read file content
	 * @param string $filename file to read
	 * @return string filecontent
	 */
	public static function readFile($filename){
	    return file_get_contents($filename);
	}
	/**
     * 将数据写入指定路径的文件
     * 默认将文件属性改为0666
     * 
     * @param	string	$path
     * @param	string	$data
     * @param  bool $dontchmod disable chmod target file
     * @return	bool
     */
    public static function writeFile($path, $data,$dontchmod=false){
    	/*if ( ! ($fp = @fopen($path, $mode))){
    		return FALSE;
    	}
    	flock($fp, LOCK_EX);
    	fwrite($fp, $data);
    	flock($fp, LOCK_UN);
    	fclose($fp);
        */
        $ok = @file_put_contents($path,$data,LOCK_EX);
        if($ok===false) return false;
    	if(!$dontchmod){
    	   @chmod($path,0666);
    	}
    	self::debug("create a file :{$path}",__CLASS__);
    	return TRUE;
    }
    /**
     * 锁定并返回文件内容
     * 
     * @param string $filename
     * @return string
     */
    public static function flockGetContents($filename){
        $return = FALSE;
        if(!is_readable($filename)){
            return false;
        }
        if($fp = @fopen($filename, 'r')){
            while(!$return){
                if(flock($handle, LOCK_SH)){
                    if($return = file_get_contents($filename)){
                        flock($handle, LOCK_UN);
                    }
                }
            }
        }
        fclose($fp);
        return $return;
    }
	
    /**
     * Determine if a file contains Binary information.
     *
     * @param string $link
     * @return boolean
     */
    public static function isBinary($link){
        $tmpStr  = '';
        @$fp    = fopen($link, 'rb');
        @$tmpStr = fread($fp, 256);
        @fclose($fp);
        if($tmpStr != ''){
            $tmpStr = str_replace(chr(10), '', $tmpStr);
            $tmpStr = str_replace(chr(13), '', $tmpStr);
            $tmpInt = 0;
            for($i =0; $i < strlen($tmpStr); $i++){
                if( extension_loaded('ctype') ){
                    if( !ctype_print($tmpStr[$i]) )$tmpInt++;
                } else{
                    if( !eregi("[[:print:]]+", $tmpStr[$i]) )$tmpInt++;
                }
            }
            if($tmpInt > 5) return false;
            else return true;
        } else
            return false;
    }
    /**
     * Return file list in "dir" folder matching "pattern"
     *
     * @param string $dir
     * @param string $pattern
     * @return array
     */
    public static function ls($dir="./",$pattern="*.*"){
        settype($dir,"string");
        settype($pattern,"string");
        $ls=array();
        $regexp=preg_quote($pattern,"/");
        $regexp=preg_replace("/[\\x5C][\x2A]/",".*",$regexp);
        $regexp=preg_replace("/[\\x5C][\x3F]/",".", $regexp);
        if(is_dir($dir) && ($dir_h=@opendir($dir))!==FALSE){
            while(($file=readdir($dir_h))!==FALSE)
                if(preg_match("/^".$regexp."$/",$file))array_push($ls,$file);
            closedir($dir_h);
        }
        sort($ls,SORT_STRING);
        return $ls;
    }
    /**
     * Find disk usage for a directory and its subs,It's kinda like the Unix du program,
     * except it returns the usage in bytes, not blocks
     *
     * @param string $location
     * @return int
     */
    public static function du($location) {
       if (!$location or !is_dir($location)) {
         return 0;
       }
       $total = 0;
       $all = opendir($location);
       while ($file = readdir($all)) {
         if (is_dir($location.'/'.$file) and $file <> ".." and $file <> ".") {
             $total += du($location.'/'.$file);
             unset($file);
         }
         elseif (!is_dir($location.'/'.$file)) {
             $stats = stat($location.'/'.$file);
             $total += $stats['size'];
             unset($file);
         }
       }
       closedir($all);
       unset($all);
       return $total;
    }
    
    /**
     * Return the relative path between two paths
     *
     * If $path2 is empty, get the current directory (getcwd).
     *
     * NOTE:only work on UNIX
     *
     * @param string $path1
     * @param string $path2
     * @return string
     */
    public static function getRelativePath($path1, $path2=''){
       if ($path2 == '') {
           $path2 = $path1;
           $path1 = getcwd();
       }

       //Remove starting, ending, and double / in paths
       $path1 = trim($path1,'/');
       $path2 = trim($path2,'/');
       while (substr_count($path1, '//')) $path1 = str_replace('//', '/', $path1);
       while (substr_count($path2, '//')) $path2 = str_replace('//', '/', $path2);

       //create arrays
       $arr1 = explode('/', $path1);
       if ($arr1 == array('')) $arr1 = array();
       $arr2 = explode('/', $path2);
       if ($arr2 == array('')) $arr2 = array();
       $size1 = count($arr1);
       $size2 = count($arr2);

       //now the hard part :-p
       $path='';
       for($i=0; $i<min($size1,$size2); $i++){
           if ($arr1[$i] == $arr2[$i]) continue;
           else $path = '../'.$path.$arr2[$i].'/';
       }
       if ($size1 > $size2){
           for ($i = $size2; $i < $size1; $i++)
               $path = '../'.$path;
       } else if ($size2 > $size1){
           for ($i = $size1; $i < $size2; $i++)
               $path .= $arr2[$i].'/';
       }
        return $path;
    }
    
	/**
	 * 删除指定路径（包含自身，子目录及文件）
	 *
	 * @param string $path
	 */
	public static function rm($path){

	    if(!file_exists($path)) return true;

	    if(is_file($path)){
	        return @unlink($path);
	    }
	    $dh = @opendir($path);
	    if(!$dh) return false;
	    while (($obj = readdir($dh))) {
	        if($obj=='.' || $obj=='..') continue;
	        $f = $path.'/'.$obj;
	        if(is_dir($f))self::rm($f);
	        if(is_file($f))@unlink($f);
	    }
	    closedir($dh);
	    return rmdir($path);
	}
	/**
	 * 删除指定目录中的所有文件和子目录
	 *
	 */
	public static function clear($path){
	    if(!is_dir($path)){
	        return;
	    }
	    $dh = @opendir($path);
	    if(!$dh) return false;
	    while (($obj = readdir($dh))) {
	        if($obj=='.' || $obj=='..') continue;
	        $f = $path.'/'.$obj;
	        if(is_dir($f))self::rm($f);
	        if(is_file($f))unlink($f);
	    }
	    closedir($dh);
	    return true;
	}
	/**
	 * concat a path
	 * @param string .... any path
	 * @return string
	 */
	public static function normalizePath(){
	    $dirs = func_get_args();
	    if(empty($dirs)) return;
	    $result=array_shift($dirs);
	    while($dir=array_shift($dirs)){
	        $result .= '/'.ltrim($dir,'/');
	    }
	    return rtrim($result,'/');
	}
	/**
	 * 返回文件的mime类型
	 * 
	 * @param string $file
	 * @return string
	 */
	public static function getMimeContentType($file){
	    static $mimeTypes = array (
		 'ez'=>'application/andrew-inset',
		 'hqx'=>'application/mac-binhex40',
		 'cpt'=>'application/mac-compactpro',
		 'doc'=>'application/msword',
		 'bin'=>'application/octet-stream',
		 'dms'=>'application/octet-stream',
		 'lha'=>'application/octet-stream',
		 'lzh'=>'application/octet-stream',
		 'exe'=>'application/octet-stream',
		 'class'=>'application/octet-stream',
		 'oda'=>'application/oda',
		 'pdf'=>'application/pdf',
		 'ai'=>'application/postscript',
		 'eps'=>'application/postscript',
		 'ps'=>'application/postscript',
		 'smi'=>'application/smil',
		 'smil'=>'application/smil',
		 'mif'=>'application/vnd.mif',
		 'xls'=>'application/vnd.ms-excel',
		 'ppt'=>'application/vnd.ms-powerpoint',
		 'wbxml'=>'application/vnd.wap.wbxml',
		 'wmlc'=>'application/vnd.wap.wmlc',
		 'wmlsc'=>'application/vnd.wap.wmlscriptc',
		 'bcpio'=>'application/x-bcpio',
		 'vcd'=>'application/x-cdlink',
		 'pgn'=>'application/x-chess-pgn',
		 'cpio'=>'application/x-cpio',
		 'csh'=>'application/x-csh',
		 'dcr'=>'application/x-director',
		 'dir'=>'application/x-director',
		 'dxr'=>'application/x-director',
		 'dvi'=>'application/x-dvi',
		 'spl'=>'application/x-futuresplash',
		 'gtar'=>'application/x-gtar',
		 'hdf'=>'application/x-hdf',
		 'js'=>'application/x-javascript',
		 'skp'=>'application/x-koan',
		 'skd'=>'application/x-koan',
		 'skt'=>'application/x-koan',
		 'skm'=>'application/x-koan',
		 'latex'=>'application/x-latex',
		 'nc'=>'application/x-netcdf',
		 'cdf'=>'application/x-netcdf',
		 'sh'=>'application/x-sh',
		 'shar'=>'application/x-shar',
		 'swf'=>'application/x-shockwave-flash',
		 'sit'=>'application/x-stuffit',
		 'sv4cpio'=>'application/x-sv4cpio',
		 'sv4crc'=>'application/x-sv4crc',
		 'tar'=>'application/x-tar',
		 'tcl'=>'application/x-tcl',
		 'tex'=>'application/x-tex',
		 'texinfo'=>'application/x-texinfo',
		 'texi'=>'application/x-texinfo',
		 't'=>'application/x-troff',
		 'tr'=>'application/x-troff',
		 'roff'=>'application/x-troff',
		 'man'=>'application/x-troff-man',
		 'me'=>'application/x-troff-me',
		 'ms'=>'application/x-troff-ms',
		 'ustar'=>'application/x-ustar',
		 'src'=>'application/x-wais-source',
		 'zip'=>'application/zip',
		 'au'=>'audio/basic',
		 'snd'=>'audio/basic',
		 'mid'=>'audio/midi',
		 'midi'=>'audio/midi',
		 'kar'=>'audio/midi',
		 'mpga'=>'audio/mpeg',
		 'mp2'=>'audio/mpeg',
		 'mp3'=>'audio/mpeg',
		 'aif'=>'audio/x-aiff',
		 'aiff'=>'audio/x-aiff',
		 'aifc'=>'audio/x-aiff',
		 'ram'=>'audio/x-pn-realaudio',
		 'rm'=>'audio/x-pn-realaudio',
		 'rpm'=>'audio/x-pn-realaudio-plugin',
		 'ra'=>'audio/x-realaudio',
		 'wav'=>'audio/x-wav',
		 'pdb'=>'chemical/x-pdb',
		 'xyz'=>'chemical/x-xyz',
		 'bmp'=>'image/bmp',
		 'gif'=>'image/gif',
		 'ief'=>'image/ief',
		 'jpeg'=>'image/jpeg',
		 'jpg'=>'image/jpeg',
		 'jpe'=>'image/jpeg',
		 'png'=>'image/png',
		 'tiff'=>'image/tiff',
		 'tif'=>'image/tiff',
		 'wbmp'=>'image/vnd.wap.wbmp',
		 'ras'=>'image/x-cmu-raster',
		 'pnm'=>'image/x-portable-anymap',
		 'pbm'=>'image/x-portable-bitmap',
		 'pgm'=>'image/x-portable-graymap',
		 'ppm'=>'image/x-portable-pixmap',
		 'rgb'=>'image/x-rgb',
		 'xbm'=>'image/x-xbitmap',
		 'xpm'=>'image/x-xpixmap',
		 'xwd'=>'image/x-xwindowdump',
		 'igs'=>'model/iges',
		 'iges'=>'model/iges',
		 'msh'=>'model/mesh',
		 'mesh'=>'model/mesh',
		 'silo'=>'model/mesh',
		 'wrl'=>'model/vrml',
		 'vrml'=>'model/vrml',
		 'css'=>'text/css',
		 'html'=>'text/html',
		 'htm'=>'text/html',
		 'asc'=>'text/plain',
		 'txt'=>'text/plain',
		 'rtx'=>'text/richtext',
		 'rtf'=>'text/rtf',
		 'sgml'=>'text/sgml',
		 'sgm'=>'text/sgml',
		 'tsv'=>'text/tab-separated-values',
		 'wml'=>'text/vnd.wap.wml',
		 'wmls'=>'text/vnd.wap.wmlscript',
		 'etx'=>'text/x-setext',
		 'xml'=>'text/xml',
		 'mpeg'=>'video/mpeg',
		 'mpg'=>'video/mpeg',
		 'mpe'=>'video/mpeg',
		 'qt'=>'video/quicktime',
		 'mov'=>'video/quicktime',
		 'avi'=>'video/x-msvideo',
		 'movie'=>'video/x-sgi-movie',
		 'ice'=>'x-conference/x-cooltalk',
		);
		$ext = self::getFileExtension($file);
	    if (isset( $mimeTypes[$ext])){
			return  $mimeTypes[$ext];
	    }
		return 'application/octet-stream';
	}
}
?>