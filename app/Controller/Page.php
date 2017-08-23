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
    const POST_DATA_PATH = 'app/data/posts/en/';
    const POST_FILE_EXT = '.txt';

    /** @var array */
    private $posts = [
        1 => [
            'uri' => 'easiest-way-to-work-abroad',
            'title' => 'Easiest Way To Work Abroad! Working Holiday Visa',
            'vimeoId' => 230046783,
            'description' => 'Work in New Zealand with the WHV.'
        ],
        2 => [
            'uri' => 'working-in-japan',
            'title' => 'Working In Japan',
            'vimeoId' => 160301271,
            'description' => 'Go Living and Working in Japan, in Tokyo, Kyoto, Osaka can definitely be the best experience of your life! Do NOT Procrastinate!'
        ],
    ];

    public function __construct()
    {
        $this->posts[] = [
            'uri' => 'how-to-open-a-bank-account-in-ireland',
            'title' => 'How To Open a Bank Account in Ireland',
            'imageUrl' => 'https://images.unsplash.com/photo-1462045504115-6c1d931f07d1?dpr=2&auto=format&fit=crop&w=600&h=400&q=80',
            'description' => $this->getPostFromTxtData('how-to-open-bank-account-in-ireland')
        ];
    }

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

    private function getPostFromTxtData(string $filename)
    {
        return nl2br(file_get_contents(self::POST_DATA_PATH . $filename . self::POST_FILE_EXT));
    }
}