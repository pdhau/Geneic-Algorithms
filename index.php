<?php
class GAs
{
    const max = 10000;
    public $khoangcach = [
        [self::max, 5, 6, 9, self::max],
        [5, self::max, 10, 2, 7],
        [6, 10, self::max, self::max, 15],
        [9, 2, self::max, self::max, 1],
        [self::max, 7, 15, 1, self::max]
    ];
    public $n = 1000;
    public $nghiem = [];
    public $thichnghi = [];

    public function khoitao()
    {
        for ($i = 0; $i < $this->n-1; $i++) {
            $this->nghiem[$i] = [];
            for ($j = 0; $j < 5; $j++) {
                $this->nghiem[$i][$j] = rand(0, 4);
            }
        }
    }

    public function danhgia()
    {
        for ($i = 0; $i < $this->n; $i++) {
            $this->thichnghi[$i] = 0;
            for ($j = 0; $j < 4; $j++) {
                $temp = $this->nghiem[$i][$j];
                $temp2 = $this->nghiem[$i][$j + 1];
                if($temp2 > 4){
                    die('ok');
                }
                $this->thichnghi[$i] += $this->khoangcach[$temp][$temp2];
            }
            for ($j = 0; $j < 4; $j++) {

                for ($t = $j + 1; $t < 5; $t++) {

                    if ($this->nghiem[$i][$j] == $this->nghiem[$i][$t]) $this->thichnghi[$i] += 100000;
                }
            }
        }
    }

    public function chonloc()
    {
        $temp = $this->thichnghi;
        sort($temp);
        $nguong = $temp[$this->n * 80 / 100];
        for ($i = 0; $i < $this->n; $i++) {
            if ($this->thichnghi[$i] > $nguong) {
                $this->nghiem[$i] = $this->nghiem[rand(0, $this->n - 1)];
            }
        }
    }

    public function laighep()
    {
        for ($i = 0; $i < 20; $i++) {
            $cha = rand(0, $this->n-1);
            $me = rand(0, $this->n-1);
            for ($j = 0; $j < count($this->nghiem[$cha])-1; $j++) {
                if (rand(1, 2) == 1) {
                    $temp = $this->nghiem[$cha][$j];
                    $this->nghiem[$cha][$j] = $this->nghiem[$me][$j];
                    $this->nghiem[$me][$j] = $temp;
                }
            }
        }
    }

    public function dotbien()
    {
        $index = rand(0, $this->n);
        $bit = rand(0, 5);
        $this->nghiem[$index][$bit] = rand(0, 4);
    }

    public function output()
    {
        $temp = $this->thichnghi;
        sort($temp);
        $best = $temp[0];
        echo "{$best}: ";
        for ($i = 0; $i < $this->n; $i++) {
            if ($this->thichnghi[$i] == $best) {
                for ($j = 0; $j < count($this->nghiem[$i]); $j++) {
                    echo $this->nghiem[$i][$j]+1 . " ,";
                }
                echo "\n";
                break;
            }
        }
    }
}

$abc = new GAs();
$abc->khoitao();
for ($i = 0; $i < 100; $i++) {
    $abc->danhgia();
    $abc->chonloc();
    $abc->laighep();
    $abc->dotbien();
    $abc->output();
}
