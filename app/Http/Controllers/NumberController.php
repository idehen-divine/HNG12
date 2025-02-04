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

        // Validate input (must be an integer)
        if (!is_numeric($number) || intval($number) != $number) {
            return response()->json([
                "number" => 'alphabet',
                "error" => true
            ], 400);
        }

        $number = intval($number);

        // Check properties
        $isPrime = $this->isPrime($number);
        $isPerfect = $this->isPerfect($number);
        $isArmstrong = $this->isArmstrong($number);
        $isOdd = $number % 2 !== 0;
        $digitSum = array_sum(str_split($number));

        // Get fun fact from Numbers API
        $funFactResponse = Http::get("http://numbersapi.com/{$number}/math");
        $funFact = $funFactResponse->successful() ? $funFactResponse->body() : "No fun fact available.";

        // Determine properties array
        $properties = [];
        if ($isArmstrong) {
            $properties[] = "armstrong";
        }
        $properties[] = $isOdd ? "odd" : "even";

        // JSON response
        return response()->json([
            "number" => $number,
            "is_prime" => $isPrime,
            "is_perfect" => $isPerfect,
            "properties" => $properties,
            "digit_sum" => $digitSum,
            "fun_fact" => $funFact
        ]);
    }

    // Check if number is prime
    private function isPrime($num)
    {
        if ($num < 2) return false;
        for ($i = 2; $i * $i <= $num; $i++) {
            if ($num % $i == 0) return false;
        }
        return true;
    }

    // Check if number is perfect
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

    // Check if number is Armstrong
    private function isArmstrong($num)
    {
        $digits = str_split($num);
        $power = count($digits);
        $sum = array_sum(array_map(fn($d) => pow($d, $power), $digits));
        return $sum === $num;
    }
}
