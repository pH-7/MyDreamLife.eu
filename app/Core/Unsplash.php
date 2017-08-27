<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

declare(strict_types = 1);

namespace Core;

class Unsplash
{
    const API_URL = 'https://images.unsplash.com/';

    const DEFAULT_WIDTH = 600;
    const DEFAULT_HEIGHT = 400;
    const DEFAULT_QUALITY = 80;

    /** @var string */
    private $imageId;

    /** @var int */
    private $width = self::DEFAULT_WIDTH;

    /** @var int */
    private $height = self::DEFAULT_HEIGHT;

    /** @var int */
    private $quality = self::DEFAULT_QUALITY;

    public function setWidth(int $width): Unsplash
    {
        $this->width = $width;

        return $this;
    }

    public function setHeight(int $height): Unsplash
    {
        $this->height = $height;

        return $this;
    }

    public function setQuality(int $quality): Unsplash
    {
        $this->quality = $quality;

        return $this;
    }

    public function setImageId(string $imageId): Unsplash
    {
        $this->imageId = $imageId;

        return $this;
    }

    public function getImage(): string
    {
        $imageUrl = self::API_URL . $this->imageId;

        $options = [
            'dpr' => 2,
            'auto' => 'format',
            'fit' => 'crop',
            'w' => $this->width,
            'h' => $this->height,
            'q' => $this->quality
        ];

        return $this->buildUrl($imageUrl, $options);
    }

    private function buildUrl(string $url, array $args): string
    {
        return $url . '?' . http_build_query($args, '', '&amp;');
    }
}