<?php
/**
 * 单一入口
 * 默认模块module:default 默认action:index 默认function:execute
 * @example http://www.secrit.cn/app.php/default/index/execute
 */
define('MODULE_NAME',"imgsky"); //模块名称
define('CONFIG_NAME',"index"); //配置文件名称secrit.yml
define('SYSTEM_DIR',"/opt/project/mysites/imgsky.com/core"); //竞赛系统核心源码目录
define('PRODUCT_DIR',"/opt/project/mysites/imgsky.com/data"); //产品目录静态页面 配置文件源码等
define("YUMMY_DIR",SYSTEM_DIR."/Yummy"); //框架所在绝对路径
require_once(YUMMY_DIR.'/Start.php');
?>
