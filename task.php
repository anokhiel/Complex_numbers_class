<?php

 class ComplexNumber{
     public  $re;
     public  $im;
     public  $modulus;
     public  $argument;


public function __construct($re, $im){
$this->re=$re;
    $this->im=$im;
$this->modulus=sqrt(pow($this->re,2)+pow($this->im,2));
$this->setArgument();

}
public  function getConjugate(){
    return new ComplexNumber($this->re, -$this->im);
}
private function setArgument(){
    if($this->re>0 AND $this->im >0){
        $this->argument=atan($this->im/$this->re);
    }elseif($this->re>0 AND $this->im<0 ){
    $this->argument=-atan($this->im/$this->re);
     }elseif($this->re<0 AND $this->im<0 ){
        $this->argument=atan($this->im/$this->re)-pi();
         }
         elseif($this->re ==0 ){
            $this->argument=$this->im/abs($this->im)*pi()/2;
             }
             elseif($this->im==0 ){
                $this->argument=$this->re>0?0:pi();
                 }else{
                 $this->argument=null; 
                 }
                 }
public function getRe(){
return $this->re;
}   
public function getIm(){
    return $this->Im;
}
public function isEqual(ComplexNumber $c) {
    return( $this->re==$c->re) AND ($this->im==$c->im);
}    
public function isReal()
{
    return $this->im==0;
}                
public function  add(ComplexNumber $c){
    return new ComplexNumber($this->re+$c->re, $this->im+$c->im);
}
public function  substract(ComplexNumber $c){
    return new ComplexNumber($this->re-$c->re, $this->im-$c->im);
}
public function multiply(ComplexNumber $c){
  return new ComplexNUmber($this->re * $c->re - $this->im*$c->im, $this->re * $c->im + $this->im*$c->re );
}
 public function devide(ComplexNumber $c){
     return new ComplexNumber(($this->re*$c->re+$this->im*$c->im)/(pow($c->im,2)+pow($c->re,2)),($this->im*$c->re-$this->re*$c->im)/(pow($c->im,2)+pow($c->re,2)) );

 }

}

class TestCN{
public static function testAddSubst(){
   $a=new ComplexNumber( rand(1,100),rand(1,100));
   $b=new ComplexNumber( rand(1,100),rand(1,100));
   
    if($a->add($b)->substract($b)->isEqual($a)){
        
        echo 'Тест на сложение / вычитание выполнен успешно<br/>';
        return true;
    }
    echo 'Тест на сложение / вычитание провален<br/>';
    return true;
}
public static function testMultDev(){
    $a=new ComplexNumber( rand(1,100),rand(1,100));
    $b=new ComplexNumber( rand(1,100),rand(1,100));
    
     if($a->multiply($b)->devide($b)->isEqual($a)){
         
         echo 'Тест на умножение / деление выполнен успешно<br/>';
         return true;
     }
     echo 'Тест на умножение / деление провален<br/>';
     return true;
 }
 public static function textConj(){
    $a=new ComplexNumber( rand(1,100),rand(1,100));
    if($a->getConjugate()->add($a)->isReal()){
        echo 'Тест на сопряжение выполнен успешно<br/>';
        return true;
    }   else{
        echo 'Тест на сопряжение  провален<br/>';
        return true;
    }
 }

}

$meths=get_class_methods('TestCN');
foreach($meths as $meth){
call_user_func(array('TestCN', $meth));

}

