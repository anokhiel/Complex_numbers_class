<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Complex\ComplexNumber;

class ComplexTest extends TestCase
{

    protected $normal;
    protected $polar;

    protected function setUp(): void
    {
        $this->normal = ComplexNumber::setNormal(rand(1, 100), rand(1, 100));
        $this->polar = ComplexNumber::setPolar(rand(1, 100), rand(1, 100));
    }


    public  function testAddSubst()
    {
        //Проверка сложения и вычитания
        $this->assertTrue($this->normal->add($this->polar)->substract($this->polar)->isEqual($this->normal));
    }
    public  function testMultDev()
    {
        //Проверка умножения и деления
        $this->assertTrue($this->normal->multiply($this->polar)->devide($this->polar)->isEqual($this->normal));
    }
    public  function testConj()
    {
        //Проверка сопряженияы
        $this->assertTrue($this->normal->getConjugate()->add($this->normal)->isReal());
    }
    public  function testIdentity()
    {
        ///Тест проверяет перевод между нормальной и тригонометрической формой числа.
        $normalToPolar = ComplexNumber::setPolar($this->normal->getRo(), $this->normal->getPhi());
        $this->assertTrue($this->normal->isEqual($normalToPolar));
    }
}
