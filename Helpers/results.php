<?php
    class Result{
        public $success;
        public $result;
        public $debug;
        public $message;

        public function __construct(){
            $this->success = false;
            $this->result = [];
            $this->message = '';
            $this->debug = '';
        }

    }