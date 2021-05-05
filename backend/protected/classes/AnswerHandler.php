<?php
namespace classes;
class AnswerHandler
{
    private $success;
    private $data;
    private $status_code;


    public function __construct($success, $data, $status_code=200)
    {
        $this->success = $success;
        $this->data = $data;
        $this->status_code = $status_code;
    }

    public function kill_page($set_content_type=true, $set_status_code=true, $allow_origin=true) {
        if ($set_content_type) header("Content-Type: application/json");
        if ($set_status_code) http_response_code($this->status_code);
        if($allow_origin) header("Access-Control-Allow-Origin: *");
        die($this);
    }

    public static function create_response_and_kill_page($success, $data, $status_code=200, $set_content_type=true, $set_status_code=true, $allow_origin=true) {
        (new AnswerHandler($success, $data, $status_code))->kill_page($set_content_type, $set_status_code, $allow_origin);
    }

    public function __toString()
    {
        return json_encode([
            "success" => $this->success,
            "data" => $this->data
        ]);
    }
}