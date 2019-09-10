<?php
/**
 * Created by PhpStorm.
 * User: SGunes
 * Date: 10.09.2019
 * Time: 08:53
 */

namespace App\Helpers;


use http\Env\Request;

class DinamikCrud
{
    private $tableEloquent;

    public $SqlSelect=["select"=>["*"],"table"=>null];
    public $SqlOrderBys=[];
    public $SqlSearchWheres=[];
    public $SqlWheres=[];
    public $SqlPaginate=0;
    public $Model;
    public $data;

    public function MainSGunes($table){
        $this->tableEloquent = $table;
    }

    private function Table(){
        return $this->tableEloquent;
    }

    private function tableWhereToTable($table){
        foreach ($this->SqlWheres as $column => $value){
            $table = $table->where($column,$value);
        }return $table;
    }
    private function tableSearchWhereToTable($table){
        foreach ($this->SqlSearchWheres as $column => $value){
            $table = $table->where($column,"like","%".$value."%");
        }return $table;
    }
    private function tableOrderByToTable($table){
        foreach ($this->SqlOrderBys as $column => $type){
            $table = $table->orderBy($column,$type);
        }return $table;
    }

    public function modelGet(){
        $table = $this->Table()
            ::select($this->SqlSelect["select"]);
            $table = $this->tableWhereToTable($table);
            $table = $this->tableSearchWhereToTable($table);
            $table = $this->tableOrderByToTable($table);
        return $table;
    }

    public function modelSave($intended_modal=null){
        $this->Model = isset($intended_modal)?$intended_modal:$this->ModelGet();
    }

    public function createDataAndGet($resources){
        $this->data[$resources]=[
            "items"=>$this->Model->paginate($this->SqlPaginate),
            "table"=>$this->Select["table"]
        ];
    }

    public function createDataAndFirst($resources){
        $this->data[$resources]=[
            "items"=>$this->Model->paginate($this->SqlPaginate),
            "table"=>$this->Select["table"]
        ];
    }

    public function Storage($request_all){
        return $this->Table()::create($request_all);
    }

    public function Destroy($id,$foreign_keys=[]){
        if (count($foreign_keys)>0){
            foreach ($foreign_keys as $model => $column){
                $model::where($column,$id)->delete();
            }
        }
        return $this->Table()::where('id',$id)->delete();
    }

    public function pageView($view=null,$other=null){
        $this->data["other"]=$other;
        return view($view,["data"=>$this->data]);
    }

}