<?php
include '../../control.php';
class myBug extends bug
{
    public function edit()
    {

        $pubuConfig = $this->loadModel('pubu')->getConfig();

        //todo if create send notification to pubuim
        if (!empty($_POST) and !isset($_POST['stepIDList']) && $pubuConfig->webhook) {
            $this->loadModel('pubu')->sendNotification($pubuConfig->webhook,
                array("type"    => "BUG.EDIT",
                      "operator" => $this->app->user->account,
                      "data"     => $_POST,
                ));

        }
        parent::edit();
    }
}

?>