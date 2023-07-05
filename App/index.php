<?php

declare(strict_types=1);

require dirname(__DIR__) . '/App/vendor/autoload.php';

use App\View\Cli;
use App\View\Web;

if (php_sapi_name() === 'cli') {
    if (!isset($argv[1])) {
        echo '1つ目の引数がありません。' , PHP_EOL;
        echo '1: 英語の書きのテスト' , PHP_EOL;
        echo '2: 日本語の読みのテスト' , PHP_EOL;
        exit;
    }

    if (!isset($argv[2])) {
        echo '2つ目の引数がありません。' , PHP_EOL;
        echo '何月文のテストをするか' , PHP_EOL;
        exit;
    }

    $cliView = Cli::create();

    if ($argv[1] === '1') {
        $cliView->englishTest((int)$argv[1]);
    } else {
        $cliView->japaneseTest((int)$argv[2]);
    }
} else {
    // Webからの実行
    $web = new Web();
    $web->execute();
}
