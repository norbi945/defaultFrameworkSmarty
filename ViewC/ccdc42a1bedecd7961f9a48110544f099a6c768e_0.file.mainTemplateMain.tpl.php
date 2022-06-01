<?php
/* Smarty version 4.0.4, created on 2022-02-28 21:31:06
  from 'C:\xampp\htdocs\BornTask\View\mainTemplateMain.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.4',
  'unifunc' => 'content_621d310aac1397_80722631',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ccdc42a1bedecd7961f9a48110544f099a6c768e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\BornTask\\View\\mainTemplateMain.tpl',
      1 => 1646080263,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:View/ViewPartials/navbar.tpl' => 1,
  ),
),false)) {
function content_621d310aac1397_80722631 (Smarty_Internal_Template $_smarty_tpl) {
?><html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='\<?php echo PROJECT_NAME;?>
\assets\bootstrap\css\bootstrap.css'>
    <link rel='stylesheet' href='\<?php echo PROJECT_NAME;?>
\assets\main.css'>
    <?php echo '<script'; ?>
 type="text/javascript" src="\<?php echo PROJECT_NAME;?>
\assets\js\jQuery.js"><?php echo '</script'; ?>
>

    <title><?php echo "3DWebshop";?>
</title>
</head>

<body class='mainbackgroud'>

    <?php $_smarty_tpl->_subTemplateRender("file:View/ViewPartials/navbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    
    <div class='container text-center border bg-light maincontainer'>
        <?php echo $_smarty_tpl->tpl_vars['homeMain']->value;?>

    </div>
</body>
<?php echo '<script'; ?>
 type="text/javascript" src="\<?php echo PROJECT_NAME;?>
\assets\js\ControllersJs\adminWaresController.js"><?php echo '</script'; ?>
>
</html><?php }
}
