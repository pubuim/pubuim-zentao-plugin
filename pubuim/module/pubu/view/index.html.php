<?php
include '../../common/view/header.html.php';
?>

    <div class='container mw-700px'>
        <div id='titlebar'>
            <div class='heading'>
                <strong><?php echo $lang->pubu->common;?></strong>
            </div>
        </div>
        <form class='form-condensed' method='post' action='<?php echo inlink('save');?>' id='dataform'>
            <table class='table table-form'>

                <th>Webhook：</th>
                <td><?php echo html::input('webhook', $pubuConfig->webhook, "class='form-control'");?></td>
                </tr>
                <tr>
                    <td colspan='2' class='text-center'>
                        <?php
                        echo html::submitButton();
                        echo html::linkButton('测试连接', inlink('test'));
                        ?>
                    </td>
                </tr>
            </table>
        </form>
    </div>

<?php include '../../common/view/footer.html.php';?>