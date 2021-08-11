<?php

namespace App\Http\Complex;
//
//Данная модель имеет дидактическую цель.
// Она не строится на разработанной математической модели и может не соответствовать теории
//методов вычислений. 
//

class ComplexNumber
{
    private  $re;
    private  $im;
    private  $ro;
    private  $phi;
    private $precision;


    private function __construct($arg1, $arg2, $type)
    {
        $this->precision = $this->calculatePrecision();
        switch ($type) {
            case 'polar':
                $this->ro =  (float)$arg1;
                $this->phi = (float)$arg2;
                $this->re = $this->ro * cos($this->phi);
                $this->im = $this->ro * sin($this->phi);
                break;
            case 'normal':
                $this->re = (float)$arg1;
                $this->im = (float)$arg2;
                $this->ro = sqrt(pow($this->re, 2) + pow($this->im, 2));
                $this->setphi();
                break;
            default:
                $this->re = 0;
                $this->im = 0;
                $this->ro = 0;
                $this->phi = 0;
        }
    }
    private function calculatePrecision()
    {
        return 4; //Зависит от настроек (и) сервера. Надо думать отдельно.
    }
    public static function setNormal($re, $im)
    {
        return new ComplexNumber($re, $im, 'normal');
    }
    public static function setPolar($ro, $phi)
    {
        return new ComplexNumber($ro, $phi, 'polar');
    }

    public function getRe()
    {
        return round($this->Re, $this->precision);
    }
    public function getIm()
    {
        return round($this->Im,  $this->precision);
    }
    public function getPhi()
    {
        return round($this->phi,  $this->precision);
    }
    public function getRo()
    {
        return round($this->ro,  $this->precision);
    }
    public  function getConjugate()
    {
        return new ComplexNumber($this->re, -$this->im, 'normal');
    }
    private function setPhi()
    {
        if ($this->re > 0 and $this->im > 0) {
            $this->phi = atan($this->im / $this->re);
        } elseif ($this->re > 0 and $this->im < 0) {
            $this->phi = -atan($this->im / $this->re);
        } elseif ($this->re < 0 and $this->im < 0) {
            $this->phi = atan($this->im / $this->re) - pi();
        } elseif ($this->re == 0) {
            $this->phi = $this->sign($this->im) * pi() / 2;
        } elseif ($this->im == 0) {
            $this->phi = $this->re > 0 ? 0 : pi();
        } else {
            $this->phi = 0;
        }
    }
private function sign( $number ) {
    return ( $number > 0 ) ? 1 : ( ( $number < 0 ) ? -1 : 0 );
} 
    public function isEqual(ComplexNumber $c)
    {
        return ((($this->re - $c->re) / $this->re )< pow(0.1, $this->precision)) and ((($this->im - $c->im) / $this->im )< pow(0.1, $this->precision));
    }
    public function isReal()
    {
        return round($this->im,  $this->precision) == 0;
    }
    public function  add(ComplexNumber $c)
    {
        return new ComplexNumber($this->re + $c->re, $this->im + $c->im, 'normal');
    }
    public function  substract(ComplexNumber $c)
    {
        return new ComplexNumber($this->re - $c->re, $this->im - $c->im, 'normal');
    }
    public function multiply(ComplexNumber $c)
    {
        return new ComplexNUmber($this->re * $c->re - $this->im * $c->im, $this->re * $c->im + $this->im * $c->re, 'normal');
    }
    public function devide(ComplexNumber $c)
    {
        return new ComplexNumber(($this->re * $c->re + $this->im * $c->im) / (pow($c->im, 2) + pow($c->re, 2)), ($this->im * $c->re - $this->re * $c->im) / (pow($c->im, 2) + pow($c->re, 2)), 'normal');
    }
}
