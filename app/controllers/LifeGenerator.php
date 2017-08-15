<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

class LifeGenerator extends BaseController
{
    public function __construct()
    {
        session_start();
        //$this->loadModel('kik');
    }

    public function residence()
    {
        View::create('my-residence', 'Get the D.R.E.A.M. Life you are looking for!');
    }

    public function nationality()
    {
        View::create('my-nationality', 'My Nationality');

        $residence = Input::post('residence');
        if ($residence) {
            $_SESSION['residence'] = $residence;
        } else {
            redirect('my-residence');
        }
    }

    public function destination()
    {
        View::create('my-destination', 'The destination you wish to go');

        $nationality = Input::post('nationality');
        if ($nationality) {
            $_SESSION['nationality'] = $nationality;
        } else {
            redirect('my-nationality');
        }
    }

    public function age()
    {
        View::create('my-age', 'My Age');

        $destination = Input::post('destination');
        if ($destination) {
            $_SESSION['destination'] = $destination;
        } else {
            redirect('my-destination');
        }
    }

    public function gender()
    {
        View::create('my-gender', 'My Sex');

        $age = Input::post('age');
        if ($age) {
            $_SESSION['age'] = $age;
        } else {
            redirect('my-age');
        }
    }

    public function lifestyle()
    {
        View::create('my-lifestyle', 'My Lifestyle');

        $gender = Input::post('gender');
        if ($gender) {
            $_SESSION['gender'] = $gender;
        } else {
            redirect('my-gender');
        }
    }

    public function background()
    {
        View::create('my-background', 'My Background..?');

        $lifestyle = Input::post('lifestyle');
        if ($lifestyle) {
            $_SESSION['lifestyle'] = $lifestyle;
        } else {
            redirect('my-lifestyle');
        }
    }

    public function saving()
    {
        View::create('my-saving', 'My Money..$$$ How much do I have..?');

        $background = Input::post('background');
        if ($background) {
            $_SESSION['background'] = $background;
        } else {
            redirect('my-background');
        }
    }

    public function results()
    {
        View::create('my-results', 'Get My New Life Itinerary');

        $saving = Input::post('saving');
        if ($saving) {
            $_SESSION['saving'] = $saving;
        } else {
            redirect('my-saving');
        }

        $email = Input::post('email');
        if ($email) {
            $this->sendResultsEmail($email, $_SESSION);
        } else {
            redirect('my-saving');
        }
    }

    public function notFound()
    {
        header('HTTP/1.1 404 Not Found');

        View::create('not-found', 'Page Not Found');
    }

    private function generateSmartContents(array $data)
    {

    }

    /**
     * @param string $email
     * @param array $vars
     */
    private function sendResultsEmail(string $email, array $vars)
    {
        $from = ADMIN_EMAIL;
        $to = $email;
        $body = $this->generateSmartContents($vars);

        $subject = 'Someone wants to meet you';
        $headers = "From: " . ADMIN_EMAIL . "\r\n";
        $headers .= "Reply-To: " . $from . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $message = '<div style="width: 100%; background-color: #253036; padding: 20px; margin-bottom: 20px;">';
        $message .= '<a href="' . SITE_URL . '" style="color: #7c8b96;">Kik or not</a>';
        $message .= '</div>';
        $message .= 'Hey' . $likedUser->user_name . '! ' . $userData->user_name . ' likes your photo and so interested to meet you.<br />';
        $message .= '<a href="mailto:' . $from . '"><img src="' . $userPhoto . '" alt="' . $userData->user_name . '" title="' . $userData->user_name . ' wants to meet you." /></a>';
        $message .= '<div style="margin-top: 20px; text-align: center; font-size: 12px;">';
        $message .= '&copy; Kik or not</a><br /><br />';
        $message .= '<small>You are receiving this email because you registered to "' . SITE_URL . '" with this email address.</small>';
        $message .= '</div>';

        mail($to, $subject, $message, $headers);
    }
}
