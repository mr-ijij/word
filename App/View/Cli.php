<?php

declare(strict_types=1);

namespace App\View;

use App\UseCase\GetWordListByMonth;
use App\Util\CliUtil;

class Cli
{
    public static function create(): self
    {
        return new self(
            GetWordListByMonth::create(),
        );
    }

    public function __construct(
        private GetWordListByMonth $GetWordListByMonth
    ) {
    }

    public function englishTest(int $monthNum): void
    {
        $wordList = $this->GetWordListByMonth->execute($monthNum);
        foreach ($wordList->getAll() as $word) {
            echo '-------------------------------' , PHP_EOL;
            echo "日本語| ", $word->getJapaneseWord(), PHP_EOL;
            echo '英語を入力してください| ';
            $input = trim(CliUtil::consoleInput());

            if (strtolower($input) === strtolower($word->getEnglishWord())) {
                echo "o\n";
            } else {
                echo "x\n";
                echo "正解: {$word->getEnglishWord()}\n";
            }
            echo PHP_EOL;
        }
    }

    public function japaneseTest(int $monthNum): void
    {
        $wordList = $this->GetWordListByMonth->execute($monthNum);
        foreach ($wordList->getAll() as $word) {
            echo '-------------------------------' , PHP_EOL;
            echo "英語| {$word->getEnglishWord()}\n";
            echo "日本語を入力してください| ";
            echo sprintf('入力した日本語| %s', CliUtil::consoleInput()), PHP_EOL;

            echo $word->getJapaneseWord(), PHP_EOL;
            echo PHP_EOL;
        }
    }
}
