<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types = 1);

namespace Controller;

use Core\Input;
use Core\Session;
use Core\View;

class LifeGenerator extends Base
{
    const MAX_EMAIL_LENGTH = 120;
    const MAX_FIELD_VALUE_LENGTH = 20;

    public function __construct()
    {
        parent::__construct();
    }

    public function residence(): void
    {
        View::create('my-residence', 'Get the D.R.E.A.M. Life I Am Looking For!');
    }

    public function nationality(): void
    {
        View::create('my-nationality', 'My Nationality');

        $residence = Input::post('residence');
        if ($residence && $this->isCorrectLength($residence)) {
            Session::set('residence', $residence);
        } else {
            redirect('my-residence');
        }
    }

    public function destination(): void
    {
        View::create('my-destination', 'The Destination I Wish to Go');

        $nationality = Input::post('nationality');
        if ($nationality && $this->isCorrectLength($nationality)) {
            Session::set('nationality', $nationality);
        } else {
            redirect('my-nationality');
        }
    }

    public function gender(): void
    {
        View::create('my-gender', 'My Sex');

        $destination = Input::post('destination');
        if ($destination && $this->isCorrectLength($destination)) {
            Session::set('destination', $destination);
        } else {
            redirect('my-destination');
        }
    }

    public function age(): void
    {
        View::create('my-age', 'My Age');

        $gender = Input::post('gender');
        if ($gender && $this->isCorrectLength($gender)) {
            Session::set('gender', $gender);
        } else {
            redirect('my-gender');
        }
    }

    public function lifestyle(): void
    {
        View::create('my-lifestyle', 'My Lifestyle');

        $age = Input::post('age');
        if ($age && $this->isCorrectLength($age)) {
            Session::set('age', $age);
        } else {
            redirect('my-age');
        }
    }

    public function background(): void
    {
        View::create('my-background', 'My Background..?');

        $lifestyle = Input::post('lifestyle');
        if ($lifestyle && $this->isCorrectLength($lifestyle)) {
            Session::set('lifestyle', $lifestyle);
        } else {
            redirect('my-lifestyle');
        }
    }

    public function job(): void
    {
        View::create('job-type', 'Kind of Job I Want to Do');

        $background = Input::post('background');
        if ($background && $this->isCorrectLength($background)) {
            Session::set('background', $background);
        } else {
            redirect('my-background');
        }
    }

    public function saving(): void
    {
        View::create('my-saving', 'My Money..$$$ How much do I have..?');

        $job = Input::post('job-type');
        if ($job && $this->isCorrectLength($job)) {
            Session::set('job-type', $job);
        } else {
            redirect('job-type');
        }
    }

    public function availability(): void
    {
        View::create('availability', 'When I Am Available..?');

        $saving = Input::post('saving');
        if ($saving && $this->isCorrectLength($saving)) {
            Session::set('saving', $saving);
        } else {
            redirect('my-saving');
        }
    }

    public function results(): void
    {
        View::create('get-results', 'Get My New Life Itinerary');

        $availability = Input::post('availability');
        if ($availability && $this->isCorrectLength($availability)) {
            Session::set('availability', $availability);
        } else {
            redirect('availability');
        }
    }

    public function confirmation(): void
    {
        View::create('confirmation', 'Well Done!');

        $email = Input::post('email');

        if (
            $this->isFirstSubmission() && !$this->isSpamBot() &&
            $this->isValidEmail($email) && !$this->isUnwantedEmail($email)
        ) {
            if ($email) {
                Session::set('email', $email);
            } else {
                redirect('get-results');
            }

            $this->sendResultsEmail($_SESSION);

            $data = [
                'email' => Session::get('email'),
                'residence' => Session::get('residence'),
                'nationality' => Session::get('nationality'),
                'destination' => Session::get('destination'),
                'gender' => Session::get('gender'),
                'age' => Session::get('age'),
                'lifestyle' => Session::get('lifestyle'),
                'background' => Session::get('background'),
                'job' => Session::get('job-type'),
                'saving' => Session::get('saving'),
                'availability' => Session::get('availability')
            ];

            \Model\Itinerary::insert($data);

            $this->removeSessions();
        } else {
            redirect('/');
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

    private function sendResultsEmail(array $vars): bool
    {
        $from = $vars['email'];
        $to = ADMIN_EMAIL;
        $subject = 'New DREAM-LIFE Application';

        $headers = "From: \"{$_SERVER['HTTP_HOST']}\" <{$_SERVER['SERVER_ADMIN']}>\r\n"; // To avoid the email goes to spam
        $headers .= "Reply-To: " . $from . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $message = $this->generateSmartContents($vars);

        return mail($to, $subject, $message, $headers);
    }

    private function isValidEmail(string $email): bool
    {
        return
            filter_var($email, FILTER_VALIDATE_EMAIL) !== false &&
            strlen($email) <= self::MAX_EMAIL_LENGTH;
    }

    /**
     * @param mixed $fieldValue
     *
     * @return bool
     */
    private function isCorrectLength($fieldValue): bool
    {
        return strlen($fieldValue) <= self::MAX_FIELD_VALUE_LENGTH;
    }

    /**
     * Avoid duplication applications if form has already been resubmitted.
     *
     * @return bool
     */
    private function isFirstSubmission(): bool
    {
        return (bool)Session::get('residence');
    }

    private function isSpamBot(): bool
    {
        return (bool)Input::post('name');
    }

    private function isUnwantedEmail(string $emailAddress): bool
    {
        $unwantedHosts = file(APP_PATH . 'config/unwanted/emails.txt');

        return in_array(strrchr($emailAddress, '@'), array_map('trim', $unwantedHosts));
    }

    private function removeSessions(): void
    {
        $_SESSION = [];
        session_unset();
        session_destroy();
    }
}
