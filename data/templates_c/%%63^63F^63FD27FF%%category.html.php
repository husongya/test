<?php /* Smarty version 2.6.18, created on 2009-08-25 00:27:30
         compiled from admin/category.html */ ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
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
                 <div id="list">
                     <div id="page"><form name="form1" action="index.php" method="get">
                     <input name="action" value="search" type="hidden" >
                     <input name="keyword" id="keyword" size="36" maxlength="100" type="text" value="<?php echo $this->_tpl_vars['keyword']; ?>
">
                     <select name='type'>
                      <option value="1" <?php if ($this->_tpl_vars['type'] != 2): ?>selected="selected"<?php endif; ?> >按作品名称</option>
                      <option value="2" <?php if ($this->_tpl_vars['type'] == 2): ?>selected="selected"<?php endif; ?> >按作者昵称</option>
                     </select>
                     <input value="搜索" id="sb" type="submit"></form></div> 
                      <div id="page"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "page.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div> 
                           <?php $_from = $this->_tpl_vars['result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p']):
?>
                             <span>
                                 <p>编号：<?php echo $this->_tpl_vars['p']['id']; ?>
 <?php echo $this->_tpl_vars['p']['title']; ?>
 <a href="index.php?action=addCategory&id=<?php echo $this->_tpl_vars['p']['id']; ?>
" >修改</a> <br /> </p>
                             </span>
                            <?php endforeach; endif; unset($_from); ?>
                             <div class="clear"></div>

                           <div id="page"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/page.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div> 
          </div>
        </div>
</div>
