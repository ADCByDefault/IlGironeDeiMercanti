<?php
class Response
{
    public $status;
    public $data;

    public function __construct($status, $data = [])
    {
        $this->status = $status;
        $this->data = $data;
    }
    public function json()
    {
        // return json_encode($this ->status);
        return json_encode(get_object_vars($this));
    }
    public static function send($status, $data = [])
    {
        $res = new Response($status, $data);
        echo $res->json();
    }
}
