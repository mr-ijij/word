<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Word;
use App\Domain\WordAllList;
use App\Domain\WordList;
use LogicException;

class WordRepository implements WordRepositoryInterface
{
    private string $csvDirPath;

    public static function create(): self
    {
        return new self();
    }

    public function __construct()
    {
        $this->csvDirPath = dirname(__DIR__) . '/../Data/';
    }

    public function findAll(): WordAllList
    {
        $directoryPathList = $this->getAllDirectoryPath();

        $wordAllList = [];
        foreach ($directoryPathList as $directoryPath) {
            $files = $this->getAllFilePath($directoryPath);
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

                $wordAllList[] = new WordList((int)basename($directoryPath), (int)$fileName, $wordList);
            }
        }

        return new WordAllList($wordAllList);
    }

    /**
     * @return string[]
     */
    private function getAllDirectoryPath(): array
    {
        $directories = [];
        foreach (array_filter(glob($this->csvDirPath . '*'), 'is_dir') as $directory)  {
            $directories[] = $directory . '/';
        }

        return $directories;
    }

    /**
     * @return string[]
     */
    private function getAllFilePath(string $directoryPath): array
    {
        if (!is_dir($directoryPath)) {
            throw new LogicException(sprintf('CSV file directory not found: {%s}', $directoryPath));
        }

        $files = [];
        if ($handle = opendir($directoryPath)) {
            while (($file = readdir($handle)) !== false) {
                if ($file !== '.' && $file !== '..') {
                    $files[] = $directoryPath . $file;
                }
            }
            closedir($handle);
        }

        return $files;
    }
}
