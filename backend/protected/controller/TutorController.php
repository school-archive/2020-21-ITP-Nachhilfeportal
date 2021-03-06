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
        if (!Authentication::is_logged_in())
            AnswerHandler::create_response_and_kill_page(false, "unauthorized", 401);
        $user = User::getUser(Authentication::$user_email);
        AnswerHandler::create_response_and_kill_page(true, $user->filterUser());
    }

    /**
     * Set User as a Tutor
     */
    public static function store()
    {
        $user = User::getUser(Authentication::$user_email);
        Tutor::create_tutor($user->getEmail(), '', 0);
    }

    /**
     * Display the specified resource.
     */
    public static function show($array, $email)
    {
        $tutor = Tutor::get_Tutor($email);
        $array['isTutor'] = true;
        $array['profile'] = $tutor;
        AnswerHandler::create_response_and_kill_page(true, $array);
    }


    /**
     * Update the specified resource in storage.
     */
    public static function update($vars)
    {
        $tutor = Tutor::get_Tutor(Authentication::$user_email);
        $user = User::getUser(Authentication::$user_email);

        if (isset($vars['description'])) {
            $tutor->setDescription($vars['description']);
        }

        if (isset($vars['method'])) {
            $method = json_decode($vars['method']);
            $tutor->setTM_present($method->vor_ort);
            $tutor->setTM_online($method->online);
        }

        if (isset($vars['subjects']) && $vars['subjects'] !== 'null' && $vars['subjects'] !== '') {
            $subjects_array = explode(',', $vars['subjects']);
            $user->deleteAllSubjects();
            foreach ($subjects_array as $subject) {
                $user->addSubject($subject);
            }
        } else {
            if(!empty($user->getSelected_Subject())) {
                $user->deleteAllSubjects();
            }
        }
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
                User::getUser(Authentication::$user_email)->deleteAllSubjects();
                AnswerHandler::create_response_and_kill_page(true, "Sucessfully deleted");
            }
        }
    }

}
