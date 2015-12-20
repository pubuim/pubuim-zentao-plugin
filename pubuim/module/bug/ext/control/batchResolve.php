<?php
include '../../control.php';
class myBug extends bug
{
    public function batchResolve()
    {

        $pubuConfig = $this->loadModel('pubu')->getConfig();
        //todo if create send notification to pubuim
        if (!empty($_POST) && $pubuConfig->webhook) {
            $this->loadModel('pubu')->sendNotification($pubuConfig->webhook,
                array("type"    => "BUG.BATCHRESOLVE",
                      "operator" => $this->app->user->account,
                      "data"     => $_POST,
                ));

        }
        parent::batchResolve();
    }
}

?>