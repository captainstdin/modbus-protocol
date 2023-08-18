<?php

namespace captainstdin\modbus_protocol;

interface ModbusFuncInterface
{

    public function ReadCoils(int $addr):string;


    public function WriteSingleCoils(int $addr,bool $switchOpen):string;


    public function WriteSingleRegister(int $addr,string $twoByte):string;


    public function ReadSingleRegister(int $addr):string;


    public function ReadHoldingRegister(int $addr,int $lenth):string;

}
