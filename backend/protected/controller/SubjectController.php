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
        AnswerHandler::create_response_and_kill_page(true, Subject::get_subjects());
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

    }

    public static function delete()
    {
        $get = $_GET["email"];
        $get->delete();
        AnswerHandler::create_response_and_kill_page(true, "Deleted");
    }
}