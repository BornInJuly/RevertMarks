<?php

function revert_marks($haystack) {

    //Нахожу в строке все символы из набора и записываю в массив $positions

    function multineedle_stripos($haystack, $needles, $offset=0) {
        foreach($needles as $needle) {
            $found[$needle] = mb_stripos($haystack, $needle, $offset);
        }
        return $found;
    }

    $needle = array('.',',','!','?',';',':','-');

    $positions = multineedle_stripos($haystack, $needle);

    //Разбиваю массив на ключи и значения, если значение не нулевое

    //Отражаю массив

    $i = 0;
    
    foreach ($positions as $sign => $position) {
        if($position != 0) {
            $keys[$i] = $sign;
            $poss[$i] = $position;
            $i++;
            $rkeys = array_reverse($keys);
        }
    }

    //Перевожу строку в массив

    $haystackmassin = preg_split('//u', $haystack, -1, PREG_SPLIT_NO_EMPTY);

    //Создаю массив для замены

    $replacements = array_combine($poss,$rkeys);

    //Заменяю массив

    $haystackmassout = array_replace($haystackmassin, $replacements);

    //Перевожу обратно в строку

    $haystackout = implode("", $haystackmassout);

    return $haystackout;
}

    echo revert_marks('Привет! Как дела?');



?>