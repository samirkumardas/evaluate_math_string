<?php 

function evaluate_math_string($str) {

    $__eval = function ($str) use(&$__eval){
        $error = false;
        $div_mul = false;
        $add_sub = false;
        $result = 0;

        $str = preg_replace('/[^\d.+\-*\/()]/i','',$str);
        $str = rtrim(trim($str, '/*+'),'-');

        /* lets first tackle parentheses */
        if ((strpos($str, '(') !== false &&  strpos($str, ')') !== false)) {
            $regex = '/\(([\d.+\-*\/]+)\)/';
            preg_match($regex, $str, $matches);
            if (isset($matches[1])) {
                return $__eval(preg_replace($regex, $__eval($matches[1]), $str, 1));
            }
        }

        /* Remove unwanted parentheses */
        $str = str_replace(array('(',')'), '', $str);
        /* now division and multiplication */
        if ((strpos($str, '/') !== false ||  strpos($str, '*') !== false)) {
            $div_mul = true;
            $operators = array('*','/');
            while(!$error && $operators) {
                $operator = array_pop($operators);
                while($operator && strpos($str, $operator) !== false) {
                   if ($error) {
                      break;
                   }
                   $regex = '/([\d.]+)\\'.$operator.'(\-?[\d.]+)/';
                   preg_match($regex, $str, $matches);
                   if (isset($matches[1]) && isset($matches[2])) {
                          if ($operator=='+') $result = (float)$matches[1] + (float)$matches[2];
                          if ($operator=='-') $result = (float)$matches[1] - (float)$matches[2]; 
                          if ($operator=='*') $result = (float)$matches[1] * (float)$matches[2]; 
                          if ($operator=='/') {
                             if ((float)$matches[2]) {
                                $result = (float)$matches[1] / (float)$matches[2];
                             } else {
                                $error = true;
                             }
                          }
                          $str = preg_replace($regex, $result, $str, 1);
                          $str = str_replace(array('++','--','-+','+-'), array('+','+','-','-'), $str);
                   } else {
                      $error = true;
                   }
                }
            }
        }
         
        if (!$error && (strpos($str, '+') !== false ||  strpos($str, '-') !== false)) {
            //tackle duble negation 
            $str = str_replace('--', '+', $str);
            $add_sub = true;
            preg_match_all('/([\d\.]+|[\+\-])/', $str, $matches);
            if (isset($matches[0])) {
                $result = 0;
                $operator = '+';
                $tokens = $matches[0];
                $count = count($tokens);
                for ($i=0; $i < $count; $i++) { 
                    if ($tokens[$i] == '+' || $tokens[$i] == '-') {
                        $operator = $tokens[$i];
                    } else {
                        $result = ($operator == '+') ? ($result + (float)$tokens[$i]) : ($result - (float)$tokens[$i]);
                    }
                }
            }
        }
        if (!$error && !$div_mul && !$add_sub) {
             $result = (float)$str;
        }
        return $error ? 0 : $result;
    };
    return $__eval($str);
}
?>