<?php
//require(YUMMY_DIR."Util/XXTEA.php");
abstract class Yummy_Util_Util {
    /**
     * encrypt data use XXTEA algorithm 
     *
     * @param string $data
     * @param string $key 
     * @return string
     */
    public static function encryptXXTea($data,$key){
        if($data=="") return "";
        return Yummy_Util_XXTEA::encrypt($data,$key);
        /*
        //xxtea need 32bit key
        if($data=="")return "";
        if($hashed){
            $key = hash('md5',$key,true);
        }
        if(function_exists('xxtea_encrypt')){
            return xxtea_encrypt($data,$key);
        }else{
            return Doggy_Util_Crypt_XXTEA::encrypt($data,$key);
        }
        */
    }
    /**
     * descrypt data use XXTEA algorithm
     *
     * @param string $data
     * @param string $key 
     * @return string
     */
    public static function decryptXXTea($data,$key){
        if($data=="") return "";
        return Yummy_Util_XXTEA::decrypt($data,$key);
        /*
        if($hashed){
            $key = hash('md5',$key,true);
        }
        if(function_exists('xxtea_decrypt')){
            $ok=xxtea_decrypt($data,$key);
            if($ok===false)return '';
            return $ok;
        }else{
            return Doggy_Util_Crypt_XXTEA::decrypt($data,$key);
        }
        */
    }
     
}
/**vim:sw=4 et ts=4 **/
?>