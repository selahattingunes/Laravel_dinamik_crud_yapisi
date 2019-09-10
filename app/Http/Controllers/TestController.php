<?php

namespace App\Http\Controllers;

use App\Helpers\DinamikCrud;
use Illuminate\Http\Request;

class TestController extends Controller
{
    private $CRUD_RESOURCE_ROUTE_NAME="crud_route_name";
    private $CRUD_RESOURCE_ROUTE_VALUES=[];
    private $TABLE_ELOQUENT="App\Ders";
    private $TABLE_MANY_FOREIGN_KEYS=[
        //"App\Sinif"=>"sinif_id",
    ];

    private function root_page_link(){
        return route($this->CRUD_RESOURCE_ROUTE_NAME,$this->CRUD_RESOURCE_ROUTE_VALUES);
    }

    public function index(){
        $DinamikCrud = new DinamikCrud();
        $DinamikCrud->MainSGunes($this->TABLE_ELOQUENT);

        $DinamikCrud->Select=[
            "select"=>["*"],//["id","ders","sinif_id"]
            "table"=>[
                "ders"=>"DERS",
                "sinif_id"=>"SINIF ID"
            ]
        ];
        $DinamikCrud->SqlSearchWheres=[
            "ders"=>"",
        ];
        $DinamikCrud->SqlOrderBys=[
            "ders"=>"asc",
        ];

        //$DinamikCrud->SqlPaginate=4;
        /*
        $model = $DinamikCrud->modelGet();
        $DinamikCrud->modelSave($model->where());
        */
        $DinamikCrud->modelSave();
        $DinamikCrud->createDataAndGet("index");
        return $DinamikCrud->pageView("welcome",[
            "root_page_link"=>$this->root_page_link(),
        ]);
    }

    public function create(){
        $postForeignKeys = [
            "sinif_id" => 3,
        ];
        $inputs = [
            [
                "type"=>"text",
                "columns"=>[
                    "ders"=>"Lütfen Dersi Giriniz"
                ]
            ],
        ];
        $form=[
            "route_name"=>"crud_route_name.storage",
            "route_values"=>[],
            "method"=>"post",
        ];

        return view('dinamik_crud.create',compact('postForeignKeys','inputs','form'));
    }

    public function storage(Request $request){
        $request->validate([
            "sinif_id"=>"required"
        ]);
        $DinamikCrud = new DinamikCrud();
        $DinamikCrud->MainSGunes($this->TABLE_ELOQUENT);
        $result = $DinamikCrud->Storage($request->all());

        return redirect()->route($this->CRUD_RESOURCE_ROUTE_NAME);
    }

    public function destroy(Request $request){
        $request->validate([
            "id"=>"required|numeric",
        ]);
        $DinamikCrud = new DinamikCrud();
        $DinamikCrud->MainSGunes($this->TABLE_ELOQUENT);
        $result = $DinamikCrud->Destroy($request->id,$this->TABLE_MANY_FOREIGN_KEYS);

        return redirect()->route($this->CRUD_RESOURCE_ROUTE_NAME);
    }
}
