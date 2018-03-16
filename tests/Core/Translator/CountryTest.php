<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017-2018, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types = 1);

namespace Test\Core\Translator;

use Core\Translator\Country;
use PHPUnit\Framework\TestCase;

class CountryTest extends TestCase
{
    public function testValidValue(): void
    {
        $country = new Country('be');
        $this->assertSame('Belgium', $country->getValue());
    }

    /**
     * @param string $countryCode
     *
     * @dataProvider invalidCountryCodesProvider
     *
     * @expectedException \Core\Translator\Exception\InvalidFormatException
     */
    public function testInvalidValue(string $countryCode): void
    {
        new Country($countryCode);
    }

    public function invalidCountryCodesProvider(): array
    {
        return [
            [''],
            ['a'],
            ['ii'],
            ['djdjdj']
        ];
    }
}
