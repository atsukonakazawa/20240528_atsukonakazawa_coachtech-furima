<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class MigrateProfileImagesToS3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:profileImages-to-s3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate profileImages to S3';

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
        $profiles = Profile::all();

        foreach ($profiles as $profile) {
            $localPath = str_replace('storage/', 'public/', $profile->img); // 正しいローカルパスに変換
            $s3Path = str_replace('storage/', '', $profile->img); // S3のパスには 'storage/' 部分を除く

            if (Storage::disk('local')->exists($localPath)) {
                $content = Storage::disk('local')->get($localPath);
                Storage::disk('s3')->put($s3Path, $content);

                // S3のURLに更新
                $profile->img = Storage::disk('s3')->url($s3Path);
                $profile->save();

                // ローカルファイルの削除 (オプション)
                Storage::disk('local')->delete($localPath);

                $this->info('Migrated: ' . $localPath . ' to ' . $s3Path);
            } else {
                $this->warn('File not found: ' . $localPath);
            }
        }

        $this->info('profileImage migration completed.');
    }
}
