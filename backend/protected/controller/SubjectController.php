<?php


namespace controller;


use classes\AnswerHandler;
use classes\Authentication;
use classes\Subject;
use classes\User;

class SubjectController
{
    /**
     * Display a listing of the resource.
     */
    public static function index()
    {
        $dep = (isset($_GET['department'])) ? $_GET['department'] : null;
        AnswerHandler::create_response_and_kill_page(true, Subject::get_subjects($dep));
    }

    /**
     * Store a newly created resource in storage.
     */
    public static function store()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public static function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public static function destroy()
    {
        if (!Authentication::is_logged_in())
            AnswerHandler::create_response_and_kill_page(false, "unauthorized", 401);
        if (!User::getUser(Authentication::$user_email)->isAdmin()) {
            AnswerHandler::create_response_and_kill_page(false, "admin privileges required", 403);
        } else {
            $get = $_GET["name"];
            $s = Subject::getSubject($get);
            if ($s == false) {
                AnswerHandler::create_response_and_kill_page(false, "No Data", 400);
            } else {
                $s->deleteSubject();
                AnswerHandler::create_response_and_kill_page(true, "Sucessfully deleted");
            }
        }
    }
}