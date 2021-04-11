<?php

    class Logger{

        private $Path = "../data/Log.txt";
        private $Operation;
        private $Item;
        private $Content;
        private $fileLog;

        function __construct($operation, $item)
        {
            $this->Operation = $operation;
            $this->Item = $item;
        }

        private function writeLog()
        {
            $this->Content = json_encode($this->Item);
            $this->Open();
            date_default_timezone_set("America/Santo_Domingo");
            $fecha = date('d/m/y h:iA', time());
            return $fecha;
        }

        public function writeAddLog()
        {
            $fecha = $this->writeLog();
            fputs($this->fileLog, "- [{$fecha}][{$this->Operation}]: {$this->Content} \n");
            $this->Close();
        }

        public function writeEditLog($lastItem)
        {
            $fecha = $this->writeLog();
            fputs($this->fileLog, "- [{$fecha}][{$this->Operation}]: Change {".json_encode($lastItem)."} To {$this->Content} \n");
            $this->Close();
        }

        public function writeDeleteLog()
        {
            $fecha = $this->writeLog();
            fputs($this->fileLog, "- [{$fecha}][{$this->Operation}]: Delete {$this->Content} \n");
            $this->Close();
        }

        private function Open()
        {
            $this->fileLog = fopen($this->Path,"a");
        }

        private function Close()
        {
            fclose($this->fileLog);
        }

    }

?>