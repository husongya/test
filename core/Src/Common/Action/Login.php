<?php
class Common_Action_Login extends Yummy_Object{
	private $default_url;//默认跳转url

	public function __construct(){
		$login = Yummy_Config::get("login");
		$this->default_url = $login["default_url"];
	}
	public function execute(){
        $this->run();
    }
    
    //入口函数
	public function run(){
		$action = $this->get("action");
		if($action == 'login'){
			$this->Login();
		}
		elseif ($action =='localout'){ //本地注销
			$this->LocalLoginOut();
		}
		elseif ($action == 'register'){ //注册
			$this->Register();
		}
		elseif ($action == 'insert'){
			//$this->AddDate();
		}elseif ($action == 'info'){
			$this->GetUserInfo();
		}
		else {
			$this->Login();
		}
	}

	/**
	 * 登录
	 *
	 */
	public function Login(){
		$this->getJumpUrl();
		return $this->smartyResult("login/login.html");
	}

	public function logOut(){
		Yummy_Session_Base::getContext()->clear("login");
		Yummy_Session_Base::getContext()->clear("level");
		Yummy_Session_Base::getContext()->clear("user_id");
		Yummy_Session_Base::getContext()->clear("name");
		Yummy_Session_Base::getContext()->clear("account");
		$url = $this->getJumpUrl();
		header("location:".$url);
	}
	
	/**
	 * 用户注册
	 *
	 */
	public function register(){
		$this->getJumpUrl();
        return $this->smartyResult("login/register.html");
	}
	/**
	 * 用户注册验证
	 *
	 */
	public function registerSave(){
        $account = $this->get("account");
        $password = $this->get("password");
        $nick = $this->get("nick");
        
        if(empty($account)){
            return $this->noteResult("你的帐号还没有填写！");
        }
        if(empty($password)){
            return $this->noteResult("你的密码还没有填写！");
        }
        if(empty($nick)){
            return $this->noteResult("你的昵称还没有填写！");
        }
        $password = hash("md5",$password);
        $user = new Default_Model_User();
        $num = $user->countIf("account=?",array($account));
        if(!$num){
            try {
            	$time = date("Y-m-d H:i:s");
	            $user->setAccount($account);
	            $user->setPassword($password);
	            $user->setCreatedOn($time);
	            $user->setLastLogin($time);
	            $user->setNick($nick)->save();
	            Yummy_Session_Base::getContext()->set("login",1);
	            Yummy_Session_Base::getContext()->set("user_id",$user->getId());
	            Yummy_Session_Base::getContext()->set("account",$account);
	            Yummy_Session_Base::getContext()->set("level",0);
	            Yummy_Session_Base::getContext()->set("nick",$nick);
	            return $this->noteResult("注册成功！");
	        }catch (Exception $e){
	            self::error("insert into {$user->tableName} is error,info:{$e->getMessage()}",__CLASS__);
	            return $this->noteResult("注册失败，请重试！");
	        }
        }else{
        	return $this->noteResult("注册失败，此帐号已经被注册！");
        }

         $this->checkLogin();
	}
    public function noteResult($msg){
    	$this->putContext("msg",$msg);
        return $this->smartyResult("login/state.html");
    }
	/**
	 * 登录验证
	 *
	 */
	public function loginCheck(){
        $account = $this->get("account");
        $password = $this->get("password");
        
		if(empty($account)){
			return $this->noteResult("你的帐号还没有填写！");
		}
		if(empty($password)){
            return $this->noteResult("你的密码还没有填写！");
		}
        $password = hash("md5",$password);
		$user = new Default_Model_User();
		$result = $user->findFirst(array('condition'=>'account=? AND password=?','vars'=>array($account,$password)));
		self::debug("will login {$user->tableName}",__CLASS__);
		if(!empty($result)){
			Yummy_Session_Base::getContext()->set("login",1);
			Yummy_Session_Base::getContext()->set("user_id",$result["id"]);
			Yummy_Session_Base::getContext()->set("level",$result["level"]);
			Yummy_Session_Base::getContext()->set("account",$result["account"]);
			Yummy_Session_Base::getContext()->set("nick",$result["nick"]);
			Yummy_ActiveRecord_Base::getDba()->execute("update {$user->tableName} set `last_login`=? where `id`=?",array(date("Y-m-d H:i:s"),$result["id"]));
			//return $this->noteResult("登录成功！");
		}else{
			$m = "登录失败，请重试！";
            self::error($m,__CLASS__);
            return $this->noteResult($m);
		}

		return $this->checkLogin();

	}
	function checkLogin(){
		$login = Yummy_Session_Base::getContext()->get("login");
		if(isset($login)){
			$defaulturl = Yummy_Session_Base::getContext()->get("jump_url");
		}else{
			$defaulturl = $this->default_url;
		}
		self::debug("will location to {$defaulturl}",__CLASS__);
		header('Location:'.$defaulturl);
	}
	public function getJumpUrl(){
		$url = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:$this->default_url;
		Yummy_Session_Base::getContext()->set("jump_url",$url);
		return $url;
	}
	public function getUrl(){
		$url = Yummy_Session_Base::getContext()->get("jump_url");
		if(empty($url)){
			$url = $this->default_url;
		}
		return $url;
	}
}
?>