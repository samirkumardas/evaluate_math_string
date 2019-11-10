<?php 
require('evaluate_math.php');

/* Test cases */
$tests = array(
    '-3',
    '+5', 
    '5+2', 
    '-5-1', 
    '5-1', 
    '2 + 2.5 + 3 / 3 + 3 * 3', 
    '5 + 10 /-2 - 5 *2',
    '((5 - 2.5) + 2) * ((5 - 2.5) + 2)',
    '(((5 - 2.5) + 2) * ( 10 / 5))',
    '5-(-2)'
);
foreach($tests as $test) {
    echo $test . '= '. evaluate_math_string($test) . '<br />';
}

?>
