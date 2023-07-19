<?php

declare(strict_types=1);

use App\Domain\DomainException;
use App\Domain\Word;
use App\Domain\WordAllList;
use App\Domain\WordList;
use PHPUnit\Framework\TestCase;

class WordAllListTest extends TestCase
{
    public function testGetWordList(): void
    {
        $expectedWord = new WordList(
            2023,
            1,
            [
                new Word('apple', 'りんご'),
                new Word('orange', 'オレンジ'),
                new Word('banana', 'バナナ')
            ]
        );
        $expectedWord2 = new WordList(
            2023,
            2,
            [
                new Word('pineapple', 'パイナップル'),
                new Word('grape', 'ぶどう'),
            ]
        );
        $wordAllList = new WordAllList([
            $expectedWord,
            $expectedWord2,
        ]);

        $this->assertEquals($expectedWord, $wordAllList->getWordList(2023, 1));
        $this->assertEquals($expectedWord2, $wordAllList->getWordList(2023, 2));
    }

    public function testGetWordList_NG(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('WordList not found.');

        $expectedWord = new WordList(
            2023,
            1,
            [
                new Word('apple', 'りんご'),
                new Word('orange', 'オレンジ'),
                new Word('banana', 'バナナ')
            ]
        );
        $expectedWord2 = new WordList(
            2023,
            2,
            [
                new Word('pineapple', 'パイナップル'),
                new Word('grape', 'ぶどう'),
            ]
        );
        $wordAllList = new WordAllList([
            $expectedWord,
            $expectedWord2,
        ]);

        $wordAllList->getWordList(2023, 3);
    }

    public function testGetHasYearAndMonth(): void
    {
        $wordAllList = new WordAllList([
            new WordList(
                2023,
                1,
                [
                    new Word('apple', 'りんご'),
                    new Word('orange', 'オレンジ'),
                    new Word('banana', 'バナナ')
                ]
            ),
            new WordList(
                2023,
                2,
                [
                    new Word('pineapple', 'パイナップル'),
                    new Word('grape', 'ぶどう'),
                ]
            ),
            new WordList(
                2024,
                1,
                [
                    new Word('lemon', 'レモン'),
                    new Word('melon', 'メロン'),
                    new Word('watermelon', 'スイカ')
                ]
            ),
        ]);

        $actual = $wordAllList->getHasYearAndMonth();

        $this->assertEquals(
            [
                2023 => [1, 2],
                2024 => [1],
            ],
            $actual
        );
    }
}
