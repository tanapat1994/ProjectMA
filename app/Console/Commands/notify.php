<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\StatusAir;
class notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       
        function sendToLine($message){
        

        $line_api = 'https://notify-api.line.me/api/notify';
        $line_token = 'ccduc9ATE0AkQrQkFy5mzXHts9PumeniAU6Rlc6Ivoe';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://notify-api.line.me/api/notify");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'message=Low Performance Warning
'.$message);
        // follow redirects
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-type: application/x-www-form-urlencoded',
            'Authorization: Bearer '.$line_token,
        ]);
        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);

        curl_close ($ch);
        

        }

        function sendToLineNO(){
        

            $line_api = 'https://notify-api.line.me/api/notify';
            $line_token = 'ccduc9ATE0AkQrQkFy5mzXHts9PumeniAU6Rlc6Ivoe';
    
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://notify-api.line.me/api/notify");
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'message=No Low Performance
    ');
            // follow redirects
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-type: application/x-www-form-urlencoded',
                'Authorization: Bearer '.$line_token,
            ]);
            // receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
            $server_output = curl_exec ($ch);
    
            curl_close ($ch);
            
    
            }

        $statusairs = StatusAir::where('performance','<',3)
        ->where('power_status','on')
        ->get();

        $str = '';

        foreach($statusairs as $statusair) {
            $str .= $statusair->room_no . '  EER: ' . $statusair->performance."\n";
        }
        if($str == ''){
            sendToLineNO();
        }
        else{
            sendToLine($str); 
        }
        

    }
}
