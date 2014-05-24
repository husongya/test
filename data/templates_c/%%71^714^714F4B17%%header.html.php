<?php /* Smarty version 2.6.18, created on 2009-08-25 21:58:05
         compiled from header.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'format', 'header.html', 9, false),)), $this); ?>
    <div id="header" class="wrapfix">
        <div class="logo"><a href="<?php echo $this->_tpl_vars['domain']; ?>
" title="矢量素材下载"><img src="/images/logo.gif"  /></a></div>
        <div class="banner"><a href="http://s.click.taobao.com/t_1?i=qXste4lzhyUPbA%3D%3D&p=mm_10785004_0_0&n=11" title="最新推出　2008年《PSD分层素材库》第三版 20DVD" target="_blank"><img src="/images/banner.gif" /></a></div>
    </div>
    <div class="nav">
        <ul class="wrapfix">
            <li><a <?php if ($this->_tpl_vars['cid'] == 0): ?>class="current"<?php endif; ?> title="最新素材" href="<?php echo $this->_tpl_vars['domain']; ?>
">最新素材</a></li>
            <?php $_from = $this->_tpl_vars['category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['c']):
?>
            <li><a <?php if ($this->_tpl_vars['cid'] == $this->_tpl_vars['c']['id']): ?>class="current"<?php endif; ?> title="<?php echo $this->_tpl_vars['c']['title']; ?>
" href="<?php echo $this->_tpl_vars['domain']; ?>
<?php echo smarty_function_format(array('key' => 'category','cid' => $this->_tpl_vars['c']['id']), $this);?>
"><?php echo $this->_tpl_vars['c']['title']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
        <!--<div class="menu">
            <a href=""></a>
        </div>-->
    </div>