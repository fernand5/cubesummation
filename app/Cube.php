<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cube extends Model
{
    private $n;
    private $m;
    private $matrix;

    public function __construct($n,$m)
    {
        $this->n=$n;
        $this->m=$m;
        $this->generateMatrix();
    }

    public function generateMatrix(){
        for($i=1;$i<=$this->n;$i++){
            for($j=1;$j<=$this->n;$j++){
                for($z=1;$z<=$this->n;$z++){
                    $this->matrix[$i][$j][$z]=0;
                }
            }

        }
    }
    public function getMatrix(){
        return $this->matrix;
    }
    public function getValuePosition($x,$y,$z){
        return $this->matrix[$x][$y][$z];
    }
    public function setValuePosition($x,$y,$z,$w){
        $this->matrix[$x][$y][$z]=$w;
        return true;
    }
    public function getQuery($x1, $y1, $z1, $x2, $y2, $z2){
        $total=0;
        if($x1>$x2){
            $tmp=$x1;
            $x1=$x2;
            $x2=$tmp;
        }
        if($y1>$y2){
            $tmp=$y1;
            $y1=$y2;
            $y2=$tmp;
        }
        if($z1>$z2){
            $tmp=$z1;
            $z1=$z2;
            $z2=$tmp;
        }
        for($x=$x1;$x<=$x2;$x++){
            for($y=$y1;$y<=$y2;$y++) {
                for ($z=$z1;$z<=$z2;$z++) {
                    $total=$total+$this->matrix[$x][$y][$z];
                }
            }
        }
        return $total;

    }
}
