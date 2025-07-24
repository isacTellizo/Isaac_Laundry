<?php

namespace App\Livewire;

use Livewire\Component;

class Practice extends Component
{
    public $message, $age, $numberMessage, $number;
    public $multiplying_number, $result, $numbers;
    public $numbers_entered, $numbers_result, $even_numbers = [], $odd_numbers = [];
    public $alphabet, $is_active = true;
    public function render()
    {
        // $numbers = [1,2,3,4,5];
        // array_splice($numbers,2,1);
        // dd($numbers);
        // $numbers_one = [1, 2, 3, 4];
        // dd($this->multiply($numbers_one));

        return view('livewire.practice');
    }

    public function checkAge()
    {
        if ($this->age > 18) {
            $this->message = 'You are an Adult';
            return;
        }
        $this->message = 'Your are a Minor';
    }

    public function checkNumber()
    {
        if ($this->number % 2 == 0) {
            $this->numberMessage = "Its an Even Number";
            return;
        }
        $this->numberMessage = "Its an Odd number";
    }

    public function max($array)
    {
        $largest = 0;
        foreach ($array as $item) {
            if ($item > $largest) {
                $largest = $item;
            }
        }
        return $largest;
    }

    public function totalSum($array)
    {
        $sum = 0;
        foreach ($array as $item) {
            $sum += $item;
        }
        return $sum;
    }

    public function multiply()
    {
        $this->result = 0;
        $numberArray = explode(",", $this->numbers);
        foreach ($numberArray as $item) {
            $this->result += $this->multiplying_number * $item;
        }
        $this->multiplying_number = '';
        $this->numbers = '';
    }

    public function orderArrays()
    {
        $people = [
            'sophia' => 31,
            'jacob' => 52,
            'william' => 18,
            'ramesh' => 25,
        ];
        ksort($people);
        foreach ($people as $key => $row) {
            dump($key . "=>" . $row);
        }
    }

    public function sortEvenAndOdd()
    {
        $numberArray = explode(',', $this->numbers_entered);

        foreach ($numberArray as $item) {
            if ($item % 2 == 0) {
                array_push($this->even_numbers, $item);
            } else {
                array_push($this->odd_numbers, $item);
            }
        }
    }

    public function squareArrays()
    {
        $numbers = [10, 20, 30, 40];
        $result = [];
        foreach ($numbers as $num) {
            array_push($result, $num * $num);
        }
        dd($result);
    }

    public function squareUsingMap()
    {
        $numbers = [10, 20, 30, 40];

        $result = array_map(function ($n) {
            $output = $n * $n;
            return $output;
        }, $numbers);

        dd($result);
    }

    public function addPrefix()
    {
        $names = ['John', 'Sarah', 'Kennedy'];
        $prefix = "Mr./Ms. ";
        $output = [];
        foreach ($names as $item) {
            array_push($output, $prefix . $item);
        }
        dd($output);
    }

    public function addPrefixUsingMap()
    {
        $names = [
            ['name' => 'John'],
            ['name' => 'Sarah'],
            ['name' => 'Kennedy']
        ];

        $output = array_map(function ($item) {
            $prefix = "Mr./Ms. ";
            return $item['name'] =  $prefix . $item['name'];
        }, $names);

        dd($output);
    }

    public function celsiusToFahrenheit()
    {
        $celsius = [1, 20, 50];
        $result = [];
        foreach ($celsius as $item) {
            array_push($result, ($item * 9 / 5) + 32);
        }
        dd($result);
    }

    public function celsiusToFahrenheitUsingMap()
    {
        $celsius = [1, 20, 50];

        $result = array_map(function ($item) {
            return ($item * 9 / 5) + 32;
        }, $celsius);
        dd($result);
    }

    public function multiplyWithTax()
    {
        $prices = [100, 400, 300];
        $result = [];
        $tax = 0.18;
        foreach ($prices as $item) {
            $result[] = ($item + $tax);
        }
        dd($result);
    }

    public function addIndex()
    {
        $fruits = ["banana", "apple", "mango"];
        $result = [];
        foreach ($fruits as $key => $item) {
            $result[] = $key . " : " . $item;
        }
        dd($result);
    }

    public function filterEven()
    {
        $num = [1, 2, 3, 4, 5, 6];
        $result = [];
        foreach ($num as $item) {
            if ($item % 2 == 0) {
                $result[] = $item;
            }
        }
        dd($result);
    }

    public function doWhile()
    {
        $n = 1;
        do {
            dump($n);
            $n++;
        } while ($n % 2 == 0);
    }

    public function doWhileArray()
    {
        $i = 3;
        do {
            $numbers = explode(",", $this->numbers_entered);
            dump(array_map(function ($number) {
                return $number * 2;
            }, $numbers));
        } while ($i > 4);
    }

    public function switchCase()
    {
        switch ($this->alphabet) {
            case "a":
                dd("Apple");
                break;
            case 'b':
                dd("Ball");
                break;
            case 'c':
                dd("Cat");
                break;
            case 'd':
                dd("Dog");
                break;
            default:
                dd('Coming Soon');
        }
    }

    public function switchCaseArray()
    {
        $numbers = [1, 4, 5, 6, 8, 10, 9, 13, 17, 92];
        $even_numbers = [];
        $odd_numbers = [];
        foreach ($numbers as $item) {
            switch ($item) {
                case $item % 2 == 0:
                    array_push($even_numbers, $item);
                    break;
                case $item % 2 !== 0:
                    array_push($odd_numbers, $item);
                    break;
            }
        }
        dd("Even Numbers", $even_numbers);
        dd("Odd_Numbers", $odd_numbers);
    }

    public function changeStatus()
    {
        if ($this->is_active) {
            $this->is_active = 0;
        } else {
            $this->is_active = 1;
        }
    }
}
