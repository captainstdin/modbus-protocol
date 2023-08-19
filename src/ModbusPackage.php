<?php

namespace captainstdin\modbus_protocol;

/**
 * 包内容
 */
class ModbusPackage
{
    public $TransactionId;

    public $ProtocolId;

    public $Length;

    public $StationId;

    public $CommandId;

    public $Coils=[];

    public $Registers=[];

    const ReadCoils=0x01;

    const ReadDiscreteCoils=0x02;
    const ReadHoldingRegister=0x03;
    const WriteSingleCoils=0x05;
    const WriteSingleRegister=0x06;

    const WriteMultipleCoils=0x0F;

    const WriteMultipleRegister=0x10;

    public function GetPDU():string
    {
        return "";
    }

    public function GetMBAP():string
    {
        return "";
    }


    public $rawBuff;

}