<?php

namespace captainstdin\modbus_protocol;

class TcpDecode
{


    public $package;

    public static function Parse (\string $buff):self
    {
        return new self($buff);
    }


    public function __construct($buff)
    {
        $package=new ModbusPackage();
        $package->rawBuff=$buff;
        $package->TransactionId=\substr($buff,0,2);
        $package->ProtocolId=\substr($buff,2,2);
        $package->Length=\substr($buff,4,2);
        $package->StationId=\substr($buff,6,1);
        $package->CommandId=\substr($buff,7,1);
        $this->package=$package;
    }

    public  function ReadCoils( ): array
    {
        if ($this->package->CommandId!=ModbusPackage::ReadCoils){
            return [];
        }
        $len=\substr($this->package->rawBuff,8,1);
        $data=\substr($this->package->rawBuff,9);

        $hex = hex2bin($data);
        $bits = \str_split($hex);
        $result = [];

        foreach ($bits as $bit) {
            $binary = \sprintf("%08b", ord($bit));
            $binaryArray = \str_split($binary);
            $binaryArray = \array_map(function ($value) {
                return (bool) $value === '1';
            }, $binaryArray);
            $result = \array_merge($result, $binaryArray);
        }
        return $result;
    }

    public static function WriteSingleCoils(\int $addr): \string
    {
        // TODO: Implement WriteSingleCoils() method.
        return "";
    }

    public static function WriteSingleRegister(\int $addr, \string $twoByte): \string
    {
        // TODO: Implement WriteSingleRegister() method.
        return "";
    }

    public static function ReadSingleRegister(\int $addr): \string
    {
        // TODO: Implement ReadSingleRegister() method.
        return "";
    }

    public static function ReadHoldingRegister(\int $addr, \int $lenth): \string
    {
        // TODO: Implement ReadHoldingRegister() method.
        return "";
    }

    public static function WriteSingleCoil(\int $addr, \bool $switchOpen): \string
    {
        // TODO: Implement WriteSingleCoil() method.
        return "";
    }

    public static function ReadSingleCoil(\int $add): \string
    {
        // TODO: Implement ReadSingleCoil() method.
        return "";
    }
}