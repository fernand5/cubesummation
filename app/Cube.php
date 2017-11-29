<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cube extends Model
{
    private $n;
    private $m;
    private $matrix;
    private $tree;

    public function __construct($n,$m)
    {
        $this->n=$n;
        $this->m=$m;
        $this->generateMatrix();
    }

    public function generateMatrix(){
        for($i=0;$i<$this->n;$i++){
            for($j=0;$j<$this->n;$j++){
                for($z=0;$z<$this->n;$z++){
                    $this->matrix[$i][$j][$z]=0;
                }
            }
        }
        for($i=0;$i<$this->n+1;$i++){
            for($j=0;$j<$this->n+1;$j++){
                for($z=0;$z<$this->n+1;$z++){
                    $this->tree[$i][$j][$z]=0;
                }
            }
        }
    }
    public function getMatrix(){
        return $this->matrix;
    }
    public function getValuePosition($x,$y,$z){
        if($x>$this->n || $y>$this->n || $z>$this->n){
            return false;
        }else if($x<0||$y<0||$z<0){
            return false;
        }else{
            return $this->matrix[$x][$y][$z];
        }

    }
    public function printMatrix(){
        for($i=0;$i<$this->n;$i++){
            for($j=0;$j<$this->n;$j++){
                for($z=0;$z<$this->n;$z++){
                    echo $this->matrix[$i][$j][$z]." ";
                }
                echo "<br>";
            }
            echo "<br>";
        }
    }

    public function printTree(){
        for($i=0;$i<$this->n+1;$i++){
            for($j=0;$j<$this->n+1;$j++){
                for($z=0;$z<$this->n+1;$z++){
                    echo $this->tree[$i][$j][$z]." ";
                }
                echo "\n";
            }
            echo "\n";
        }
    }

    public function setValuePosition($x, $y, $z, $value) {

        $delta = $value - $this->matrix[$x][$y][$z];
        $this->matrix[$x][$y][$z] = $value;
        for ($i = $x + 1; $i <= $this->n; $i += $i & (-$i)) {
            for ($j = $y + 1; $j <= $this->n; $j += $j & (-$j)) {
                for ($k = $z + 1; $k <= $this->n; $k += $k & (-$k)) {
                    $this->tree[$i][$j][$k] +=  $delta;
                }
            }
        }
        return true;
    }


    public function getQuery($x1, $y1, $z1, $x2, $y2, $z2) {

        $result = $this->sum($x2+1,$y2+1,$z2+1) -
            $this->sum($x1,$y1,$z1) -
            $this->sum($x1,$y2+1,$z2+1) -
            $this->sum($x2+1,$y1,$z2+1) -
            $this->sum($x2+1,$y2+1,$z1) +
            $this->sum($x1,$y1,$z2+1) +
            $this->sum($x1,$y2+1,$z1) +
            $this->sum($x2+1,$y1,$z1);

        return $result;
    }

    public function sum($x, $y, $z) {
        $sum = 0;
        for ($i = $x; $i > 0; $i -= $i & (-$i)) {
            for ($j = $y; $j > 0; $j -= $j & (-$j)) {
                for ($k = $z; $k > 0; $k -= $k & (-$k)) {
                    $sum+=$this->tree[$i][$j][$k];
                }
            }
        }
        return $sum;
    }
}
