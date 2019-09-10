<?php
/**
 * Created by PhpStorm.
 * User: SGunes
 * Date: 10.09.2019
 * Time: 08:53
 */

namespace App\Helpers;


class DinamikCrud
{
    private $tableEloquent;

    public $SqlSelect=["query"=>["*"],"table"=>null];
    public $SqlOrder=["column"=>"id","type"=>"asc"];
    public $SqlSearch=["column"=>"id","value"=>""];
    public $SqlPaginate=0;
    public $Model;
    public $data;

    public function MainSGunes($table){
        $this->tableEloquent = $table;
    }

    private function Table(){
        return $this->tableEloquent;
    }

    public function modelGet(){
        $table = $this->Table()
            ::select($this->SqlSelect["query"])
            ->where($this->SqlSearch["column"],"like","%".$this->SqlSearch["value"]."%")
            ->orderBy($this->SqlOrder["column"],$this->SqlOrder["type"]);
        return $table;
    }

    public function modelSave($intended_modal=null){
        $this->Model = isset($intended_modal)?$intended_modal:$this->ModelGet();
    }

    public function createData($resources){
        $this->data[$resources]=[
            "items"=>$this->Model->paginate($this->SqlPaginate),
            "table"=>$this->Select["table"]
        ];
    }

    public function pageView($view=null){
        return view($view,["data"=>$this->data]);
    }

}