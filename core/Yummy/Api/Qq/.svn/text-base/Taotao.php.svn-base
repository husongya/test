<?php
/***
*在博客上同步显示qq签名！
*说明：使用本代码前，请一定要开通滔滔并与qq签名关联！
*(免费使用!)
*$author:husong
*date:2008-07-13 19:50:40
***/
error_reporting(0);
set_time_limit(0);
class Yummy_Api_Qq_Taotao {
	public function getTaotao($qq="65214877",$num=20){
	    //http://www.taotao.com/cgi-bin/msgMgr?type=3&num=6&qq=65214877(xml格式)
	    $sUrl="http://www.taotao.com/cgi-bin/msgj?qq={$qq}&num={$num}&t=0";
	    $srcStr=file_get_contents($sUrl);
	    if(!$srcStr) return "error!";
	    $qqSign='';
	    if (function_exists('json_decode')){//第一种json方式
	      $srcStr=str_replace(array('}})','doApi('),array('}}',''),$srcStr);
	      $result=json_decode($srcStr,true);
	      if($result){
	        $qqSign=$result['posts'][0]['cn'];
	      }
	    }
	    else{//第二种字符串替换方式
	      list($tmpStr,$godStr)=explode('{"cn":"',$srcStr);
	      list($qqSign,$tmpStr)=explode('","id":',$godStr);
	    }
	    return $result;
	}
}
?>

