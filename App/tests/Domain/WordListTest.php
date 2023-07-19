<?php

declare(strict_types=1);

use App\Domain\Word;
use App\Domain\WordList;
use PHPUnit\Framework\TestCase;

class WordListTest extends TestCase
{
    public function testGetAll(): void
    {
        // Wordが複数存在
        $wordList = new WordList(
            2023,
            1,
            [
                new Word('apple', 'りんご'),
                new Word('orange', 'オレンジ'),
                new Word('banana', 'バナナ')
            ]
        );

        $this->assertEquals(
            [
                new Word('apple', 'りんご'),
                new Word('orange', 'オレンジ'),
                new Word('banana', 'バナナ'),
            ],
            $wordList->getAll()
        );

        // Wordが単数存在
        $wordList = new WordList(
            2023,
            1,
            [
                new Word('apple', 'りんご'),
            ]
        );

        $this->assertEquals(
            [
                new Word('apple', 'りんご'),
            ],
            $wordList->getAll()
        );

        // Wordがひとつもない
        $wordList = new WordList(
            2023,
            1,
            []
        );

        $this->assertEquals(
            [],
            $wordList->getAll()
        );
    }

    public function testShuffle(): void
    {
        $words = [
            new Word('apple', 'りんご'),
            new Word('orange', 'オレンジ'),
            new Word('banana', 'バナナ'),
            new Word('grape', 'ぶどう'),
            new Word('strawberry', 'いちご'),
            new Word('melon', 'メロン'),
            new Word('peach', 'もも'),
            new Word('cherry', 'さくらんぼ'),
            new Word('pear', 'なし'),
            new Word('kiwi', 'キウイ'),
            new Word('pineapple', 'パイナップル'),
            new Word('lemon', 'レモン'),
            new Word('mango', 'マンゴー'),
            new Word('watermelon', 'スイカ'),
            new Word('blueberry', 'ブルーベリー'),
            new Word('raspberry', 'ラズベリー'),
            new Word('coconut', 'ココナッツ'),
            new Word('fig', 'イチジク'),
            new Word('pomegranate', 'ザクロ'),
            new Word('persimmon', '柿'),
            new Word('avocado', 'アボカド'),
        ];
        $wordList = new WordList(
            2023,
            1,
            $words
        );

        $wordList->shuffle();

        // 約 0.0000000000000000000000005217%の確率でテストが失敗する
        $this->assertNotSame(
            $words,
            $wordList->getAll()
        );
    }
}
