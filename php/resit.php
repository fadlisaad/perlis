<?php
require ('stringer.php');
require __DIR__.'/../vendor/autoload.php';

class Receipt
{
    private $config;

    public function __construct()
    {
        $config_filename = ROOT_DIR.'/config.json';

        if (!file_exists($config_filename)) {
            throw new Exception("Can't find ".$config_filename);
        }
        $this->config = json_decode(file_get_contents($config_filename), true);

        if($this->config['fpx']['environment'] == 'Staging'){
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        }
    }

    # process resit
    public function process($data)
    {
        require ('conn.php');

        if(isset($data)){

            $receipt_no = $data['resit'];

            $stmt = $pdo->prepare("SELECT * FROM transactions WHERE receipt_no = :receipt_no");
            $stmt->execute(['receipt_no' => $receipt_no]); 
            $rows = $stmt->fetchAll();

            if($rows){

            } else {
                return 'Tiada no resit dalam simpanan transaksi kami. Sila semak semula'
            }

        } else {
            // error
        }
    }
}
