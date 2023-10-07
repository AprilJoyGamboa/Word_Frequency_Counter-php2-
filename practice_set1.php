<?php
/**
 * Calculate the total price of items in a shopping cart.
 *
 * @param array $items An array of items, each with 'name' and 'price' keys.
 *
 * @return float The total price of all items.
 */
function calculateTotalPrice(array $items): float {
    $total = 0;
    foreach ($items as $item) {
        $total += $item['price'];
    }
    return $total;
}

/**
 * Modify a string by removing spaces and converting it to lowercase.
 *
 * @param string $inputString The input string to be modified.
 *
 * @return string The modified string.
 */
function modifyString(string $inputString): string {
    $string = str_replace(' ', '', $inputString);
    $string = strtolower($string);
    return $string;
}

/**
 * Determine whether a number is even or odd.
 *
 * @param int $number The number to check.
 *
 * @return string A message indicating whether the number is even or odd.
 */
function checkEvenOrOdd(int $number): string {
    if ($number % 2 === 0) {
        return "The number $number is even.";
    } else {
        return "The number $number is odd.";
    }
}

// Example usage:

$items = [
    ['name' => 'Widget A', 'price' => 10],
    ['name' => 'Widget B', 'price' => 15],
    ['name' => 'Widget C', 'price' => 20],
];

$totalPrice = calculateTotalPrice($items);
echo "Total price: $" . $totalPrice;

$inputString = "This is a poorly written program with little structure and readability.";
$modifiedString = modifyString($inputString);
echo "\nModified string: " . $modifiedString;

$number = 42;
$result = checkEvenOrOdd($number);
echo "\n$result";