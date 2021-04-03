<?php
class AnswerHandler
{
    private bool $success;
    private $data;


    public function __construct($success, $data)
    {
        $this->success = $success;
        $this->data = $data;
    }

    public function __toString()
    {
        return json_encode([
            "success" => $this->success,
            "data" => $this->data
        ]);
    }
}