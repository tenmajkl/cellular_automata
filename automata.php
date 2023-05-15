<?php

// If you are reading this, I'm sorry. I must have done something really wrong in life.

// This function is here to clean your sins and your screen
function out(array $mat): void
{
    system('clear'); // Like washing your soul, but for your terminal.
    foreach ($mat as $y => $line) {
        foreach ($line as $x => $cell) {
            echo ($cell ? '*' : ' ') . '|'; // Printing stars because we're all rockstars here
        }
        echo PHP_EOL; // New line, new opportunities, new hopes... nah, just kidding.
    }
}

// Generate chaos, but in an organized way.
function generate(int $size): array 
{
    $a = [];
    for ($i = 0; $i < $size; $i++) {
        for ($j = 0; $j < $size; $j++) {
            $a[$i][$j] = rand() % 2; // Because why should we make things simple?
        }
    }

    return $a; // Here's your chaos, served cold.
}

// If you reached this point without a parameter, God have mercy on your soul.
$f = $argv[1] ?? die('KANEC EXPLOZE. No seriously, what were you thinking?!');

// If you think this is a mess, just wait until you see the rest of it.
if (is_numeric($f)) {
    $mat = generate((int) $f); // Generating more chaos, because why not?
} else {
    $content = file_get_contents($f); // Reading the content, or as I like to call it, "the beginning of the end"

    $lines = explode(PHP_EOL, $content); // Breaking lines like my ex broke my heart
    $mat = array_map(fn($i) => array_map(fn($i) => (int) $i, str_split($i)), $lines); // Casting to integer, because we're civilized people
}

$h = $mat; // Copying stuff around because we can

// Welcome to the infinite loop of despair and sadness.
while (1) {
    out($mat); // Let's see the damage.
    foreach ($mat as $y => $line) {
        foreach ($line as $x => $cell) {
            // This is some math magic. Don't touch it. It bites.
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
                continue; // Nothing to see here, move along.
            }

            $state += $cell; // More math magic. Why? Because we can.

            $h[$y][$x] = (int)($state === 3 || $state === 4); // If you
            // If you understood what's happening here, congratulations! You've achieved a higher state of confusion.
            // If you didn't, join the club. 
        }
    }

    // So you thought this was gonna end, didn't you?
    if ($mat === $h) {
        break; // Break free from this madness
    }

    $mat = $h; // The never-ending game of copy-paste. 
    sleep(1); // Let's take a nap, we've done enough damage for now.
}

// If you made it till here, congratulations! You've survived!
// Now, go out and take a walk. You deserve it.
