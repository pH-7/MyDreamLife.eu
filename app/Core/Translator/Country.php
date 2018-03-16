<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017-2018, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types = 1);

namespace Core\Translator;

use Core\Translator\Exception\InvalidFormatException;

class Country
{
    const COUNTRY_CODE_LENGTH = 2;

    /** @var string */
    private $countryCode;

    /** @var array */
    private static $countryNames = [
        'fr' => 'France',
        'es' =>'Spain',
        'de' => 'Germany',
        'be' => 'Belgium',
        'nl' => 'Netherlands',
        'it' => 'Italy',
        'pl' => 'Poland',
        'ch' => 'Switzerland'
    ];

    /**
     * @param string $countryCode
     *
     * @throws InvalidFormatException
     */
    public function __construct(string $countryCode)
    {
        if (
            empty(self::$countryNames[$countryCode]) ||
            strlen($countryCode) !== self::COUNTRY_CODE_LENGTH
        ) {
            throw new InvalidFormatException(sprintf('%s is an invalid country code.', $countryCode));
        }

        $this->countryCode = $countryCode;
    }

    /**
     * Returns the country name.
     *
     * @return string
     */
    public function getValue(): string
    {
        return self::$countryNames[$this->countryCode];
    }
}
