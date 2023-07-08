<?php

declare(strict_types=1);

namespace App\View;

use App\UseCase\GetWordListAll;

final class Web
{
    public static function create(): self
    {
        return new self(
            GetWordListAll::create(),
        );
    }

    public function __construct(
        private GetWordListAll $getWordListAll
    ) {
    }

    public function execute(): void
    {
        $wordList = $this->getWordListAll->execute()->toArray();
        $wordListJson = htmlspecialchars(json_encode($wordList), ENT_QUOTES, 'UTF-8');

        echo <<< EOT
        <!DOCTYPE html>
        <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" href="./Static/img/favicon.ico">
            <title>ijij</title>
            <script src="./Static/js/index.js" data-wordlist="$wordListJson"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        </head>
        <body>
            <div class="content"></div>
        </body>
        </html>
        EOT;
    }
}
