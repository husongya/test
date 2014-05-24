<?php /* Smarty version 2.6.18, created on 2009-09-06 16:35:35
         compiled from footer.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'format', 'footer.html', 5, false),)), $this); ?>
<div id="footer">
    <?php if ($this->_tpl_vars['footer'] == 1 && $this->_tpl_vars['cid'] == 0): ?>
    <p>
        <?php $_from = $this->_tpl_vars['category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['c']):
?>
        <a title="<?php echo $this->_tpl_vars['c']['title']; ?>
" href="<?php echo $this->_tpl_vars['domain']; ?>
<?php echo smarty_function_format(array('key' => 'category','cid' => $this->_tpl_vars['c']['id']), $this);?>
"><?php echo $this->_tpl_vars['c']['title']; ?>
</a>
        <?php endforeach; endif; unset($_from); ?>
    </p>
    <?php endif; ?>
    <p>版权所有 <a href="http://www.imgsky.com/" title="矢量素材下载">图片天空</a>（www.imgsky.com) <a href="http://www.imgsky.com/" title="矢量素材下载">矢量素材下载站</a> 最佳分辨率 1024×768</p>
    <p>Copyright © 2008-2009 www.imgsky.com Incorporated. All rights reserved.</p>
</div>
<div style="display:none">
<script src="http://s19.cnzz.com/stat.php?id=1610103&web_id=1610103" language="JavaScript" charset="gb2312"></script>
</div>