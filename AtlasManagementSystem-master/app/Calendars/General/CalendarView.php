<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';
    $weeks = $this->getWeeks();
    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';

      $days = $week->getDays();
      foreach($days as $day){
        $startDay = $this->carbon->copy()->format("Y-m-01");
        $toDay = $this->carbon->copy()->format("Y-m-d");

        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
          $html[] = '<td class="calendar-td '.$day->pastClassName().'">';

        }else{
          $html[] = '<td class="calendar-td '.$day->getClassName().'">';
        }
        $html[] = $day->render();

        if(in_array($day->everyDay(), $day->authReserveDay())){
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          if($reservePart == 1){
            $reservePart = "リモ1部";
          }else if($reservePart == 2){
            $reservePart = "リモ2部";
          }else if($reservePart == 3){
            $reservePart = "リモ3部";
          }
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">'.$reservePart.'</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }else{
            $html[] = '<input type="hidden" name="delete_date" reserve_id ='. $day->authReserveDate($day->everyDay())->first()->pivot->id .'">';
            $html[] = '<input type="submit" class="btn btn-danger mb-8 modal-open" id="hogeModal" data-toggle="modal" data-target="#testModal"  p-0 w-75" style="font-size:12px" reserve_date="date" reserve_part="part" reserve_id ='. $day->authReserveDate($day->everyDay())->first()->pivot->id .' value= "'. $reservePart .'">';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';

            $html[] ='<div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">';
            $html[] ='<div class="modal-dialog">';
            $html[] ='<div class="modal-content">';
            $html[] ='<div class="modal-header">';
            $html[] ='<h4><div class="modal-title" id="myModalLabel">削除確認画面</div></h4>';
            $html[] ='</div>';
            $html[] ='<p class = modal-date name="reserve_date"></p>';
            $html[] ='<p class = modal-part name="reserve_part">時間</p>';
            $html[] ='<input type="hidden" class="modal-id-hidden" name="delete_date" value="">';
            $html[] ='<div class="modal-body">';
            $html[] ='<label>データを削除しますか？</label>';
            $html[] ='</div>';
            $html[] ='<div class="modal-footer">';
            $html[] ='<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>';
            $html[] ='<input type="submit" class="btn btn-danger" form = "deleteParts"  value="削除">';
            $html[] ='</div>';
            $html[] ='</div>';
            $html[] ='</div>';
            $html[] ='</div>';
          }
        }else if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
          $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">受付終了</p>';
          $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
        }else{
          $html[] = $day->selectPart($day->everyDay());
        }
        $html[] = $day->getDate();
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';

    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';

    return implode('', $html);
  }

  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}