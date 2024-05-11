<?php
class Response
{
    public $status;

    public function __construct($status)
    {
        $this->status = $status;
    }
    public function json()
    {
        // return json_encode($this ->status);
        return json_encode(get_object_vars($this));
    }
    public static function sendStatus($status)
    {
        $res = new Response($status);
        echo $res->json();
    }
}
