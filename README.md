## evaluate_math_string
 Since PHP [create_function](http://php.net/manual/en/function.create-function.php)  got deprecated as of PHP v7.2, we can no longer use that function to evaluate math string at the quickest way. I have created a very simple PHP function that can evaluate math string without any other dependencies.
 
## How to use?

Please check test.php

## Example Expressions

| Input         | Output           |
| ------------- |-------------|
| -3            |  3 |
| +5            | +5 |
| 5+2           |  7 |
| -5-1          | -6 |
| 5-1           |  4 |
| 2 + 2.5 + 3 / 3 + 3 * 3      |  14.5 |
| 5 + 10 /-2 - 5 *2      |  -10 |
| ((5 - 2.5) + 2) * ((5 - 2.5) + 2)      |  20.25 |
| (((5 - 2.5) + 2) * ( 10 / 5))      |   9 |
| 5-(-2)      |   7 |

## Caveats
Please be noted that for the sake of simplicity, this function will not raise any errors in case of the syntax problem. It will simply end up with zero or an ambiguous output. You must provide a valid syntax to get the correct result. 
