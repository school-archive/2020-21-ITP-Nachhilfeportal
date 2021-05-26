<?php


namespace controller;


use classes\AnswerHandler;
use classes\Authentication;
use classes\Tutor;
use classes\User;

class TutorController
{

    /**
     * Übergangsläsung, gibt alle Tutoren zurück
     */
    public static function filter()
    {
        AnswerHandler::create_response_and_kill_page(true, User::filterUser());
    }

    public static function store()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public static function show($array, $email)
    {
        $tutor = Tutor::get_Tutor($email);
        $array['profile'] = $tutor;
        AnswerHandler::create_response_and_kill_page(true, $array);
    }


    /**
     * Update the specified resource in storage.
     */
    public static function update()
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public static function destroy()
    {
        if (!Authentication::is_logged_in()) {
            AnswerHandler::create_response_and_kill_page(false, "unauthorized", 401);
        } else {
            $tutor = Tutor::get_Tutor(Authentication::$user_email);
            if ($tutor == false) {
                AnswerHandler::create_response_and_kill_page(false, "No Data", 400);
            } else {
                $tutor->delete_tutor();
                AnswerHandler::create_response_and_kill_page(true, "Sucessfully deleted");
            }
        }
    }

}
