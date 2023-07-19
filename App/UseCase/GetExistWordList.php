<?php

declare(strict_types=1);

namespace App\UseCase;

use App\Domain\WordAllList;
use App\Repository\WordRepository;
use App\Repository\WordRepositoryInterface;

class GetExistWordList
{
    public static function create(): self
    {
        return new self(
            WordRepository::create()
        );
    }

    public function __construct(
        private WordRepositoryInterface $wordRepository
    ) {
    }

    public function execute(): array
    {
        $wordAllList = $this->wordRepository->findAll();
        foreach ($wordAllList->getAll() as $wordList) {
            $wordList->shuffle();
        }

        return $wordAllList->getHasYearAndMonth();
    }
}
