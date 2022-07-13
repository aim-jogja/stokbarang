<?php
    include_once "config/config.php";

    class TotalHarga{
        public $kodebarang;
        public $harga;

        function __construct($kode){
            $this->kodebarang = $kode;
            $query = mysqli_query($koneksidb, "SELCET * FROM masuk WHERE kodebarang=".$this->kodebarang);
            $this->harga = mysqli_fetch_assoc($query);
        }
        public function getPrice(){
            return $this->harga;
        }
    }

?>