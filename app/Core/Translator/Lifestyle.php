<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types = 1);

namespace Core\Translator;

use Core\Translator\Exception\InvalidFormatException;

class Lifestyle
{
    /** @var string */
    private $lifestyle;

    /** @var array */
    private static $lifestyleNames = [
        'big-cities' => 'Big Cities',
        'adventure' =>'Adventure',
        'nature' => 'Nature',
        'nightlife' => 'Nightlife, Bars, ...',
    ];

    /**
     * @param string $lifestyle
     *
     * @throws InvalidFormatException
     */
    public function __construct(string $lifestyle)
    {
        if (empty(self::$lifestyleNames[$lifestyle])) {
            throw new InvalidFormatException(sprintf('%s is an invalid lifestyle type.', $lifestyle));
        }

        $this->lifestyle = $lifestyle;
    }

    /**
     * Returns the lifestyle name.
     *
     * @return string
     */
    public function getValue(): string
    {
        return self::$lifestyleNames[$this->lifestyle];
    }
}