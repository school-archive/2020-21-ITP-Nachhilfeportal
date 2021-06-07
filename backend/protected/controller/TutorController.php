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
        $user = User::getUser(Authentication::$user_email);
        if (!$user)
            AnswerHandler::create_response_and_kill_page(false, 'unauthorized', 401);
        AnswerHandler::create_response_and_kill_page(true, $user->filterUserInBearbeitung());
//        AnswerHandler::create_response_and_kill_page(true, User::filterUser());
    }

    /**
     * Set User as a Tutor
     */
    public static function store()
    {
        $user = User::getUser(Authentication::$user_email);
        if (isset($_POST["description"])) {
            if (isset($_POST["teaching_method"])) {
                Tutor::create_tutor($user->getEmail(), $_POST["description"], $_POST["teaching_method"]);
            }
            AnswerHandler::create_response_and_kill_page(true, "Tutor created");
        }
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
    public static function update()
    {
        parse_str(file_get_contents("php://input"), $vars);
        $user = User::getUser(Authentication::$user_email);

        if (!$user->isTutor()) {
            AnswerHandler::create_response_and_kill_page(false, "Not Tutor", 403);
        } else {
            if (isset($vars['description'])) {
                $tutor_desc = Tutor::get_Tutor($vars['email']);
                $desc = ($vars['description']);
                $tutor_desc->setLocked($desc);
                if ($tutor_desc->getLocked() === $desc) {
                    AnswerHandler::create_response_and_kill_page(true, "Description changed");
                } else {
                    AnswerHandler::create_response_and_kill_page(false, "Change unsuccessful");
                }
            } else {
                AnswerHandler::create_response_and_kill_page(false, 'Tutor missing', 400);
            }
        }

        if (isset($vars['teaching_method'])) {
            $tutor_tm = Tutor::get_Tutor($vars['email']);
            $tm = ($vars['teaching_method']);
            $tutor_tm->setLocked($tm);
            if ($tutor_tm->getLocked() === $tm) {
                AnswerHandler::create_response_and_kill_page(true, "Teaching Method Changed");
            } else {
                AnswerHandler::create_response_and_kill_page(false, "Change unsuccessful");
            }
        } else {
            AnswerHandler::create_response_and_kill_page(false, 'User missing', 400);
        }

    }


    /**
     * Remove the specified resource from storage.
     */
    public
    static function destroy()
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
