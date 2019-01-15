<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:14
     */

    namespace Gateway\API;


    /**
     * Class Items
     *
     * @package Gateway\API
     */
    class Items implements \JsonSerializable
    {
        /**
         * @var
         */
        private $productName;
        /**
         * @var
         */
        private $quantity;
        /**
         * @var
         */
        private $price;

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
        public function getProductName()
        {
            return $this->productName;
        }

        /**
         * @param mixed $productName
         * @return Items
         */
        public function setProductName($productName)
        {
            $this->productName = $productName;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getQuantity()
        {
            return $this->quantity;
        }

        /**
         * @param mixed $quantity
         * @return Items
         */
        public function setQuantity($quantity)
        {
            $this->quantity = $quantity;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getPrice()
        {
            return $this->price;
        }

        /**
         * @param mixed $price
         * @return Items
         */
        public function setPrice($price)
        {
            $this->price = $price;
            return $this;
        }

    }