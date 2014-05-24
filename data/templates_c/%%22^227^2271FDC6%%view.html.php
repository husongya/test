<?php /* Smarty version 2.6.18, created on 2009-09-06 16:45:03
         compiled from view.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'format', 'view.html', 20, false),array('modifier', 'date_format', 'view.html', 50, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="robots" content="follow,all">
<meta content="<?php echo $this->_tpl_vars['stuff']['keywords']; ?>
,图片天空素材网" name="keywords"/>
<meta content="<?php echo $this->_tpl_vars['stuff']['description']; ?>
,图片天空素材网" name="description"/>
<link rel="stylesheet" rev="stylesheet" type="text/css" href="/css/view.css" media="all" />
<title><?php echo $this->_tpl_vars['stuff']['title']; ?>
,<?php echo $this->_tpl_vars['stuff']['category']['title']; ?>
,矢量素材下载,图片天空素材网</title>
</head>
<body>
<div id="wrapper">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <div id="main" class="wrapfix">
        <div class="leftList">
            <div class="list">
                <h2>最新上传</h2>
                <ul>
                    <?php $_from = $this->_tpl_vars['new_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p']):
?>
                    <li><a href="<?php echo $this->_tpl_vars['domain']; ?>
<?php echo smarty_function_format(array('key' => 'sucai','id' => $this->_tpl_vars['p']['id']), $this);?>
" title="<?php echo $this->_tpl_vars['p']['title']; ?>
"><?php echo $this->_tpl_vars['p']['title']; ?>
</a></li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            </div>
            <div class="list">
                <h2>最近浏览</h2>
                <ul>
                    <?php $_from = $this->_tpl_vars['last_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p']):
?>
                    <li><a href="<?php echo $this->_tpl_vars['domain']; ?>
<?php echo smarty_function_format(array('key' => 'sucai','id' => $this->_tpl_vars['p']['stuff_id']), $this);?>
" title="<?php echo $this->_tpl_vars['p']['title']; ?>
"><?php echo $this->_tpl_vars['p']['title']; ?>
</a></li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            </div>
            <div class="list">
                <h2>随机素材</h2>
                <ul>
                    <?php $_from = $this->_tpl_vars['new_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p']):
?>
                    <li><a href="<?php echo $this->_tpl_vars['domain']; ?>
<?php echo smarty_function_format(array('key' => 'sucai','id' => $this->_tpl_vars['p']['id']), $this);?>
" title="<?php echo $this->_tpl_vars['p']['title']; ?>
"><?php echo $this->_tpl_vars['p']['title']; ?>
</a></li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            </div>
            <div class="ad">
            </div>
        </div>
        <div class="rightPic">
            <div class="pic">
                <a href="<?php echo $this->_tpl_vars['domain']; ?>
<?php echo smarty_function_format(array('key' => 'sucai','id' => $this->_tpl_vars['stuff']['id']), $this);?>
" title="<?php echo $this->_tpl_vars['stuff']['title']; ?>
"><img src="/upload/<?php echo $this->_tpl_vars['stuff']['image_url']; ?>
"/></a>
            </div>
            <div class="info">
                <h1><?php echo $this->_tpl_vars['stuff']['title']; ?>
</h1>
                <p><b>内容介绍：</b><?php echo $this->_tpl_vars['stuff']['description']; ?>
</p>
                <h5>发布时间：<span><?php echo ((is_array($_tmp=$this->_tpl_vars['stuff']['updated_on'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y.%m.%d") : smarty_modifier_date_format($_tmp, "%Y.%m.%d")); ?>
</span></h5>
                <h5>分类：<span><a title="<?php echo $this->_tpl_vars['stuff']['category']['title']; ?>
" href="<?php echo $this->_tpl_vars['domain']; ?>
<?php echo smarty_function_format(array('key' => 'category','cid' => $this->_tpl_vars['stuff']['category']['id']), $this);?>
"><?php echo $this->_tpl_vars['stuff']['category']['title']; ?>
</a></span></h5>
                <h5>标签：<?php $_from = $this->_tpl_vars['stuff']['keyword']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p']):
?><?php echo $this->_tpl_vars['p']; ?>
 <?php endforeach; endif; unset($_from); ?></h5>
                <h5><a id="down_stuff" href="/upload/<?php echo $this->_tpl_vars['stuff']['down_url']; ?>
" target="_blank" title="<?php echo $this->_tpl_vars['stuff']['title']; ?>
素材下载"><img src="/images/btn_down.gif" alt="<?php echo $this->_tpl_vars['stuff']['title']; ?>
素材下载"/></a></h5>
            </div>
            <div class="list_mate wrapfix">
                <h2>相关素材</h2>
                <ul>
                    <?php $_from = $this->_tpl_vars['new_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p']):
?>
                    <li><a href="<?php echo $this->_tpl_vars['domain']; ?>
<?php echo smarty_function_format(array('key' => 'sucai','id' => $this->_tpl_vars['p']['id']), $this);?>
" title="<?php echo $this->_tpl_vars['p']['title']; ?>
"><img src="/upload/<?php echo $this->_tpl_vars['p']['image_url']; ?>
" width="150" /></a></li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            </div>
        </div>
    </div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
</body>
</html>