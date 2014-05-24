<?php /* Smarty version 2.6.18, created on 2009-09-06 16:35:35
         compiled from index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'format', 'index.html', 21, false),array('modifier', 'date_format', 'index.html', 32, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="robots" content="follow,all">
<meta content="<?php if ($this->_tpl_vars['cid'] > 0): ?><?php echo $this->_tpl_vars['category'][$this->_tpl_vars['cid']]['keywords']; ?>
<?php else: ?>矢量素材下载、素材下载、字体下载、背景花纹素材、可爱素材、超酷素材、网页素材、图标素材、矢量素材<?php endif; ?>" name="keywords"/>
<meta content="<?php if ($this->_tpl_vars['cid'] > 0): ?><?php echo $this->_tpl_vars['category'][$this->_tpl_vars['cid']]['description']; ?>
<?php else: ?>矢量素材下载、PSD分层素材、EPS格式素材、AI格式素材、各种中英文字体、时尚插画、矢量花纹、矢量底纹、矢量水晶图形、图标下载、精美图片下载、网页模板、酷站欣赏、音效下载、桌面壁纸、网页素材、经典潮流花纹矢量下载、欧美矢量图,矢量图库,矢量图片,矢量图下载,矢量素材,免费矢量图,素材图片,素材下载,免费矢量图<?php endif; ?>" name="description"/>
<link href="/css/index.css" rel="stylesheet" type="text/css" media="screen">
<title><?php if ($this->_tpl_vars['cid'] > 0): ?><?php echo $this->_tpl_vars['category'][$this->_tpl_vars['cid']]['title']; ?>
<?php else: ?>素材下载,图片,字体,矢量,壁纸,图标icon,psd<?php endif; ?>,矢量素材下载,图片天空素材网</title>
</head>
<body>
<div id="wrapper">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <div id="allposts">
         <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['s']):
?>
        <div class="list">
            <?php $_from = $this->_tpl_vars['s']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p']):
?>
            <div class="eachpost  pEntry pLoad2">
                <div>
                    <div class="postimage">
                        <a href="<?php echo $this->_tpl_vars['domain']; ?>
<?php echo smarty_function_format(array('key' => 'sucai','id' => $this->_tpl_vars['p']['id']), $this);?>
" title="<?php echo $this->_tpl_vars['p']['title']; ?>
"> <img src="/upload/<?php echo $this->_tpl_vars['p']['image_url']; ?>
" alt="<?php echo $this->_tpl_vars['p']['title']; ?>
" width="220"></a>
                    </div>
                    <div class="contentIndex">
                        <div class="topleft">
                            <h2><a href="<?php echo $this->_tpl_vars['domain']; ?>
<?php echo smarty_function_format(array('key' => 'sucai','id' => $this->_tpl_vars['p']['id']), $this);?>
" rel="bookmark" title="<?php echo $this->_tpl_vars['p']['title']; ?>
"><?php echo $this->_tpl_vars['p']['title']; ?>
 —</a></h2>
                        </div>
                        <div class="topright circle_Showcases">•</div>
                        <div class="clearall"></div>
                        <?php echo $this->_tpl_vars['p']['description']; ?>

                        <div class="sociable wrapfix">
                            <span class="leftSort">分类：<a rel="nofollow" href="<?php echo $this->_tpl_vars['domain']; ?>
<?php echo smarty_function_format(array('key' => 'category','cid' => $this->_tpl_vars['p']['category_id']), $this);?>
" title="<?php echo $this->_tpl_vars['p']['category']['title']; ?>
"><?php echo $this->_tpl_vars['p']['category']['title']; ?>
</a>→</span>
                            <span class="rightTime"><?php echo ((is_array($_tmp=$this->_tpl_vars['p']['updated_on'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y.%m.%d") : smarty_modifier_date_format($_tmp, "%Y.%m.%d")); ?>
</span>
                        </div>
                    </div>
                    <!--<div class="small">
                        Emil Olsson,
                        <a href="/">Showcases</a>,
                        <a href="">Speak</a>
                    </div>-->
                </div>
            </div>
            <?php endforeach; endif; unset($_from); ?>
            
        </div>
            <?php endforeach; endif; unset($_from); ?>
    </div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'page.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
</body>
</html>