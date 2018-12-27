<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:17
     */

    namespace Azpay\API;


    class Order implements \JsonSerializable
    {
        private $reference;
        private $totalAmount;


        public function jsonSerialize()
        {
            return get_object_vars($this);
        }

        /**
         * @return mixed
         */
        public function getReference()
        {
            return $this->reference;
        }

        /**
         * @param mixed $reference
         * @return Order
         */
        public function setReference($reference)
        {
            $this->reference = $reference;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getTotalAmount()
        {
            return $this->totalAmount;
        }

        /**
         * @param mixed $totalAmount
         * @return Order
         */
        public function setTotalAmount($totalAmount)
        {
            $this->totalAmount = $totalAmount;
            return $this;
        }

    }