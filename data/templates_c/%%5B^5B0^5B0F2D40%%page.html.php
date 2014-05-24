<?php /* Smarty version 2.6.18, created on 2009-08-25 23:15:53
         compiled from page.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formatPage', 'page.html', 3, false),array('block', 'page', 'page.html', 10, false),)), $this); ?>
<div class="pages">
    <?php if ($this->_tpl_vars['page'] > 1): ?>
        <a class="other" href="<?php echo $this->_tpl_vars['domain']; ?>
<?php echo smarty_function_formatPage(array('key' => $this->_tpl_vars['common_url'],'v1' => $this->_tpl_vars['page']-1), $this);?>
">上一页</a>
    <?php else: ?><span>上一页</span><?php endif; ?>
        <p>
    <?php if ($this->_tpl_vars['page'] >= 6 && $this->_tpl_vars['totalPage'] > 8): ?>
        <a href="<?php echo $this->_tpl_vars['domain']; ?>
<?php echo smarty_function_formatPage(array('key' => $this->_tpl_vars['common_url'],'v1' => 1), $this);?>
" >1</a>
        ...
    <?php endif; ?>
    <?php $this->_tag_stack[] = array('page', array('totalPage' => $this->_tpl_vars['totalPage'],'currentPage' => $this->_tpl_vars['page'],'item' => 'p')); $_block_repeat=true;smarty_block_page($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
         <?php if ($this->_tpl_vars['p'] == $this->_tpl_vars['page']): ?>
         <?php echo $this->_tpl_vars['p']; ?>

         <?php else: ?>
         <a <?php if ($this->_tpl_vars['p'] == $this->_tpl_vars['page']): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['domain']; ?>
<?php echo smarty_function_formatPage(array('key' => $this->_tpl_vars['common_url'],'v1' => $this->_tpl_vars['p']), $this);?>
" ><?php echo $this->_tpl_vars['p']; ?>
</a>
         <?php endif; ?>
    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_page($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php if ($this->_tpl_vars['page'] <= $this->_tpl_vars['totalPage']-5 && $this->_tpl_vars['totalPage'] > 8): ?>
        ...
        <a href="<?php echo $this->_tpl_vars['domain']; ?>
<?php echo smarty_function_formatPage(array('key' => $this->_tpl_vars['common_url'],'v1' => $this->_tpl_vars['totalPage']), $this);?>
" ><?php echo $this->_tpl_vars['totalPage']; ?>
</a>             
    <?php endif; ?>
        </p>
    <?php if ($this->_tpl_vars['page'] < $this->_tpl_vars['totalPage']): ?>
        <a class="other" href="<?php echo $this->_tpl_vars['domain']; ?>
<?php echo smarty_function_formatPage(array('key' => $this->_tpl_vars['common_url'],'v1' => $this->_tpl_vars['page']+1), $this);?>
">下一页</a>
    <?php else: ?><span>下一页</span><?php endif; ?>
</div>