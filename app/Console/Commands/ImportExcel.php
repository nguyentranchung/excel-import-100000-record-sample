<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'excel:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        ini_set('memory_limit', '-1');
        set_time_limit(300);

        // Thời gian bắt đầu
        $this->showTime();

        // Đọc file excel
        $inputFileName = public_path($path = '100000 Sales Records.csv');
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        $reader->setSheetIndex(0);
        $spreadsheet = $reader->load($inputFileName);
        // Load xong file
        $this->showTime();

        // Nạp rows
        $rows = $spreadsheet->getSheet(0)->toArray(null, true, true, true);
        $this->showTime();

        $arrKeys = ['col1', 'col2', 'col3', 'col4', 'col5', 'col6', 'col7', 'col8', 'col9', 'col10', 'col11', 'col12', 'col13', 'col14'];
        $count = count($rows);

        foreach ($rows as $key => $row) {
            $insert[] = array_combine($arrKeys, $row);

            // Cứ mỗi 1000 rows thì insert db 1 lần
            if ($key%1000 == 999 || $key == $count - 1) {
                \DB::table('imports')->insert($insert);
                $insert = [];
            }
        }

        // Done
        $this->showTime();
    }

    public function showTime()
    {
        $t = microtime(true);
        $micro = sprintf("%06d",($t - floor($t)) * 1000000);
        $d = new \DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
        $this->error('Time: ' . $d->format("Y-m-d H:i:s.u"));
        return $d;
    }
}
