<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasicCSController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function countingSort(Request $request): array
    {
        $request->validate([
            'unsortedArray' => 'required|array'
        ]);

        $unsortedArray = $request->get('unsortedArray');
        $min = min($unsortedArray);
        $max = max($unsortedArray);

        $count = [];
        for ($i = $min; $i <= $max; $i++) {
            $count[$i] = 0;
        }

        foreach ($unsortedArray as $number) {
            $count[$number]++;
        }

        $counter = 0;
        for ($i = $min; $i <= $max; $i++) {
            while ($count[$i]-- > 0) {
                $unsortedArray[$counter++] = (int)$i;
            }
        }

        return $unsortedArray;
    }

    /**
     * @return float
     */
    public function microtime(): float
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

    /**
     * @return array
     */
    public function getUnsortedArray(): array
    {
        $array = [];
        for ($i = 0; $i < 10000; $i++) {
            $a = rand(100, 10000);
            $b = rand(100, 10000);
            $array[] = pow($a, $b);
        }

        return $array;
    }

    /**
     * @param $array
     * @return array
     */
    public function radixSort($array): array
    {
        //Create a bucket of arrays
        $bucket = array_fill(0, 9, []);
        $maxDigits = 0;
        //Determine the maximum number of digits in the given array.
        foreach ($array as $value) {
            $numDigits = strlen((string)$value);
            if ($numDigits > $maxDigits)
                $maxDigits = $numDigits;
        }
        $nextSigFig = false;
        for ($k = 0; $k < $maxDigits; $k++) {
            for ($i = 0; $i < count($array); $i++) {
                if (!$nextSigFig)
                    $bucket[$array[$i] % 10][] = $array[$i];
                else
                    $bucket[floor(($array[$i] / pow(10, $k))) % 10][] = $array[$i];
            }
            //Reset array and load back values from bucket.
            $array = [];
            for ($j = 0; $j < count($bucket); $j++) {
                foreach ($bucket[$j] as $value) {
                    $array[] = $value;
                }
            }
            //Reset bucket
            $bucket = array_fill(0, 9, []);
            $nextSigFig = true;
        }
        return $array;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function radixSortWithDuration(): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $startTime = $this->microtime();
        $this->radixSort($this->getUnsortedArray());
        $endTime = $this->microtime();

        return response([
            'duration' => $endTime - $startTime,
        ]);
    }
}
