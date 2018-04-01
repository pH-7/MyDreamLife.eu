<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017-2018, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types=1);

namespace Controller;

use Core\Input;
use Core\Session;
use Core\Translator\Itinerary as ItineraryTranslator;
use Core\View;

class LifeGenerator extends Base
{
    private const MAX_EMAIL_LENGTH = 120;
    private const MAX_FIELD_VALUE_LENGTH = 20;
    private const COOKIE_NAME_APPLICATION_SENT = 'application_submitted';
    private const ITINERARY_EMAIL_TPL_PATH = 'templates/emails/en/itinerary.txt';
    private const REGEX_AMOUNT_FORMAT = '/(\d{1,2})\d{3}\s/';
    private const CURRENCY_SIGN = '€';

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

            $this->sendApplicationToAdmin($_SESSION);

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

            Session::set(self::COOKIE_NAME_APPLICATION_SENT, true);
        } else {
            redirect('/');
        }
    }

    private function sendApplicationToAdmin(array $vars): bool
    {
        $from = $vars['email'];
        $to = ADMIN_EMAIL;
        $subject = 'New DREAM-LIFE Application';

        $headers = "From: \"{$_SERVER['HTTP_HOST']}\" <{$_SERVER['SERVER_ADMIN']}>\r\n"; // To avoid the email goes to spam
        $headers .= "Reply-To: " . $from . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $message = $this->generateSmartContents($vars);

        $message .= '<br>----- AUTOGENERATED MESSAGE -----<br>';
        $message .= $this->getItineraryEmail($vars);

        return mail($to, $subject, $message, $headers);
    }

    private function generateSmartContents(array $data): string
    {
        $message = print_r($data, true);
        // Note: "$1" in "$1K" is the regex variable from self::REGEX_AMOUNT_FORMAT regex value
        $message = preg_replace(self::REGEX_AMOUNT_FORMAT, self::CURRENCY_SIGN . '$1K', $message);

        return $message;
    }

    private function getItineraryEmail(array $vars): string
    {
        $emailTemplate = $this->getItineraryTemplate();

        $emailContents = (new ItineraryTranslator($vars, $emailTemplate))->generate();

        $message = '<div style="width: 100%; background-color: #ee6e73; padding: 20px; margin-bottom: 20px; text-align: center;">';
        $message .= '<a href="' . SITE_URL . '" style="color: #fff;">Your New Life Itinerary</a>';
        $message .= '</div>';

        $message .= $emailContents;

        $message .= '<div style="margin-top: 20px; text-align: center; font-size: 12px;">';
        $message .= '<small>You are receiving this email because you made an application on "' . SITE_URL . '" with this email address.</small>';
        $message .= '</div>';

        return $message;
    }

    private function getItineraryTemplate(): string
    {
        return nl2br(file_get_contents(self::ITINERARY_EMAIL_TPL_PATH));
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
        return (bool)Session::get('residence') && !Session::get(self::COOKIE_NAME_APPLICATION_SENT);
    }

    private function isSpamBot(): bool
    {
        return (bool)Input::post('name');
    }

    /**
     * @param string $emailAddress
     *
     * @return bool TRUE if the email is unwanted, FALSE otherwise.
     */
    private function isUnwantedEmail(string $emailAddress): bool
    {
        $unwantedHosts = file(APP_PATH . 'config/unwanted/emails.txt');

        return in_array(
            strrchr($emailAddress, '@'),
            array_map('trim', $unwantedHosts),
            true
        );
    }

    private function removeSessions(): void
    {
        $_SESSION = [];
        session_unset();
        session_destroy();
    }
}
