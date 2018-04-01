<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017-2018, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types = 1);

namespace Test\Core\Translator;

use Core\Translator\Exception\InvalidFormatException;
use Core\Translator\Nationality;
use PHPUnit\Framework\TestCase;

class NationalityTest extends TestCase
{
    public function testValidValue(): void
    {
        $country = new Nationality('be');
        $this->assertSame('Belgian', $country->getValue());
    }

    /**
     * @param string $nationalityCode
     *
     * @dataProvider invalidNationalityCodesProvider
     */
    public function testInvalidValue(string $nationalityCode): void
    {
        $this->expectException(InvalidFormatException::class);

        new Nationality($nationalityCode);
    }

    public function invalidNationalityCodesProvider(): array
    {
        return [
            [''],
            ['a'],
            ['ii'],
            ['djdjdj']
        ];
    }
}
