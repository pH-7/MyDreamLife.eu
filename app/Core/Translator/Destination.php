<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types = 1);

namespace Core\Translator;

use Core\Translator\Exception\InvalidFormatException;

class Destination
{
    /** @var array */
    private static $destinationNames = [
        'asia' => 'Asia',
        'west-europe' =>'Western Europe',
        'east-europe' => 'Eastern Europe',
        'north-europe' =>'Northern Europe',
        'baltic-europe' => 'Baltic States',
        'oceania' => 'Oceania',
        'japan-korea' => 'Japan/South Korea',
        'south-america' => 'South America',
        'central-america' => 'Central America',
        'north-america' => 'North America',
        'africa' => 'Africa'
    ];

    /**
     * @param string $destination
     *
     * @throws InvalidFormatException
     */
    public function __construct(string $destination)
    {
        if (
            empty(self::$destinationNames[$destination])
        ) {
            throw new InvalidFormatException(sprintf('%s is an invalid destination key.', $destination));
        }

        $this->destination = $destination;
    }

    public function getValue(): string
    {
        return self::$destinationNames[$this->destination];
    }
}
