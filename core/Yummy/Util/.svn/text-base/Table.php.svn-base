<?php
class Yummy_Util_Table extends Yummy_Object{
    public static function getTableName($tableName){
        $pre = self::getPre();
        return $pre.$tableName;
    }
    public static function getFiledName($filed){
        $pre = self::getPre();
        return $pre.$filed;
    }
    public static function getPre(){
        $data = Yummy_Config::get("databases");
        $pre = $data["pre"];
        return $pre;
    }
    
}
?>