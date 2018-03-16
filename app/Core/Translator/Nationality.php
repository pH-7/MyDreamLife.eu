<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017-2018, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types = 1);

namespace Core\Translator;

use Core\Translator\Exception\InvalidFormatException;

class Nationality
{
    const NATIONALITY_CODE_LENGTH = 2;

    /** @var string */
    private $nationalityCode;

    /** @var array */
    private static $nationalityNames = [
        'fr' => 'French',
        'es' =>'Spanish',
        'de' => 'German',
        'be' => 'Belgian',
        'nl' => 'Dutch',
        'it' => 'Italian',
        'pl' => 'Polish',
        'ch' => 'Swiss'
    ];

    /**
     * @param string $nationalityCode
     *
     * @throws InvalidFormatException
     */
    public function __construct(string $nationalityCode)
    {
        if (
            empty(self::$nationalityNames[$nationalityCode]) ||
            strlen($nationalityCode) !== self::NATIONALITY_CODE_LENGTH
        ) {
            throw new InvalidFormatException(sprintf('%s is an invalid nationality code.', $nationalityCode));
        }

        $this->nationalityCode = $nationalityCode;
    }

    /**
     * Returns the nationality name.
     *
     * @return string
     */
    public function getValue(): string
    {
        return self::$nationalityNames[$this->nationalityCode];
    }
}
