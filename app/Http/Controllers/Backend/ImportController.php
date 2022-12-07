<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{
    // update postal code
    public function UpdatePostalCode(Request $request){
        if($request -> isMethod('post')){

            // file upload
            if($request -> hasFile('file')){

                $img = $request -> file('file');
                $unique = md5(time() . rand()) . '.' . $img -> getClientOriginalExtension();
                $img -> move(public_path('media/backend/imports/postalcodes'), $unique);
                
                @unlink('media/backend/imports/postalcodes/'.$request -> old_img);

            }else {
                $unique = $request -> old_img;
            }

            // get data from folder
            $file = public_path('media/backend/imports/postalcodes/'.$unique);
            $postalcode = $this -> csvToArray($file);

            $latest_postalcode = array();
            foreach($postalcode as $key => $item){
                $latest_postalcode[$key]['postalcode'] = $item['postalcode'];
                $latest_postalcode[$key]['created_at'] = date('Y-m-d H:i:m');
                $latest_postalcode[$key]['updated_at'] = date('Y-m-d H:i:m');
            }

            // inset to database
            DB::table('postal_codes') -> delete();
            DB::update('Alter table postal_codes AUTO_INCREMENT = 1;');
            DB::table('postal_codes')  -> insert($latest_postalcode);

            // dd($postalcode); die;

        }
        return view('backend.postalCode.addEditPostalCode');
    }

    // CSV to Array Function
    public function csvToArray($filename = '', $delimiter = ','){
        if (!file_exists($filename) || !is_readable($filename))
            return false;
            $header = null;
            $data = array();
            if (($handle = fopen($filename, 'r')) !== false){
                while (($row = fgetcsv($handle, 1000, $delimiter)) !== false){
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
                }
            fclose($handle);
            }
        return $data;
    }


}
