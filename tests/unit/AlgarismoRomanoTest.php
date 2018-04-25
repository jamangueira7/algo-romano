<?php
/**
 * Created by PhpStorm.
 * User: mangueira
 * Date: 25/04/18
 * Time: 12:09
 */
use PHPUnit\Framework\TestCase;
use JM\SON\AlgarismoRomano;

class AlgarismoRomanoTest extends TestCase
{
    public function testValoresPassados()
    {
        $class = new AlgarismoRomano('xl');

        $this->assertEquals($class->getAlgorismo(),'XL');
        $this->assertEquals($class->getValores(),['X'=>'10','L'=>'50']);
        $this->assertEquals($class->getAlgorismoSeparado(),['X','L']);
    }

    public function testValoresIguais()
    {
        $class = new AlgarismoRomano('iii');

        $this->assertEquals($class->getAlgorismo(),'III');
        $this->assertEquals($class->getValores(),['I'=>'1','I'=>'1','I'=>'1']);
        $this->assertEquals($class->getAlgorismoSeparado(),['I','I','I']);
    }

    public function testValores()
    {
        $class = new AlgarismoRomano('CML');
        $this->assertEquals($class->getValorSomado(),950);

        $class1 = new AlgarismoRomano('DLXXXVIII');
        $this->assertEquals($class1->getValorSomado(),588);

        $class2 = new AlgarismoRomano('DCCCLXXXIII');
        $this->assertEquals($class2->getValorSomado(),883);

        $class3 = new AlgarismoRomano('LXXX');
        $this->assertEquals($class3->getValorSomado(),80);

        $class4 = new AlgarismoRomano('MMMCMXCIX');
        $this->assertEquals($class4->getValorSomado(),3999);

        $class5 = new AlgarismoRomano('MDCCXVIII');
        //var_dump('###'.$class->getValorSomado());
        $this->assertEquals($class5->getValorSomado(),1718);
    }
}