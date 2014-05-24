<?php
require_once(YUMMY_DIR.'/Smarty/libs/Smarty.class.php');
require_once(YUMMY_DIR.'/Log/Logger.php');
require_once(YUMMY_DIR.'/Adodb/adodb.inc.php');
class Yummy_Object {
    public $_data = array();
    public $_params = array();
	public function execute(){
		echo "not default action";
	}
	public static function info($msg,$class=__CLASS__){
		if(!empty($msg)){
			$log = new Yummy_Log_Logger();
			$log->info($msg,$class);
		}
	}
	public static function error($msg,$class=__CLASS__){
		if(!empty($msg)){
			$log = new Yummy_Log_Logger();
			$log->error($msg,$class);
		}
	}
	public static function debug($msg=null,$class=__CLASS__){
		if(!empty($msg)){
			$log = new Yummy_Log_Logger();
			$log->debug($msg,$class);
		}
	}
	public static function reset(){
		$log = new Yummy_Log_Logger();
		$log->reset();
	}
    //set smarty
    public function setSmarty(){
        $smarty = new Smarty;
        $smarty->compile_check = true;
        $smarty->debugging = false;
        //$smarty->template_dir = View_DIR."/templates";
        $temp = Yummy_Config::get("templates");
        $smarty->template_dir = $temp["temp_templates"];
        $smarty->compile_dir = $temp["temp_templates_c"];
        $smarty->config_dir = $temp["temp_configs"];
        $smarty->left_delimiter = $temp["left_delimiter"];
        $smarty->right_delimiter = $temp["right_delimiter"];
        if($temp["js_css_cache"] == true){
	        $smarty->load_filter('output','join_javascript');
	        $smarty->load_filter('output','join_css');
        }
        return $smarty;
    }
    //set assign
    public function putContext($param,$value){
        $this->_data['smarty'][$param] = $value;
    }
    //return smarty
    public function smartyResult($tpl='index.html'){
       $smarty = $this->setSmarty();
       $data = isset($this->_data['smarty'])?$this->_data['smarty']:'';
       if(is_array($data)){
           foreach($data as $key=>$value){
              $smarty->assign($key,$value);
           }
       }
       $upload = Yummy_Config::get("upload");
       $smarty->assign('root',Yummy_Config::get("root")."/");
       $smarty->assign('domain',Yummy_Config::get("domain")."/");
       $smarty->assign('primal',$upload["url"]);
       $smarty->assign('thumb',$upload["thumb_url"]);
       

       $smarty->display($tpl);

    }
    public function jsonResult(){
        if (!headers_sent()) {
            header("Content-Type:text/html;charset=utf-8");
/*          header("Content-type: application/x-gzip");
		　　 header("Content-Disposition: attachment; filename=文件名\");
		　　 header("Content-Description: PHP3 Generated Data"); */
        }
        $data = isset($this->_data['smarty'])?$this->_data['smarty']:'';
        $data = json_encode($data);
        echo $data;
    }
    public function go($url,$urlencode=false){
    	if($urlencode){
    		urlencode($url);
    	}
    	header("Location:{$url}");
    }
    public function rawResult($msg){
    	$time = date("Y-m-d h:i:s",time());
        echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
        //echo "<h3 style='color:red;'>操作提示!</h3>";
        echo "<div><div style='border:1px solid #ccc;background-color:#f1f1f1;color:blue'>".$msg."</div></div>";
        echo "<div style='margin-top:1em;border:1px dotted #eee;background-color:#f5fef5'>";
        echo "<div>@www.chinavisual.com at {$time}</div>";
        echo "</div>";
        exit;
    }

    public function checkUserLogin(){
		if(isset($_SESSION['login'])?$_SESSION['login']:null){
			return true;
		}else{
			$this->putContext('title','后台登录');
	        $this->smartyResult('admin/login.tpl');
	        //return false;
	        exit();
		}
		
    }
    public function setParams($value){
        $this->_params = $value;
        return $this;
    }
    public function getParams(){
        return $this->_params;
    }
    public function get($key,$value=null){
        $params = $this->getParams();
        isset($params[$key])?$a=$params[$key]:$a=$value;
        if($key == "page"){
            $a = intval($a);
            ($a==0)?$a=1:"";
        }
        return $a;
    }
}
?>