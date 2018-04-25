<?php
/**
 * Created by PhpStorm.
 * User: mangueira
 * Date: 25/04/18
 * Time: 12:06
 */

namespace JM\SON;


class AlgarismoRomano
{
    private $algarismo;
    private $algarismoSeparado = [];
    private $valores = [];
    private $valorSomado;

    public function __construct(string $algarismo)
    {
        $algarismo = strtoupper($algarismo);
        $this->algarismo = $algarismo;
        $this->caracteresSeparados($algarismo);

        $this->validarRegrasNumeros();
    }

    private function validarRegrasNumeros()
    {
        foreach ($this->algarismoSeparado as $value){
            $this->valorarCaracteres($value);
        }

        $this->regraAteTresCaracteresIguais();

        $this->somarValores();
    }

    private function regraAteTresCaracteresIguais()
    {
        $count = 1;
        $valorAnterior = 0;
        foreach ($this->algarismoSeparado as $value){
            if($valorAnterior == (int)$this->valores[$value]){
                $count++;
            }else{
                $count = 0;
            }

            if($count > 3){
                throw new \Exception("#######Valor invalido!#######");
            }
            $valorAnterior = (int)$this->valores[$value];
        }

        return true;
    }

    private function somarValores()
    {
        $count = 1;
        $valorAnterior = 0;
        foreach ($this->algarismoSeparado as $value){
            if((int)$this->valores[$value] > $valorAnterior && $count == 1 && $valorAnterior != 0){
                $count++;
                $this->valorSomado += (int)$this->valores[$value] - ($valorAnterior * 2);
            }else{
                $count = 1;
                $this->valorSomado += (int)$this->valores[$value];
            }
            /*var_dump('###A '.$this->valorSomado);
            var_dump('###B '.(int)$this->valores[$value]);
            var_dump('###C '.$valorAnterior);
            var_dump('###D '.$count);*/
            if($count > 3){
                throw new \Exception("#######Valor invalido!#######");
            }
            $valorAnterior = (int)$this->valores[$value];
        }
    }

    private function caracteresSeparados($value)
    {
        $n_caracteres = strlen($value);

        for( $i=0; $i < $n_caracteres ; $i++ ){
            $this->algarismoSeparado[] =  $value[$i];
        }
    }

    private function valorarCaracteres($value)
    {
        switch ($value){
            case 'I':
                $this->valores['I'] = 1;
                break;
            case 'V':
                $this->valores['V'] = 5;
                break;
            case 'X':
                $this->valores['X'] = 10;
                break;
            case 'L':
                $this->valores['L'] = 50;
                break;
            case 'C':
                $this->valores['C'] = 100;
                break;
            case 'D':
                $this->valores['D'] = 500;
                break;
            case 'M':
                $this->valores['M'] = 1000;
                break;
            default:
                throw new \Exception("#######Valor {$value} não existe em algarismo romano!#######");
        }
        return $this->valores;
    }

    public function getValores():array
    {
        return $this->valores;
    }

    public function getAlgorismo()
    {
        return (string)$this->algarismo;
    }

    public function getAlgorismoSeparado():array
    {
        return $this->algarismoSeparado;
    }

    public function getValorSomado():int
    {
        return (int)$this->valorSomado;
    }
}