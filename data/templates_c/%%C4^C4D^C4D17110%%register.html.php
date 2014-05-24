<?php /* Smarty version 2.6.18, created on 2009-09-06 18:52:28
         compiled from login/register.html */ ?>
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
    <form id="form1" name="form1" method="post" action="/app.php/common/login/registerSave">
      <div class="reg">
        <div class="title">
          <h1>注册您的帐户：</h1>
        </div>

        <div class="list"><span>您的电子信箱：</span>
            <input name="account" type="text" class="input" id="account" maxlength="40"/>  <font style="color:#666666; font-size:12px; margin-left:2px;">(必填)</font>
            <div id="Checkuser"></div>
        </div>
        <div class="list"><span>设置密码：</span>
            <input name="password" type="password" class="input" id="password" maxlength="20" /> <font style="color:#666666; font-size:12px; margin-left:2px;">(必填)</font>
        </div>
        <div class="list"><span>您想要注册的昵称：</span>
            <input name="nick" type="text" class="input" id="nick" maxlength="20" /> <font style="color:#666666; font-size:12px; margin-left:2px;">(必填,可以随时更改)</font>
        </div>
        <div class="sub">
          <input name="fabu" type="submit" value="注 册" />
          <input name="chong" type="reset" value="重 填" />
        </div>
      </div>
      </form>
    </div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
</body>
</html>