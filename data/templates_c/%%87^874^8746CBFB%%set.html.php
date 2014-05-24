<?php /* Smarty version 2.6.18, created on 2009-08-24 21:41:44
         compiled from set/set.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>创建表model</title>
</head>
<div>
<!--<a href="http://m.writter.cn/index.php/set/yummy/execute/create/all">生成所有</a>-->
<?php $_from = $this->_tpl_vars['tables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t']):
?>
<li><a href="set.php?table=<?php echo $this->_tpl_vars['t'][$this->_tpl_vars['table']]; ?>
"><?php echo $this->_tpl_vars['t'][$this->_tpl_vars['table']]; ?>
</a></li>
<?php endforeach; endif; unset($_from); ?>
</div>
</body>
</html>