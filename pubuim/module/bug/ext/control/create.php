<?php
include '../../control.php';
class myBug extends bug
{
    public function create($productID, $branch = '', $extras = '')
    {

        $pubuConfig = $this->loadModel('pubu')->getConfig();

        //todo if create send notification to pubuim
        if (!empty($_POST) and !isset($_POST['stepIDList']) && $pubuConfig->webhook) {
            $result = @$this->loadModel('pubu')->sendNotification($pubuConfig->webhook,
                array("type"     => "BUG.CREATE",
                      "operator" => $this->app->user->account,
                      "data"     => $_POST,
                     ));

        }
        parent::create($productID,$branch,$extras);
    }
}

?>