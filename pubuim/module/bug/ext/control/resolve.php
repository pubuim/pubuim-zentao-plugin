<?php
include '../../control.php';
class myBug extends bug
{
    public function resolve()
    {

        $pubuConfig = $this->loadModel('pubu')->getConfig();
        //todo if create send notification to pubuim
        if (!empty($_POST) && $pubuConfig->webhook) {
            $this->loadModel('pubu')->sendNotification($pubuConfig->webhook,
                array("type"    => "BUG.RESOLVE",
                      "bug"     => $this->bug,
                      "user"    => $this->user,
                      "product" => $this->product));

        }
        parent::resolve();
    }
}

?>