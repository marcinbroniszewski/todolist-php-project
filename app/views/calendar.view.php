<?php

declare(strict_types=1);

function create_calendar(string $year, string $month, string $day) {

   $year_number = intval($year);
   $month_number = intval($month);
   $day_number = intval($day); 


$first_day = date("N", strtotime("$year-$month-01"));
$last_day = date("t", strtotime("$year-$month-01"));
$last_date_of_last_month = date("t", strtotime("-1 day", strtotime("$year-$month-01")));

$start_prev_month_day = $last_date_of_last_month - $first_day + 2;

$day_counter = 0;
$tableHTML = "<tr>";

//Dodawanie dni z poprzedniego miesiąca

for ($i = $start_prev_month_day; $i <= $last_date_of_last_month; $i++) {
    if($day_counter === 7) {
        $tableHTML .= "</tr><tr>";
        $day_counter = 0;
    }

    $tableHTML .= "<td class='prev-month-day date'>$i</td>";

    $day_counter++;
}

//Dodawanie dni z aktualnego miesiąca

for ($i = 1; $i <= $last_day; $i++) {
    if($day_counter === 7) {
        $tableHTML .= "</tr><tr>";
        $day_counter = 0;
    }

    if ($i === $day_number) {
        $tableHTML .= "<td class='date active'>$i</td>";
    } else {
        $tableHTML .= "<td class='date'>$i</td>";
    }

    $day_counter++;
}


//Dodawanie dni z następnego miesiąca

if ($day_counter !== 0) {
$left_days = 7 - $day_counter;

for ($i = 1; $i <= $left_days; $i++) {
    $tableHTML .= "<td class='next-month-day date'>$i</td>";

    $day_counter++;
}
$day_counter = 0;
}

$tableHTML .= "</tr></tbody></table>";
echo $tableHTML;
}