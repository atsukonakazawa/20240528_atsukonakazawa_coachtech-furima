<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class MigrateItemImagesToS3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:itemImages-to-s3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate item images to S3';

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
     * @return int
     */
    public function handle()
    {
        $items = Item::all();

        foreach ($items as $item) {
            $localPath = str_replace('storage/', 'public/', $item->item_img); // 正しいローカルパスに変換
            $s3Path = str_replace('storage/', '', $item->item_img); // S3のパスには 'storage/' 部分を除く

            if (Storage::disk('local')->exists($localPath)) {
                $content = Storage::disk('local')->get($localPath);
                Storage::disk('s3')->put($s3Path, $content);

                // S3のURLに更新
                $item->item_img = Storage::disk('s3')->url($s3Path);
                $item->save();

                // ローカルファイルの削除 (オプション)
                Storage::disk('local')->delete($localPath);

                $this->info('Migrated: ' . $localPath . ' to ' . $s3Path);
            } else {
                $this->warn('File not found: ' . $localPath);
            }
        }

        $this->info('ItemImage migration completed.');
    }
}
