<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function __diff_day($fdate, $tdate){
    $datetime1 = new DateTime($fdate);
    $datetime2 = new DateTime($tdate);
    $interval = $datetime1->diff($datetime2);
    $days = $interval->format('%a');
    return ( $days + 1 );
  }

    public function __alert($type, $message){
      if($type == 's'){
        alert()->success($message)->toHtml()->timerProgressBar()->autoClose(5000)->width('auto')->padding('0px');
      }
      if($type == 'e'){
        alert()->error($message)->toHtml()->timerProgressBar()->autoClose(5000)->width('auto')->padding('0px');
      }
      if($type == 'i'){
        alert()->info($message)->toHtml()->timerProgressBar()->autoClose(5000)->width('auto')->padding('0px');
      }
      if($type == 'w'){
        alert()->warning($message)->toHtml()->timerProgressBar()->autoClose(5000)->width('auto')->padding('0px');
      }
    }
}
