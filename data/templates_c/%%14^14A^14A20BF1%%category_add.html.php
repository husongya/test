<?php /* Smarty version 2.6.18, created on 2009-08-25 22:56:26
         compiled from admin/category_add.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台分类管理</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/show.css" rel="stylesheet" type="text/css" />
<link href="css/page.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <div id="wrapper">
       
        <div id="show_list">
                     <h1><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/navigation.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></h1>
            <form action="index.php?action=categorySave" method=post> 
	            <table  width="90%" cellspacing="10" cellpadding="0">
	              <tr>
	                <td>标题：
	                <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['result']['id']; ?>
"/><input type="hidden" name="http" value="<?php echo $this->_tpl_vars['http']; ?>
"/>
	                <input type="text" name="title" value="<?php echo $this->_tpl_vars['result']['title']; ?>
"/>
	                </td>
	              </tr>
	              <tr>
	                <td>关键字：<textarea type="text" style="width:360;" name="keywords"><?php echo $this->_tpl_vars['result']['keywords']; ?>
</textarea></td>
	              </tr>
	              <tr>
	                <td>描述：<textarea type="text" style="width:360;" name="description"><?php echo $this->_tpl_vars['result']['description']; ?>
</textarea></td>
	              </tr>
	              <tr>
	                <td>排序：<textarea type="text" style="width:760;" name="ordering"><?php echo $this->_tpl_vars['result']['ordering']; ?>
</textarea></td>
	              </tr>
	              <tr>
	                <td>状态：开启<input type="radio" name="state" value="1" <?php if ($this->_tpl_vars['result']['state'] == 1): ?>checked<?php endif; ?>/>,关闭<input type="radio" name="state" value="0" <?php if ($this->_tpl_vars['result']['state'] == 0): ?>checked<?php endif; ?>/></td>
	              </tr>
	              
	            </table>
	            <input type="submit" value="submit" />
            </form>
        </div>
</div>
