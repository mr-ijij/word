<?php

declare(strict_types=1);

namespace App\Domain;

class WordAllList
{
    /**
     * @param WordList[] $wordAllList
     */
    public function __construct(
        private array $wordAllList
    ) {
    }

    /**
     * @return WordList[]
     */
    public function getAll(): array
    {
        return $this->wordAllList;
    }

    public function getWordList(int $year, int $month): WordList
    {
        foreach ($this->wordAllList as $wordList) {
            if (
                $wordList->getYear() === $year &&
                $wordList->getMonth() === $month
            ) {
                return $wordList;
            }
        }

        throw new DomainException('WordList not found.');
    }

    /**
     * @return array[]
     */
    public function toArray(): array
    {
        $result = [];
        foreach ($this->getAll() as $wordList) {
            $result[] = $wordList->toArray();
        }

        return $result;
    }

    public function getHasYearAndMonth(): array
    {
        $result = [];
        foreach ($this->getAll() as $wordList) {
            $result[$wordList->getYear()][] = $wordList->getMonth();
        }

        foreach ($result as $year => $months) {
            sort($months);
            $result[$year] = $months;
        }

        return $result;
    }
}
