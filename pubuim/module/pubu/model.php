<?php
// class pubuModel
class pubuModel extends model
{
    public function sendNotification($url, $data)
    {
        if (extension_loaded('curl')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1); 
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            if (substr($url, 0, 8) == "https://") {
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1); // 检查证书中是否设置域名
            }


            $result = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($result,true);
            if ($result === false) {
                return '测试失败，请确保服务器 file_get_contents 或者 安装 curl 模块可用 ';
            }

            return $result;
        } else if (ini_get("allow_url_fopen")) {
            try {
                $options = array(
                    'http' => array(
                        'header'  => 'Content-type: application/json',
                        'method'  => 'POST',
                        'content' => json_encode($data),
                    ),
                );
                $context = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
                if ($result === false) {
                    $error = error_get_last();
                    error_log("got error" . $error['message'] . "\n", 3, "/tmp/zentao.log");
                    return '测试失败，请确保服务器 file_get_contents 或者 安装 curl 模块可用 ';
                }
                return $result;
            } catch (Exception $e) {
                error_log("file_get_contents got error" . $e->getMessage() . "\n", 3, "/tmp/zentao.log");
            }
        } else {
            return '测试失败，请确保服务器 file_get_contents 或者 安装 curl 模块可用 ';
        }
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

// $pubu = new pubuModel();
// $pubu->sendNotification('http://requestb.in/va29vuva',   array('type' => 'ping',"data" => array("hello"=>"zentao")));
?>