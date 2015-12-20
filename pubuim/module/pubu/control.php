<?php

class pubu extends control
{

    public function index()
    {
        if ($this->config->pubu) {
            $pubuConfig = $this->config->pubu;
            $pubuConfig->webhook = $this->config->pubu->webhook;
        }

        $this->view->position[] = html::a(inlink('index'), $this->lang->pubu->common);
        $this->view->position[] = '首页';

        $this->view->pubuConfig = $pubuConfig;
        $this->display();
    }

    public function save()
    {
        if (!empty($_POST)) {
            $pubuConfig = new stdclass();
            $pubuConfig->webhook = trim($this->post->webhook);

            $this->loadModel('setting')->setItems('system.pubu', $pubuConfig);
            if (dao::isError()) die(js::error(dao::getError()));

            $this->session->set('pubuConfig', '');

            $this->view->position[] = html::a(inlink('index'), $this->lang->pubu->common);
            $this->view->position[] = '保存';
            $this->display();
        }
    }

    public function test()
    {
        $pubuConfig = $this->pubu->getConfig();
        $this->view->position[] = html::a(inlink('index'), $this->lang->pubu->common);
        $this->view->position[] = '测试';
        $this->view->ping = $this->pubu->sendNotification($pubuConfig->webhook, array('type' => 'ping'));
        $this->display();
    }
}

?>