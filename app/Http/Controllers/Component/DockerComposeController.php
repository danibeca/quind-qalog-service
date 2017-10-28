<?php


namespace App\Http\Controllers\Component;


use App\Http\Controllers\ApiController;
use App\Models\APIClient\APIClient;
use App\Models\QualitySystem\QualitySystemInstance;
use App\Utils\Helpers\FileHelper;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\App;

class DockerComposeController extends ApiController
{

    public function index($id)
    {
        $destinationDir = sys_get_temp_dir() . '/' . strtotime(date('Y-m-d H:i:s'));
        if (! file_exists($destinationDir))
        {
            $oldmask = umask(0);


            if (! mkdir($destinationDir, 0755, true))
            {
                die('Failed to create folders...');
            }

            umask($oldmask);
        }

        $sourceDir = realpath('../resources/quind-docker');

        FileHelper::recurseCopy($sourceDir, $destinationDir);

        $code = APIClient::find(QualitySystemInstance::where('component_owner_id', $id)
            ->get()->first()->api_client_id)->code;

        $data_to_write = 'QUIND_ENDPOINT=' . env('QUIND_CLIENT_ENDPOINT') ."\n".
            'CLIENT_CODE=' . $code;
        $file_path = $destinationDir . '/quinddocker/php-fpm/quind.conf';

        $file_handle = fopen($file_path, 'a');
        fwrite($file_handle, $data_to_write);
        fclose($file_handle);


        $files = glob($destinationDir . '/*');
        App::make('zipper')->make($destinationDir . '/quid-docker.zip')->add($files)->close();

        return Response::download($destinationDir . '/quid-docker.zip');

    }


}