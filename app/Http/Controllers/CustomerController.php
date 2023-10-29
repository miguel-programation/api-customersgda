<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use Validator;
use App\Models\Region;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Aqui creamos el controlador Customer
class CustomerController extends Controller
{
    //En este metodo index hacemos la consulta con las tablas relacionadas foreing key
    public function index()
    {
        $customer = DB::table('customers')
        ->join('regions', 'regions.id_reg', '=', 'customers.id_reg')
        ->join('communes','communes.id_com', '=', 'customers.id_com')
        ->select('customers.*', 'regions.description as region', 'communes.description as commune')
        ->get();

        //Aqui hacemos el ciclo para validar customer activo
        foreach ($customer as $custo) {
             if($custo->status == 'A'){

                //Aqui eliminamos los registros que no queremos mostrar en la consulta
                unset($custo->dni,$custo->id_reg,$custo->id_com,$custo->email);
                $cus[] = $custo;

             }

        }

        //Aqui validamos address vacia sea nula
        foreach ($cus as $cu) {
            if($cu->address == ''){

                $cu->address = NULL;
            }
       }

       return response()->json($cus);
    }


    //En el metodo store guardamos los datos del customer
    public function store(Request $request)
    {
        $rules = [
             'dni' => 'required|numeric|min:8',
             'id_reg' => 'required',
             'id_com' => 'required',
             'email' => 'required|email|max:80',
             'name' => 'required|string|min:2|max:100',
             'last_name' => 'required|string|min:2|max:100',
             'address' => 'required|string|min:1|max:100',
             'status' => 'required|string|min:1|max:1'
        ];

        //En este condicional validamos si existe region y communa
        if (Region::where('id_reg', $request->id_reg)->exists() && Commune::where('id_com', $request->id_com)->exists())
        {
            $validator = Validator::make($request->input(),$rules);
            if($validator->fails()){
                 return response()->json([
                      'status' => false,
                      'errors' => $validator->errors()->all()
                 ], 400);
             }
             $customer = new Customer($request->input());
             $customer->save();
             return response()->json([
                 'status' => true,
                 'message' => 'Cliente creado sastisfactoriamente'
             ], 200);
        }
        else
        {
            echo 'La region o la comunidad no existen';
            exit();
        }
    }

    //Aqui eliminamos el customer por el dni validando que exista
    public function destroy($dni)
    {

           if (Customer::where('dni', $dni)->exists()){

            Customer::destroy($dni);
            return response()->json([
                'status' => true,
                'message' => 'Cliente eliminado sastisfactoriamente'
            ], 200);

        }else
        {
             echo 'Cliente no existe';

        }



    }
}
