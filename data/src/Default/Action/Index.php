<?php
class Default_Action_Index extends Yummy_Object{
    protected $page = 1;

    public function execute(){
        return $this->index();
    }

    public function index(){
        $page = intval($this->get("page"));
        $cid = $this->get("cid");
        $page = isset($page)?$page:1;
        $cid = intval(isset($cid)?$cid:0);
        $row = 5;
        $pageSize = 20;
        $model = new Default_Model_Stuff();
        $condition = "state=1";
        $vars = array();
        if($cid>0){
        	$condition.=" AND category_id=?";
        	$vars[] = $cid;
        }
        $category = Default_Model_Category::getAllCategory();
        $list = $model->find(array("condition"=>$condition,"vars"=>$vars,"page"=>$page,"size"=>$pageSize,"order"=>"published_on DESC"));
        foreach ($list as $key=>$value){
        	$list[$key]["category"] = $category[$value["category_id"]];
        }
        $out = array();
        foreach($list as $key=>$value){
	        $p = ceil(($key+1)/$row);
	        $out[$p][] = $value;
        }
        
        $total = $model->countIf($condition,$vars);
        $totalPage = ceil($total/$pageSize);
    	$this->putContext("list",$out);
    	$this->putContext("footer",1);
    	$this->putContext("cid",$cid);
    	$this->putContext("page",$page);
    	$this->putContext("totalPage",$totalPage);
    	$this->putContext("category",$category);
        $this->putContext("common_url",Common_Util_Format::getUrl('category_page',array($cid,"%s")));
        return $this->smartyResult("index.html");
    }
    public function view(){
    	$size = 12;
    	$id = $this->get("id");
    	$category = Default_Model_Category::getAllCategory();
        $stuff = new Default_Model_Stuff();
        $last = new Default_Model_ViewLast();
        
        $new_data = $stuff->find(array("condition"=>"state=1","page"=>1,"size"=>$size,"order"=>"created_on DESC"));
        $last_data = $last->find(array("page"=>1,"size"=>$size,"order"=>"updated_on DESC"));
        $stuff_data = $stuff->findById($id);
        $stuff_data["keyword"] = explode(",",$stuff_data["keywords"]);
        $stuff_data["category"] = $category[$stuff_data["category_id"]];
        
        //insert data
        if ($stuff_data["title"]) Yummy_ActiveRecord_Base::getDba()->execute("INSERT INTO `view_last` (`stuff_id`,`title`,`updated_on`)VALUES (?,?,?) ON DUPLICATE KEY UPDATE stuff_id = VALUES(stuff_id),title = VALUES(title),updated_on = VALUES(updated_on)",array($id,$stuff_data["title"],date("Y-m-d H:i:s")));
    	$this->putContext("new_data",$new_data);
    	$this->putContext("last_data",$last_data);
    	$this->putContext("stuff",$stuff_data);
    	$this->putContext("cid",$stuff_data["category_id"]);
        $this->putContext("category",$category);
        return $this->smartyResult("view.html");
    }
}
?>
