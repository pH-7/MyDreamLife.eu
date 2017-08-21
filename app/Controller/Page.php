<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types = 1);

namespace Controller;

use Core\Input;
use Core\View;

class Page extends Base
{
    /** @var array */
    private $posts = [
        1 => [
            'title' => 'Easiest Way To Work Abroad! Working Holiday Visa',
            'vimeoId' => 230046783,
            'description' => 'Work in New Zealand with the WHV.'
        ],
        2 => [
            'title' => 'Working In Japan',
            'vimeoId' => 160301271,
            'description' => 'Go Living and Working in Japan, in Tokyo, Kyoto, Osaka can definitely be the best experience of your life! Do NOT Procrastinate!'
        ],
    ];

    public function about(): void
    {
        View::create('page/about', 'Who is behind it?');
    }

    public function posts(): void
    {
        View::create('page/posts', 'Posts', ['posts' => $this->posts]);
    }

    public function post(): void
    {
        $postId = Input::get('id');
        if ($postId && ctype_digit($postId) && isset($this->posts[$postId])) {
            $postData = $this->posts[$postId];
            View::create('page/post', $postData['title'], $postData);
        } else {
            (new Base)->notFound();
        }
    }
}