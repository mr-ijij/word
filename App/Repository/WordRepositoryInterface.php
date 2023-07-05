<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\WordAllList;
use App\Domain\WordList;

interface WordRepositoryInterface
{
    /**
     * @return \App\Domain\WordAllList
     */
    public function findAll(): WordAllList;
}
