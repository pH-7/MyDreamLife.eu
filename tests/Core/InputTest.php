<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017-2018, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types=1);

namespace Test\Core;

use Core\Input;
use PHPUnit\Framework\TestCase;

class InputTest extends TestCase
{
    public function testPost(): void
    {
        $_POST['hi'] = 'Hi Am!';

        $this->assertSame('Hi Am!', Input::post('hi'));
    }

    public function testUnsetPostKey(): void
    {
        $this->assertFalse(Input::post('nothing'));
    }

    public function testGet(): void
    {
        $_GET['hi'] = 'I Am!';

        $this->assertSame('I Am!', Input::get('hi'));
    }

    public function testUnsetGetKey(): void
    {
        $this->assertFalse(Input::get('lalala'));
    }

    protected function tearDown(): void
    {
        unset($_POST, $_GET);
    }
}
