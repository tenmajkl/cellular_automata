<?php

function out(array $mat): void
{
    system('clear');
    foreach ($mat as $y => $line) {
        foreach ($line as $x => $cell) {
            echo ($cell ? '*' : ' ').'|';
        }
        echo PHP_EOL;
    }
}

function generate(int $size): array 
{
    $a = [];
    for ($i = 0; $i < $size; $i++) {
        for ($j = 0; $j < $size; $j++) {
            $a[$i][$j] = rand() % 2;
        }
    }

    return $a;
}

$f = $argv[1] ?? die('KANEC EXPLOZE');

if (is_numeric($f)) {
    $mat = generate((int) $f);
} else {
    $content = file_get_contents($f);

    $lines = explode(PHP_EOL, $content);
    $mat = array_map(fn($i) => array_map(fn($i) => (int) $i, str_split($i)), $lines);
}

$h = $mat;

while (1) {
    out($mat);
    foreach ($mat as $y => $line) {
        foreach ($line as $x => $cell) {
            $state = 
                ($mat[$y][$x + 1] ?? 0) 
                + ($mat[$y][$x - 1] ?? 0) 
                + ($mat[$y + 1][$x] ?? 0) 
                + ($mat[$y - 1][$x] ?? 0)
                + ($mat[$y + 1][$x + 1] ?? 0) 
                + ($mat[$y - 1][$x - 1] ?? 0) 
                + ($mat[$y + 1][$x - 1] ?? 0) 
                + ($mat[$y - 1][$x + 1] ?? 0)
            ; 

            if ($cell === 0) {
                $h[$y][$x] = (int)($state === 3);
                continue;
            }

            $state += $cell;

            $h[$y][$x] = (int)($state === 3 || $state === 4);
        }
    }

    if ($mat === $h) {
        break;
    }

    $mat = $h;
    sleep(1);
}
