<?php
    class Utilities
    {
        public static function Encrypt($val)
        {
            $EncryptObj = new Encryption();
            return $EncryptObj->Encrypt($val);
        }
    }