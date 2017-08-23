<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types = 1);

namespace Core\Translator;

class Itinerary
{
    const TRAINING_WORDING = "I highly advice you to take some trainings (have a look to Coursera/Audacity websites and read syllabus/books for courses in your field) in order to become THE BEST and get VISA Sponsorship accepted. If you aren't the best, there are lot of chance you don't get your visa";

    const HIGH_LEVEL_DESTINATIONS = [
        'japan-korea',
        'north-america',
        'oceania'
    ];

    /** @var bool */
    private $isHighLevelDestination = false;

    /** @var array */
    private $userData;

    /** @var string */
    private $templateContents;

    /**
     * @param array $userData
     * @param string $templateContents
     */
    public function __construct(array $userData, string $templateContents)
    {
        $this->userData = $userData;
        $this->templateContents = $templateContents;

        if (in_array($this->userData['destination'], self::HIGH_LEVEL_DESTINATIONS)) {
            $this->isHighLevelDestination = true;
        }
    }

    public function generate(): string
    {
        $contents = $this->replaceVariables();

        return $contents;
    }

    private function replaceVariables(): string
    {
        $nationality = new Nationality($this->userData['nationality']);
        $nationalityCountry = new Country($this->userData['nationality']);
        $residencyCountry = new Country($this->userData['residence']);
        $lifestyle = new Lifestyle($this->userData['lifestyle']);
        $training = $this->isHighLevelDestination ? self::TRAINING_WORDING : '';

        $templateVariables = [
            Variables::NATIONALITY,
            Variables::NATIONALITY_COUNTRY,
            Variables::RESIDENCY_COUNTRY,
            Variables::DESTINATION_AREA,
            Variables::LIFESTYLE,
            Variables::TRAINING_NEEDED,
        ];

        $userValues = [
            $nationality->getValue(),
            $nationalityCountry->getValue(),
            $residencyCountry->getValue(),
            $this->userData['destination'],
            $lifestyle->getValue(),
            $training
        ];

        return str_replace($templateVariables, $userValues, $this->templateContents);
    }
}
