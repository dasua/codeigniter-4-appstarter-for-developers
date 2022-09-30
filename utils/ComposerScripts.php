<?php

declare(strict_types=1);

namespace Utils;

final class ComposerScripts
{
    private static string $gitPath  = __DIR__ . '/../.git/hooks';
    private static string $gitHooks = __DIR__ . '/git/hooks';

    public static function postInstall(): void
    {
        self::installGitHooks();
    }

    public static function installGitHooks(): void
    {
        if (! is_dir(self::$gitPath) || ! is_writable(self::$gitPath)) {
            echo '.git directory not found';

            return;
        }

        if (! is_dir(self::$gitHooks) || ! is_readable(self::$gitHooks)) {
            echo 'Git hooks directory not found: ' . self::$gitHooks;

            return;
        }

        $fd = opendir(self::$gitHooks);
        if (! $fd) {
            echo 'Unexpected error';

            return;
        }

        while ($file = readdir($fd)) {
            $hookFile = self::$gitHooks . '/' . $file;
            if (is_file($hookFile) && is_readable($hookFile)) {
                $destFile = self::$gitPath . '/' . $file;
                echo sprintf("Installing %s\n", $hookFile);
                copy($hookFile, $destFile);
                chmod($destFile, 0755);
            }
        }

        closedir($fd);
    }
}
