<?php

declare(strict_types=1);

namespace Src\App;

use App\Util\CliUtil;
use LogicException;

class JapaneseWordTesting
{
    /**
     * @param string $csvFile
     */
    public static function create(string $csvFile): self
    {
        return new self($csvFile);
    }

    public function __construct(
        private string $csvFile
    ) {
        if (empty($this->csvFile)) {
            throw new LogicException('CSV file is empty.');
        }

        if (!file_exists($this->csvFile)) {
            throw new LogicException("CSV file not found: {$this->csvFile}\n");
        }
    }

    public function execute(): void
    {
        $rows = [];
        if (($handle = fopen($this->csvFile, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $rows[] = $data;
            }
            fclose($handle);
        } else {
            echo "Unable to open CSV file: {$this->csvFile}\n";
            exit(1);
        }

        shuffle($rows);
        foreach ($rows as $row) {
            list($englishWord, $japaneseWord) = $row;
            echo '-------------------------------' , PHP_EOL;
            echo "英語: {$englishWord}\n";
            echo "日本語を入力してください: ";
            echo sprintf('入力した日本語: %s', CliUtil::consoleInput()), PHP_EOL;

            echo $japaneseWord, PHP_EOL;
            echo PHP_EOL;
        }
    }
}
