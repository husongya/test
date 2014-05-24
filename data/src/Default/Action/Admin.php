<?php
class Default_Action_Admin extends Yummy_Object{
	public $page = 1;
	public $state = 0;
    public function authority(){
        $level = Yummy_Session_Base::getContext()->get("level");

        if($level){
            return true;
        }else{
        	$this->smartyResult("admin/login.html");
        	return false;
        }
    }
	public function execute(){
        return $this->index();
    }
    /**
     * @param $type $page
     * @return smarty
     */
	public function index(){
        $page = intval($this->get("page"));
        $state = $this->get("state");
        $page = isset($page)?$page:1;
        $state = isset($state)?$state:0;

        $pageSize = 40;
        $model = new Default_Model_Stuff();
        $condition = "state=?";
        $vars = array($state);
        $result = $model->find(array("condition"=>$condition,"vars"=>$vars,"page"=>$page,"size"=>$pageSize,"order"=>"published_on DESC,updated_on DESC"));
        $total = $model->countIf($condition,$vars);
        $totalPage = ceil($total/$pageSize);
        
        $this->putContext("result",$result);
        $this->putContext("page",$page);
        $this->putContext("totalPage",$totalPage);
        $this->putContext("common_url","/admin/index.php?action=index&state={$state}&page=");
		return $this->smartyResult("admin/index.html");
	}
	public function gather(){
        $page = intval($this->get("page"));
        $state = $this->get("state");
        $page = isset($page)?$page:1;
        $state = isset($state)?$state:0;

        $pageSize = 40;
        $model = new Default_Model_GatherStuff();
        $condition = "";
        $vars = array();
        $result = $model->find(array("condition"=>$condition,"vars"=>$vars,"page"=>$page,"size"=>$pageSize,"order"=>"created_on ASC"));
        $total = $model->countIf($condition,$vars);
        $totalPage = ceil($total/$pageSize);
        
        $this->putContext("result",$result);
        $this->putContext("page",$page);
        $this->putContext("totalPage",$totalPage);
        $this->putContext("common_url","/admin/index.php?action=gather&state={$state}&page=");
		return $this->smartyResult("admin/gather.html");
	}
    public function gatherAdd(){
        $id = intval($this->get("id"));
        $model = new Default_Model_GatherStuff();
        $result = $model->findById($id);
        $this->putContext("result",$result);
        $this->putContext("id",$id);
        $this->putContext("category",Default_Model_Category::getAllCategory());
    	return $this->smartyResult("admin/gather_edit.html");
    }
    
    public function gatherDelete(){
        $id = intval($this->get("id"));
        $this->putContext("gourl",$_SERVER["HTTP_REFERER"]);
        $model = new Default_Model_GatherStuff();

        if(!$model->has($id)){
            $this->rawResult("此ID不存在！");
        }
        try{
            $model->delete($id);
            $this->putContext("msg","删除采集库素材成功！");
        }catch(Exception $e){
            Yummy_Object::error("删除采集库素材失败:".$e->getMessage(),__METHOD__);
            $this->putContext("msg","删除采集库素材失败！");
        }
        return $this->smartyResult("admin/showmsg.html");
    }
    
    public function gatherEditSave(){
        $gather_id = intval($this->get("id"));
        $rewriter_url = $this->get("rewriter_url");
        $title = $this->get("title");
        $keywords = $this->get("keywords");
        $description = $this->get("description");
        $content = $this->get("content");
        $down_url = $this->get("down_url");
        $image_url = $this->get("image_url");
        $source = $this->get("source");
        $category_id = $this->get("category_id");
        $time = date("Y-m-d H:i:s");
        $this->putContext("gourl","/admin/index.php?action=gather");
        $model = new Default_Model_Stuff();
        $gather_model = new Default_Model_GatherStuff();
        if(empty($title)||empty($content)||empty($image_url)||empty($down_url)){
            Yummy_Object::error("必填字段不能为空.",__METHOD__);
            $this->putContext("msg","必填字段不能为空！");
            return $this->smartyResult("admin/showmsg.html");
        }
        try{
            $model->setRewriterUrl($rewriter_url);
            $model->setTitle($title);
            $model->setCategoryId($category_id);
            $model->setKeywords($keywords);
            $model->setDescription($description);
            $model->setContent($content);
            $model->setImageUrl($image_url);
            $model->setDownUrl($down_url);
            $model->setState(0);
            $model->setSource($source);
            $model->setRecommend(0);
            $model->setCreatedOn($time);
            $model->setUpdatedOn($time);
            $model->save();
            $this->putContext("msg","入素材库成功！");
            $gather_model->delete($gather_id);
        }catch(Exception $e){
            Yummy_Object::error("入素材库失败:".$e->getMessage(),__METHOD__);
            $this->putContext("msg","入素材库失败！");
        }

        return $this->smartyResult("admin/showmsg.html");
    }
    
    
    public function add(){
        $id = intval($this->get("id"));
        $model = new Default_Model_Stuff();
        $result = $model->findById($id);
        $this->putContext("result",$result);
        $this->putContext("id",$id);
        $this->putContext("category",Default_Model_Category::getAllCategory());
    	return $this->smartyResult("admin/edit.html");
    }
    public function categoryList(){
        $id = intval($this->get("id"));
        $c = new Default_Model_Category();
        $result = $c->find();
        $this->putContext("result",$result);
        $this->putContext("id",$id);
    	return $this->smartyResult("admin/category.html");
    }
    public function addCategory(){
        $id = intval($this->get("id"));
        $model = new Default_Model_Category();
        $result = $model->findById($id);
        $this->putContext("result",$result);
        $this->putContext("id",$id);
    	return $this->smartyResult("admin/category_add.html");
    }
    public function categorySave(){
    	$id = intval($this->get("id"));
    	$title = $this->get("title");
    	$keywords = $this->get("keywords");
    	$description = $this->get("description");
    	$ordering = $this->get("ordering");
    	$state = $this->get("state");
    	
    	$model = new Default_Model_Category();
        if(empty($title)){
            Yummy_Object::error("必填字段不能为空.",__METHOD__);
            $this->putContext("msg","必填字段不能为空！");
            return $this->smartyResult("admin/showmsg.html");
        }
        try{
        	if($id>0){
        		$model->setId($id);
        	}
            $model->setTitle($title);
            $model->setKeywords($keywords);
            $model->setOrdering($ordering);
            $model->setDescription($description);
            $model->setState($state);
        	$model->save();
        	$this->putContext("msg","编辑成功！");
        }catch(Exception $e){
        	Yummy_Object::error("编辑失败:".$e->getMessage(),__METHOD__);
            $this->putContext("msg","编辑失败！");
        }
        $this->putContext("gourl",$_SERVER["HTTP_REFERER"]);
        return $this->smartyResult("admin/showmsg.html");
    }
    public function editSave(){
    	$id = intval($this->get("id"));
    	$rewriter_url = $this->get("rewriter_url");
    	$title = $this->get("title");
    	$keywords = $this->get("keywords");
    	$description = $this->get("description");
    	$content = $this->get("content");
    	$down_url = $this->get("down_url");
    	$image_url = $this->get("image_url");
    	$source = $this->get("source");
    	$category_id = $this->get("category_id");
    	$time = date("Y-m-d H:i:s");
    	
    	$model = new Default_Model_Stuff();
        if(empty($title)||empty($content)||empty($image_url)||empty($down_url)){
            Yummy_Object::error("必填字段不能为空.",__METHOD__);
            $this->putContext("msg","必填字段不能为空！");
            return $this->smartyResult("admin/showmsg.html");
        }
        try{
        	if($id>0){
        		$model->setId($id);
        	}else{
        		$model->setCreatedOn($time);
        		$model->setRecommend(0);
        		$model->setCategoryId($category_id);
        		$model->setState(0);
        	}
            $model->setUpdatedOn($time);
        	$model->setRewriterUrl($rewriter_url);
        	$model->setTitle($title);
        	$model->setKeywords($keywords);
        	$model->setDescription($description);
        	$model->setContent($content);
        	$model->setImageUrl($image_url);
        	$model->setDownUrl($down_url);
        	$model->setCategoryId($category_id);
        	$model->setSource($source);
        	$model->save();
        	$this->putContext("msg","编辑成功！");
        }catch(Exception $e){
        	Yummy_Object::error("编辑失败:".$e->getMessage(),__METHOD__);
            $this->putContext("msg","编辑失败！");
        }
        $this->putContext("gourl",$_SERVER["HTTP_REFERER"]);
        return $this->smartyResult("admin/showmsg.html");
    }
    /**
     * perl导入数据
     *
     */
    public function editSavePerl(){
        $png = $this->get("png");
        $zip = $this->get("zip");
        $file = str_replace(".png","",$png);
    	$rewriter_url = $file;
    	$title = $file;
    	$keywords = $file.",字体,国外字体,外国字体,英文字体,免费字体";
    	$description = $file.",字体,国外字体,外国字体,英文字体,免费字体";
    	$content = $file;
    	$down_url = $zip;
    	$image_url = $png;
    	$source = "";
    	$category_id = 3;
    	$time = date("Y-m-d H:i:s");
    	
    	$model = new Default_Model_Stuff();
        try{
        		$down_url = "init/09/".$down_url;
        		$image_url = "init/09/".$image_url;
        		$model->setCreatedOn($time);
        		$model->setRecommend(0);
        		$model->setCategoryId(3);
        		$model->setState(0);
            $model->setUpdatedOn($time);
        	$model->setRewriterUrl($rewriter_url);
        	$model->setTitle($title);
        	$model->setKeywords($keywords);
        	$model->setDescription($description);
        	$model->setContent($content);
        	$model->setImageUrl($image_url);
        	$model->setDownUrl($down_url);
        	$model->setCategoryId($category_id);
        	$model->setSource($source);
        	$model->save();
        }catch(Exception $e){

        }
    }
	/**
	 * 收回
	 *
	 * @return unknown
	 */
	public function back(){
        $id = intval($this->get("id"));
        $this->putContext("gourl",$_SERVER["HTTP_REFERER"]);
        $model = new Default_Model_Stuff();

        if(!$model->has($id)){
            $this->rawResult("此ID不存在！");
        }
        try{
            $model->setId($id);
            $model->setState(0);
            $model->save();
            $this->putContext("msg","收回成功！");
        }catch(Exception $e){
            Yummy_Object::error("收回失败:".$e->getMessage(),__METHOD__);
            $this->putContext("msg","收回失败！");
        }
        return $this->smartyResult("admin/showmsg.html");
	}
	public function delete(){
        $id = intval($this->get("id"));
        $this->putContext("gourl",$_SERVER["HTTP_REFERER"]);
        $model = new Default_Model_Stuff();

        if(!$model->has($id)){
            $this->rawResult("此ID不存在！");
        }
        try{
            $model->delete($id);
            $this->putContext("msg","删除成功！");
        }catch(Exception $e){
            Yummy_Object::error("删除失败:".$e->getMessage(),__METHOD__);
            $this->putContext("msg","删除失败！");
        }
        return $this->smartyResult("admin/showmsg.html");
	}
	public function indexHtml(){
	    $shtml = new Yummy_Util_Html();
	    $domain = Yummy_Config::get("domain");
	    $url = $domain."/app.php";
	    
	    $data = file_get_contents($url);
        $a = $shtml->creat($data,1,"index",'html',"../");
        if($a){
            $this->putContext("msg","生成首页成功！");
        }else {
            $this->putContext("msg","生成首页失败！");
        }
		$this->putContext("gourl",$_SERVER["HTTP_REFERER"]);
        return $this->smartyResult("admin/showmsg.html");
	}
	public function pass(){
        $id = intval($this->get("id"));
        $state = intval($this->get("state"));
        $this->putContext("gourl",$_SERVER["HTTP_REFERER"]);
        $model = new Default_Model_Stuff();
        if(!$model->has($id)){
            $this->rawResult("此ID不存在！");
        }
        try{
            $model->setId($id);
            $model->setState($state);
            if($state==1){
                $model->setPublishedOn(date("Y-m-d H:i:s"));
            }
            $model->save();
            $this->putContext("msg","操作成功！");
        }catch(Exception $e){
            Yummy_Object::error("审核失败:".$e->getMessage(),__METHOD__);
            $this->putContext("msg","操作失败！");
        }
        return $this->smartyResult("admin/showmsg.html");
	}
    public function search(){
        echo "404";
    }
    public function account(){
    	$type = $this->get("type");
    	$page = $this->get("page");
    	$size = 20;
    	$id = $this->get("id");
    	$account = $this->get("account");
        $user = new Default_Model_User();
        $this->putContext("gourl",$_SERVER["HTTP_REFERER"]);
    	if($type == "delete"){
    		$result = $user->findById($id);
    		$login = Yummy_Config::get("login");
    		$administrator = $login["manager"];
    		if($administrator == $result["account"]){
                $this->putContext("msg","系统管理员不能删除！");
    		}else{
                $this->putContext("msg","删除管理员成功！");
                $user->setId($id);
                $user->setLevel(0);
                $user->save();
    		}
	        return $this->smartyResult("admin/showmsg.html");
    	}
    	if($type == "add"){
            $user_result = $user->findFirst(array("condition"=>"account=?","vars"=>array($account)));
            if(isset($user_result["id"])){
                $user->setId($user_result["id"]);
            }
            $user->setAccount($account);
            $user->setLevel(1);
            $user->save();
            $this->putContext("msg","添加管理员成功！");
            return $this->smartyResult("admin/showmsg.html");
    	}

    	$manage_result = $user->find(array("condition"=>"level=1"));
    	$user_result = $user->find(array("condition"=>"level!=1","page"=>$page,"size"=>$size,"order"=>"created_on desc"));
    	$total = $user->countIf("level!=1");
    	$totalPage = ceil($total/$size);
        $html = "admin/account.html";

        $this->putContext("manage",$manage_result);
        $this->putContext("user",$user_result);
        $this->putContext("url","index.php?action=account");
        $this->putContext("totalPage",$totalPage);
        $this->putContext("page",$page);
        return $this->smartyResult($html);
    }

}
?>
