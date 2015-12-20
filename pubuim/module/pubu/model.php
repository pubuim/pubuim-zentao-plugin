<?php
class pubuModel extends model
{
    public function sendNotification($url, $data)
    {
        $options = array(
            'http' => array(
                'header'  => 'Content-type: application/json',
                'method'  => 'POST',
                'content' => json_encode($data),
            ),
        );
        $context = stream_context_create($options);
        return file_get_contents($url, false, $context);

    }

    public function ping()
    {
        return 'world';
    }

    public function getConfig()
    {
        $records = $this->dao->select('*')->from(TABLE_CONFIG)->where('module')->eq('pubu')->fetchAll();
        if (!$records) {
            return null;
        }

        $config = new stdclass();
        foreach ($records as $record) {
            if ($record->key == 'webhook') $config->webhook = $record->value;
        }
        return $config;
    }

    public function setConfig($pubuConfig)
    {
        try {
            $this->loadModel('setting')->setItems('system.pubu', $pubuConfig);
            if (dao::isError()) {
                return dao::getError();
            } else {

            }
        } catch (Exception $err) {
            return $err;
        }
        return true;
    }
}

//$pubu = new pubuModel();
//$pubu->sendNotification('http://trigged1.dev.pubu.im/services/w1wenv3zn8pm0xg',array('type' => 'ping'))


?>

