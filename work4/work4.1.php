<?php

interface iTarif
{
    public function summa();
    public function addService($service);
}

abstract class Tarifs implements iTarif
{

    protected $costKm;
    protected $costMin;
    protected $lengthOf;
    protected $timeOf;

    protected $services = [];


    public function __construct($lengthOf, $timeOf)
    {
        $this->lengthOf = $lengthOf;
        $this->timeOf = $timeOf;
    }

    public function summa()
    {
        $price = $this->lengthOf * $this->costKm + $this->timeOf * $this->costMin;

        if ($this->services) {
            foreach ($this->services as $service) {
                $service->apply($this, $price);
            }
        }



        return $price;
    }
    public function addService($service)
    {
        array_push($this->services, $service);
        return $this;
    }


    public function getMin(): int
    {
        return $this->timeOf;
    }

    public function getKm(): int
    {
        return $this->lengthOf;
    }
} 

class TarifBaz extends Tarifs
{
    protected $costKm = 10;
    protected $costMin = 3;
}

class Hours extends Tarifs
{
    protected $costKm = 0;
    protected $costMin = 200 / 60;

    public function __construct($lengthOf, $timeOf)
    {
        parent::__construct($lengthOf, $timeOf);


        $this->timeOf = $this->timeOf - $this->timeOf % 60 + 60;
    }
}

class Stud extends Tarifs
{
    protected $costKm = 4;
    protected $costMin = 1;
}

interface iService
{
    public function apply($tarif, &$price);
}

class AddDriver implements iService
{
    private $price;

    public function __construct(int $price)
    {
        $this->price = $price;
    }

    public function apply($tarif, &$price)
    {
        $price += $this->price;
    }
}

class AddGPS implements iService
{
    private $priceHour;

    public function __construct(int $priceHour)
    {
        $this->priceHour = $priceHour;
    }

    public function apply($tarif, &$price)
    {
        $hours = ceil($tarif->getMin() / 60);
        $price += $this->priceHour * $hours;
    }
}


$student = new Stud(1, 1);

$student->addService(new AddDriver(100));
$student->addService(new AddGPS(15));

echo $student->summa();
   
