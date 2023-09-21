<?php

namespace captainstdin\modbus_protocol;

interface ModbusFuncInterface
{

    public function ReadCoils(\int $addr):\string;


    public function WriteSingleCoil(\int $addr,\bool $switchOpen):\string;

    public function ReadSingleCoil(\int $add):string;

    public function WriteSingleRegister(\int $addr,\int $twoByte):\string;


    public function ReadSingleRegister(\int $addr):\string;


    public function ReadHoldingRegister(\int $addr,\int $lenth):\string;

}
