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
    public function getWordList(): array
    {
        return $this->wordAllList;
    }

    public function filterByMonth(int $monthNum): WordList
    {
        foreach ($this->wordAllList as $wordList) {
            if ($wordList->getMonthNum() === $monthNum) {
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
        foreach ($this->getWordList() as $wordList) {
            $result[$wordList->getMonthNum()] = $wordList->toArray();
        }

        return $result;
    }
}
