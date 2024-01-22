<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Exception\NotFoundException;

class Config
{

    public static function get(string $filename, string $key = null): mixed
    {
        $fileContent = self::getFileContent($filename);
        if ($key == null) {
            return $fileContent;
        }
        return isset($fileContent[$key]) ? $fileContent[$key] : [];
    }

    public static function getFileContent(string $filename): array
    {
        $filecontent = [];
        try {
            $path = realpath(sprintf(__DIR__ . '/../Configs/%s.php', $filename));
            if (file_exists($path)) {
                $filecontent = require $path;
            }
        } catch (\Throwable $th) {
            // die($th->getMessage());
            throw new NotFoundException(
                sprintf('The Specified file %s was not found', $filename),
                ['Not found file', 'set data']
            );
        }
        return $filecontent;
    }
}
