<?php

declare(strict_types=1);

namespace App\Domain;

class Word
{
    public function __construct(
        private string $englishWord,
        private string $japaneseWord
    ) {
    }

    public function getEnglishWord(): string
    {
        return $this->englishWord;
    }

    public function getJapaneseWord(): string
    {
        return $this->japaneseWord;
    }
}
