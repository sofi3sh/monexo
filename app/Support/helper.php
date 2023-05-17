<?php

if (! function_exists('strMasking')) {
    /**
     * Маскирует часть строки
     *
     * @param string $str
     * @param string $maskingCharacter
     * @param int $leftOffset
     * @param int $rightOffset
     * @return string
     */
    function strMasking(string $str, string $maskingCharacter = '*', int $leftOffset = 3, int $rightOffset = 3): string
    {
        return substr($str, 0, $leftOffset) .
            str_repeat($maskingCharacter, strlen($str) - ($leftOffset + $rightOffset)) .
            substr($str, -$rightOffset);
    }
}
