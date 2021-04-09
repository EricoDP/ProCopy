<?php

  class Utilities{

    public function SearchProperty($list, $property, $value){
      $filters = [];
      foreach ($list as $item) {
        if($item->$property == $value){
          array_push($filters, $item);
        }
      }
      return $filters;
    }

    public function GetIndexElement($list, $property, $value){
      $index = 0;
      foreach ($list as $key => $item) {
        if($item->$property == $value){
          $index = $key;
          break;
        }
      }
      return $index;
    }
  }

?>