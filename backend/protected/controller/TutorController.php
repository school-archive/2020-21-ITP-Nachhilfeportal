<?php


namespace controller;


use classes\AnswerHandler;
use classes\Authentication;
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

}