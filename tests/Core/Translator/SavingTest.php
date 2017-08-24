<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types = 1);

namespace Test\Core\Translator;

use Core\Translator\Saving;
use PHPUnit\Framework\TestCase;

class SavingTest extends TestCase
{
  /**
   * @param int $savingAmount
   * @param string $savingEstimation
   *
   * @dataProvider validSavingsProvider
   */
    public function testValidSaving(int $savingAmount, string $savingEstimation): void
    {
        $saving = new Saving($savingAmount);
        $this->assertSame($savingEstimation, $saving->getValue());
    }

    /**
     * @param int $savingAmount
     * @param string $savingEstimation
     * @param int $savingScore
     *
     * @dataProvider validSavingsProvider
     */
      public function testSavingScore(int $savingAmount, string $savingEstimation, int $savingScore): void
      {
          $saving = new Saving($savingAmount);
          $this->assertSame($savingScore, $saving->getSavingScore());
      }

    /**
     * @param int $savingAmount
     *
     * @expectedException \Core\Translator\Exception\InvalidFormatException
     *
     * @dataProvider invalidSavingsProvider
     */
    public function testInvalidValue($savingAmount): void
    {
        new Saving($savingAmount);
    }

    public function validSavingsProvider(): array
    {
        return [
            [1000, 'very small', Saving::SCORE_POOR],
            [3000, 'not that much', Saving::SCORE_POOR],
            [6000, 'not too bad', Saving::SCORE_OK],
            [10000, 'ok', Saving::SCORE_OK],
            [15000, 'good', Saving::SCORE_OK],
            [20000, 'very good', Saving::SCORE_VERY_GOOD],
            [40000, 'perfect', Saving::SCORE_VERY_GOOD],
            [50000, 'really good', Saving::SCORE_EXCELLENT]
        ];
    }

    public function invalidSavingsProvider(): array
    {
        return [
            ['not an amount'],
            [44040],
            [000]
        ];
    }
}
