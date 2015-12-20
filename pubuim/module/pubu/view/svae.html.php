<?php

include '../../common/view/header.html.php';
?>
<div class='container mw-700px'>
    <div id='titlebar'>
        <div class='heading'>

            <strong><?php echo $lang->pubu->common;?></strong>
            <small class='text-success'> 保存成功 <?php echo html::icon('ok-sign');?></small>
        </div>
    </div>
    <div class='alert alert-success'>
        <i class='icon-ok-sign'></i>
        <div class='content'>保存成功</div>
    </div>
</div>
<?php include '../../common/view/footer.html.php';?>
