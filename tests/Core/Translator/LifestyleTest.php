<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017-2018, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types = 1);

namespace Test\Core\Translator;

use Core\Translator\Lifestyle;
use PHPUnit\Framework\TestCase;

class LifestyleTest extends TestCase
{
    public function testValidValue(): void
    {
        $lifestyle = new Lifestyle('adventure');
        $this->assertSame('Adventure', $lifestyle->getValue());
    }

    /**
     * @expectedException \Core\Translator\Exception\InvalidFormatException
     */
    public function testInvalidValue(): void
    {
        new Lifestyle('blablabla');
    }
}
