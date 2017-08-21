<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types = 1);

namespace Model;

use Core\Database;

class Itinerary
{
    public static function insert(array $binds): void
    {
        Database::query("INSERT INTO itinerary (email, residence, nationality, destination, gender, age, lifestyle, background, job, saving, availability) VALUES(:email, :residence, :nationality, :destination, :gender, :age, :lifestyle, :background, :job, :saving, :availability)", $binds);
    }
}
