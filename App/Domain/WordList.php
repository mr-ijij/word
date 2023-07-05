<?php

declare(strict_types=1);

namespace App\Domain;

class WordList
{
    /**
     * @param Word[] $words
     */
    public function __construct(
        private int $monthNum,
        private array $words = []
    ) {
    }

    public function shuffle(): void
    {
        shuffle($this->words);
    }

    /**
     * @return Word[]
     */
    public function getAll(): array
    {
        return $this->words;
    }

    public function getMonthNum(): int
    {
        return $this->monthNum;
    }
}
