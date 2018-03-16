<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017-2018, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types = 1);

namespace Core\Translator;

use Core\Translator\Exception\InvalidFormatException;

class Saving
{
    const SCORE_POOR = 1;
    const SCORE_OK = 2;
    const SCORE_VERY_GOOD = 3;
    const SCORE_EXCELLENT = 4;

    /** @var int */
    private $savingAmount;

    /** @var array */
    private static $savingEstimations = [
        1000 => 'very small',
        3000 =>'not that much',
        6000 => 'not too bad',
        10000 => 'ok',
        15000 => 'good',
        20000 => 'very good',
        40000 => 'perfect',
        50000 => 'really good'
    ];

    /**
     * @param int $savingAmount
     *
     * @throws InvalidFormatException
     */
    public function __construct($savingAmount)
    {
        if (
            empty(self::$savingEstimations[$savingAmount]) || !ctype_digit($savingAmount)
        ) {
            throw new InvalidFormatException(sprintf('%s is an invalid saving amount.', $savingAmount));
        }

        $this->savingAmount = $savingAmount;
    }

    /**
     * Returns the saving estimation in a readable format.
     *
     * @return string
     */
    public function getValue(): string
    {
        return self::$savingEstimations[$this->savingAmount];
    }

    public function getSavingScore(): int
    {
        if ($this->savingAmount >= 1000 && $this->savingAmount <= 3000) {
            return self::SCORE_POOR;
        }

        if ($this->savingAmount >= 6000 && $this->savingAmount <= 15000) {
            return self::SCORE_OK;
        }

        if ($this->savingAmount >= 20000 && $this->savingAmount <= 40000) {
            return self::SCORE_VERY_GOOD;
        }

        if ($this->savingAmount >= 50000) {
            return self::SCORE_EXCELLENT;
        }
    }
}
