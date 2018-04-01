<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017-2018, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types = 1);

namespace Test\Core\Translator;

use Core\Translator\Destination;
use Core\Translator\Exception\InvalidFormatException;
use PHPUnit\Framework\TestCase;

class DestinationTest extends TestCase
{
    public function testValidValue(): void
    {
        $destination = new Destination('asia');
        $this->assertSame('Asia', $destination->getValue());
    }

    public function testInvalidValue(): void
    {
        $this->expectException(InvalidFormatException::class);

        new Destination('Continent');
    }
}
