<?php

declare(strict_types=1);

namespace App\Domain;

class WordList
{
    /**
     * @param Word[] $words
     */
    public function __construct(
        private int $year,
        private int $month,
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

    public function getYear(): int
    {
        return $this->year;
    }

    public function getMonth(): int
    {
        return $this->month;
    }

    /**
     * @return array[]
     */
    public function toArray(): array
    {
        $result = [];
        foreach ($this->getAll() as $word) {
            $result[] = [
                'year' => $this->year,
                'month' => $this->month,
                'word' => $word->toArray(),
            ];
        }

        return $result;
    }
}
