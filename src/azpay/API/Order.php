<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:17
     */

    namespace Azpay\API;

    use Exception;


    /**
     * Class Order
     *
     * @package Azpay\API
     */
    class Order implements \JsonSerializable
    {
        /**
         * @var
         */
        private $reference;
        /**
         * @var
         */
        private $totalAmount;


        /**
         * @return array|mixed
         */
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
         * @param $totalAmount
         * @return $this
         * @throws Exception
         */
        public function setTotalAmount($totalAmount)
        {
            if (!is_integer($totalAmount)) {
                throw new Exception('setTotalAmount must be a integer!');
            }
            $this->totalAmount = $totalAmount;
            return $this;
        }

    }