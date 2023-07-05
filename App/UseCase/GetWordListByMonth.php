<?php

declare(strict_types=1);

namespace App\UseCase;

use App\Domain\WordList;
use App\Repository\WordRepository;
use App\Repository\WordRepositoryInterface;

class GetWordListByMonth
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

    public function execute(int $monthNum): WordList
    {
        $wordAllList = $this->wordRepository->findAll();
        $wordList = $wordAllList->filterByMonth($monthNum);
        $wordList->shuffle();

        return $wordList;
    }
}
