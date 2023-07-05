<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Word;
use App\Domain\WordAllList;
use App\Domain\WordList;
use LogicException;

class WordRepository implements WordRepositoryInterface
{
    private string $csvFileDir = '';

    public static function create(): self
    {
        return new self();
    }

    public function __construct()
    {
        $this->csvFileDir = dirname(__DIR__) . '/../Data/2023/';
    }

    public function findAll(): WordAllList
    {
        $files = $this->getAllFilePath();

        $wordAllList = [];
        foreach ($files as $filePath) {
            $fileName = '';
            $wordList = [];
            if (($handle = fopen($filePath, 'r')) !== false) {
                while (($data = fgetcsv($handle, 10000, ',')) !== false) {
                    if (count($data) !== 2) {
                        continue;
                    }
                    $wordList[] = new Word($data[0], $data[1]);
                }

                $fileName = pathinfo($filePath, PATHINFO_FILENAME);

                fclose($handle);
            } else {
                throw new LogicException("Unable to open CSV file: {$filePath}\n");
            }

            if (empty($fileName)) {
                throw new LogicException("Unable to get file name: {$filePath}\n");
            }

            $wordAllList[] = new WordList((int)$fileName, $wordList);
        }

        return new WordAllList($wordAllList);
    }

    /**
     * @return string[]
     */
    private function getAllFilePath(): array
    {
        if (!is_dir($this->csvFileDir)) {
            throw new LogicException(sprintf('CSV file directory not found: {%s}', $this->csvFileDir));
        }

        $files = [];
        if ($handle = opendir($this->csvFileDir)) {
            while (($file = readdir($handle)) !== false) {
                if ($file !== '.' && $file !== '..') {
                    $files[] = $this->csvFileDir . $file;
                }
            }
            closedir($handle);
        }

        return $files;
    }
}
