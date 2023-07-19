<?php

declare(strict_types=1);

use App\Domain\Word;
use PHPUnit\Framework\TestCase;

class WordTest extends TestCase
{
    public static function toArrayDataProvider(): array
    {
        return [
            'apple' => [
                'word' => new Word('apple', 'りんご'),
                'expected' => [
                    'englishWord' => 'apple',
                    'japaneseWord' => 'りんご',
                ],
            ],
            'orange' => [
                'word' => new Word('orange', 'オレンジ'),
                'expected' => [
                    'englishWord' => 'orange',
                    'japaneseWord' => 'オレンジ',
                ],
            ],
            'banana' => [
                'word' => new Word('banana', 'バナナ'),
                'expected' => [
                    'englishWord' => 'banana',
                    'japaneseWord' => 'バナナ',
                ],
            ],
        ];
    }
    /**
     * @dataProvider toArrayDataProvider
     */
    public function testToArray($word, $expected): void
    {
        $this->assertEquals(
            $expected,
            $word->toArray()
        );
    }
}