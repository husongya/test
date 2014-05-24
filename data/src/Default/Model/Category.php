<?php
/**
* Default_Model_Category created on: 2009-08-25 12:16:39 by husong
**/
class Default_Model_Category extends Default_Model_Table_Category{

    /**
    * default method
    **/
    public static function getAllCategory(){
        $model = new Default_Model_Category();
        $data = $model->find(array("condition"=>"state=1","order"=>"ordering DESC"));
        $out = array();
        foreach ($data as $value){
        	$out[$value["id"]] = $value;
        }
        return $out;
    }

}
/** vim:sw=4:expandtab:ts=4 **/
?>