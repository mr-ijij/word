<?php

declare(strict_types=1);

namespace Src\App;

use LogicException;

class EnglishWordTesting
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
    }
}
