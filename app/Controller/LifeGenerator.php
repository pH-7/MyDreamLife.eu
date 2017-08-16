<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

namespace Controller;

use Core\View;
use Core\Input;
use Core\Session;

class LifeGenerator extends Base
{
    public function __construct()
    {
        parent::__construct();

        //$this->loadModel('kik');
    }

    public function residence()
    {
        View::create('my-residence', 'Get the D.R.E.A.M. Life I Am Looking For!');
    }

    public function nationality()
    {
        View::create('my-nationality', 'My Nationality');

        $residence = Input::post('residence');
        if ($residence) {
            Session::set('residence', $residence);
        } else {
            redirect('my-residence');
        }
    }

    public function destination()
    {
        View::create('my-destination', 'The Destination I Wish to Go');

        $nationality = Input::post('nationality');
        if ($nationality) {
            Session::set('nationality', $nationality);
        } else {
            redirect('my-nationality');
        }
    }

    public function gender()
    {
        View::create('my-gender', 'My Sex');

        $destination = Input::post('destination');
        if ($destination) {
            Session::set('destination', $destination);
        } else {
            redirect('my-destination');
        }
    }

    public function age()
    {
        View::create('my-age', 'My Age');

        $gender = Input::post('gender');
        if ($gender) {
            Session::set('gender', $gender);
        } else {
            redirect('my-gender');
        }
    }

    public function lifestyle()
    {
        View::create('my-lifestyle', 'My Lifestyle');

        $age = Input::post('age');
        if ($age) {
            Session::set('age', $age);
        } else {
            redirect('my-age');
        }
    }

    public function background()
    {
        View::create('my-background', 'My Background..?');

        $lifestyle = Input::post('lifestyle');
        if ($lifestyle) {
            Session::set('lifestyle', $lifestyle);
        } else {
            redirect('my-lifestyle');
        }
    }

    public function job()
    {
        View::create('job-type', 'Kind of Job I Want to Do');

        $background = Input::post('background');
        if ($background) {
            Session::set('background', $background);
        } else {
            redirect('my-background');
        }
    }

    public function saving()
    {
        View::create('my-saving', 'My Money..$$$ How much do I have..?');

        $job = Input::post('job');
        if ($job) {
            Session::set('job', $job);
        } else {
            redirect('job-type');
        }
    }

    public function availability()
    {
        View::create('availability', 'When I Am Available..?');

        $saving = Input::post('saving');
        if ($saving) {
            Session::set('saving', $saving);
        } else {
            redirect('my-saving');
        }
    }

    public function results()
    {
        View::create('get-results', 'Get My New Life Itinerary');

        $availability = Input::post('availability');
        if ($availability) {
            Session::set('availability', $availability);
        } else {
            redirect('availability');
        }
    }

    public function confirmation()
    {
        View::create('confirmation', 'Well Done!');

        $email = Input::post('email');
        if ($email) {
            $_SESSION['email'] = $email;
            $this->sendResultsEmail($_SESSION);
        } else {
            redirect('get-results');
        }
    }

    private function generateSmartContents(array $data): string
    {
        /*$message = '<div style="width: 100%; background-color: #253036; padding: 20px; margin-bottom: 20px;">';
        $message .= '<a href="' . SITE_URL . '" style="color: #7c8b96;">Kik or not</a>';
        $message .= '</div>';
        $message .= 'Hey' . $likedUser->user_name . '! ' . $userData->user_name . ' likes your photo and so interested to meet you.<br />';
        $message .= '<a href="mailto:' . $from . '"><img src="' . $userPhoto . '" alt="' . $userData->user_name . '" title="' . $userData->user_name . ' wants to meet you." /></a>';
        $message .= '<div style="margin-top: 20px; text-align: center; font-size: 12px;">';
        $message .= '&copy; Kik or not</a><br /><br />';
        $message .= '<small>You are receiving this email because you registered to "' . SITE_URL . '" with this email address.</small>';
        $message .= '</div>';*/

        $message = print_r($data, true);

        return $message;
    }

    private function sendResultsEmail(array $vars)
    {
        $from = ADMIN_EMAIL;
        $to = $vars['email'];
        $body = $this->generateSmartContents($vars);

        $subject = 'New DREAM-LIFE Application';
        $headers = "From: " . ADMIN_EMAIL . "\r\n";
        $headers .= "Reply-To: " . $from . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $message = $this->generateSmartContents($vars);

        mail(ADMIN_EMAIL, $subject, $message, $headers);
    }
}
