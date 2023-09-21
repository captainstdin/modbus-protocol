<?php

namespace captainstdin\modbus_protocol;

/**
 * @author captainstdin
 * @func 构建读/写请求体，也许配合Decode去解析
 */
class TcpEncode implements ModbusFuncInterface
{


    public function __construct(\int $SubStation)
    {
        $this->SubStation=$SubStation;
    }

    public static function NewConn(\int $SubStation):self{
        return new static($SubStation);
    }

    //传输标志事务标志记录
    public static $TransactionId = 0;
    public $SubStation;

    private function getNextTransactionId(): \int
    {
        static::$TransactionId++;
        if (static::$TransactionId > 0xffff) {
            static::$TransactionId = 0;
        }
        return static::$TransactionId;
    }




    /**
     * @param int $addr
     * @return void
     * 读取单个线圈
     */
    public function  ReadCoils(\int $addr):\string
    {
        $pdu='';
        return $this->getMBAP($pdu).$pdu;
    }


    /**
     * @param int $addr
     * @return void
     * 读取 离散输入
     */
    public function  ReadDiscreteInputs():\string
    {
        return "";
    }


    /**
     * byte2hex
     *
     * Parse data and get it to the Hex form

    ord('A') -> string 41
     * @param string $value
     * @return string
     */
    public static function Byte2Hex($value):\string
    {
        $h = \dechex(($value >> 4) & 0x0F);
        $l = \dechex($value & 0x0F);
        return "$h$l";
    }

    protected function getMBAP(\string $PDU):\string{
        //packagenum(2byte)+0x0000 + length(2byte)
        return \pack(
            "n2n",
            $this->getNextTransactionId(),
            0x0000,
            \strlen($PDU)
        );
    }

    public function ReadHoldingRegister(\int $addrDec, \int $length): \string
    {
        $pdu=\pack(
            "C2nn",
            $this->SubStation,
            0x03,
            $addrDec,
            $length
        );
        return $this->getMBAP($pdu).$pdu;
    }

    public function WriteSingleRegister(\int $addrDec,\int $twoByte):\string
    {
        $pdu=\pack(
            "CCn2",
            $this->SubStation,
            0x06,
            $addrDec,
            $twoByte
        );
        return $this->getMBAP($pdu).$pdu;
    }



    public function WriteSingleCoil(\int $addrDec,\bool $open): \string
    {
        $switch=0x0;
        if ($open){
            $switch=0xFF00;
        }
        $pdu=\pack(
            "CCn2",
            $this->SubStation,
            0x05,
            $addrDec,
            $switch
        );
        return $this->getMBAP($pdu).$pdu;
    }


    public function ReadSingleCoil(\int $addrDec):\string
    {
        $pdu=\pack(
            "CCn2",
            $this->SubStation,
            0x01,
            $addrDec,
            0x01
        );
        return $this->getMBAP($pdu).$pdu;
    }

    public function ReadSingleRegister(\int $addr): \string
    {
        // TODO: Implement ReadSingleRegister() method.
        return "";
    }
}