<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/**
 * @group Number Operations
 * @groupDescription Handles mathematical analysis and classification of numbers, providing detailed properties and interesting facts about given numbers.
 */
class NumberController extends Controller
{
    /**
     * Number Classification
     *
     * Analyzes a number and returns its mathematical properties including primality,
     * perfectness, Armstrong status, odd/even status, digit sum and a fun math fact.
     *
     * @queryParam number integer required The number to analyze. Example: 153
     *
     * @response 200 {
     *   "number": 153,
     *   "is_prime": false,
     *   "is_perfect": false,
     *   "properties": ["armstrong", "odd"],
     *   "digit_sum": 9,
     *   "fun_fact": "153 is the sum of the cubes of its own digits"
     * }
     *
     * @response 400 scenario="Invalid Input" {
     *   "number": "alphabet",
     *   "error": true
     * }
     *
     * @responseField number integer The analyzed number
     * @responseField is_prime boolean Whether the number is prime
     * @responseField is_perfect boolean Whether the number is perfect
     * @responseField properties array List of number properties (armstrong, odd/even)
     * @responseField digit_sum integer Sum of all digits in the number
     * @responseField fun_fact string An interesting mathematical fact about the number
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function classifyNumber(Request $request)
    {
        $number = $request->query('number');

        if (!is_numeric($number) || intval($number) != $number) {
            return response()->json([
                "number" => 'alphabet',
                "error" => true
            ], 400);
        }

        $number = intval($number);

        $isPrime = $this->isPrime($number);
        $isPerfect = $this->isPerfect($number);
        $isArmstrong = $this->isArmstrong(abs($number));
        $isOdd = $number % 2 !== 0;
        $digitSum = $this->digitSum($number);

        $funFactResponse = Http::get("http://numbersapi.com/{$number}/math");
        $funFact = $funFactResponse->successful() ? $funFactResponse->body() : "No fun fact available.";

        $properties = [];
        if ($isArmstrong) {
            $properties[] = "armstrong";
        }
        $properties[] = $isOdd ? "odd" : "even";

        return response()->json([
            "number" => $number,
            "is_prime" => $isPrime,
            "is_perfect" => $isPerfect,
            "properties" => $properties,
            "digit_sum" => $digitSum,
            "fun_fact" => $funFact
        ]);
    }

    /**
     * Checks if the given number is prime.
     *
     * @param int $num The number to check for primality.
     * @return bool True if the number is prime, false otherwise.
     */
    private function isPrime($num)
    {
        if ($num < 2) return false;
        for ($i = 2; $i * $i <= $num; $i++) {
            if ($num % $i == 0) return false;
        }
        return true;
    }

    /**
     * Checks if the given number is a perfect number.
     *
     * A perfect number is a positive integer that is equal to the sum of its proper divisors, excluding the number itself.
     *
     * @param int $num The number to check for perfection.
     * @return bool True if the number is perfect, false otherwise.
     */
    private function isPerfect($num)
    {
        $sum = 0;
        for ($i = 1; $i < $num; $i++) {
            if ($num % $i == 0) {
                $sum += $i;
            }
        }
        return $sum === $num;
    }

    /**
     * Checks if the given number is an Armstrong number.
     *
     * An Armstrong number is a number that is equal to the sum of the cubes of its digits.
     *
     * @param int $num The number to check for being an Armstrong number.
     * @return bool True if the number is an Armstrong number, false otherwise.
     */
    private function isArmstrong($num)
    {
        $digits = str_split($num);
        $power = count($digits);
        $sum = array_sum(array_map(fn($d) => pow($d, $power), $digits));
        return $sum === $num;
    }

    /**
     * Calculates the sum of the digits of the given number.
     *
     * @param int $num The number to calculate the digit sum for.
     * @return int The sum of the digits of the number.
     */
    private function digitSum($num)
    {
        $sum = array_sum(str_split((string) abs($num)));
        return $num < 0 ? -$sum : $sum;
    }
}
