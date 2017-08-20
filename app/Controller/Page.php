<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

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
    ];

    public function about()
    {
        View::create('page/about', 'Who is behind it?');
    }

    public function posts()
    {
        View::create('page/posts', 'Posts', ['posts' =>$this->posts]);
    }

    public function post()
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