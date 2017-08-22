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

        $templateVariables = [
            Variables::NATIONALITY,
            Variables::NATIONALITY_COUNTRY,
            Variables::RESIDENCY_COUNTRY,
            Variables::DESTINATION_AREA
        ];

        $userValues = [
            $nationality->getValue(),
            $nationalityCountry->getValue(),
            $residencyCountry->getValue(),
            $this->userData['destination']
        ];

        return str_replace($templateVariables, $userValues, $this->templateContents);
    }
}
