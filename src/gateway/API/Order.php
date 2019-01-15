<?php
    /**
     * Created by PhpStorm.
     * User: brunopaz
     * Date: 2018-12-26
     * Time: 22:17
     */

    namespace Gateway\API;

    use Exception;


    /**
     * Class Order
     *
     * @package Gateway\API
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
         * @var
         */
        private $frequency;
        /**
         * @var
         */
        private $period;
        /**
         * @var
         */
        private $dateStart;
        /**
         * @var
         */
        private $dateEnd;


        /**
         * @return array|mixed
         */
        public function jsonSerialize()
        {
            $vars = get_object_vars($this);
            $vars_clear = array_filter($vars, function ($value) {
                return NULL !== $value;
            });

            return $vars_clear;
        }

        /**
         * @return mixed
         */
        public function getFrequency()
        {
            return $this->frequency;
        }


        /**
         * @param $frequency
         * @return $this
         * @throws Exception
         */
        public function setFrequency($frequency)
        {
            if (!is_integer($frequency)) {
                throw new Exception('setFrequency must be a integer!');
            }
            $this->frequency = $frequency;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getPeriod()
        {
            return $this->period;
        }


        /**
         * @param $period
         * @return $this
         * @throws Exception
         */
        public function setPeriod($period)
        {
            if (!is_integer($period)) {
                throw new Exception('setPeriod must be a integer!');
            }
            $this->period = $period;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getDateStart()
        {
            return $this->dateStart;
        }


        /**
         * @param $dateStart
         * @return $this
         * @throws Exception
         */
        public function setDateStart($dateStart)
        {

            if (!strtotime($dateStart)) {
                throw new Exception('setDateStart must be a date with format: YYYY-MM-DD');
            }
            if (strtotime($dateStart) < strtotime("today")) {
                throw new Exception('setDateStart must be greater than today');
            }
            $this->dateStart = $dateStart;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getDateEnd()
        {
            return $this->dateEnd;
        }


        /**
         * @param $dateEnd
         * @return $this
         * @throws Exception
         */
        public function setDateEnd($dateEnd)
        {
            if (!strtotime($dateEnd)) {
                throw new Exception('setDateEnd must be a date with format: YYYY-MM-DD');
            }
            if (strtotime($dateEnd) < strtotime("+1 day")) {
                throw new Exception('setDateEnd must be a future date');
            }

            $this->dateEnd = $dateEnd;
            return $this;
        }

        /**
         * @return mixed
         */
        public function getReference()
        {
            return $this->reference;
        }

        /**
         * @param $reference
         * @return $this
         * @throws Exception
         */
        public function setReference($reference)
        {
            if (!is_string($reference)) {
                throw new Exception('setReference must be a string!');
            }

            if (strlen($reference) > 16) {
                throw new Exception('setReference must be less than 17 characters');
            }

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