<?php

namespace App\Http\Controllers;
use App\Incidencia;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Redirect,Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    /***************** METODOS COMUNES *****************/
    public function index()
    {
        return view('home');
    }

    //Metodo mostrar los datos en el dialog
    public function mostrarDatos($id){
        //error_log("datos");

        //cogemos los datos de la incidencia usando la id
        $findIncidencia=Incidencia::all()->where('id',$id)->first();
       
        $profesor=User::all()->where('id',$findIncidencia->user_id);
        $profe= $profesor[0]['name'] . " " .  $profesor[0]['apellido'] ;
        error_log($findIncidencia . " UNO");
        $findIncidencia['user_id']=$profe;
        error_log($findIncidencia . " Dos");
        //devolvemos los datos en formato json
        return Response::json($findIncidencia);
    }

    /************************************** PROFESORES ******************************************************/
    public function profesor()
    {
        //Cogemos las incidencias que pertenezcan al profesor de ID X
        $aIncidencias=Incidencia::all()->where('user_id',auth::user()->id);
        
        //pasamos el array de incidencias al home del profesor
        return view('/profesores/homeProfesor', ['aIncidencias'=> $aIncidencias]);
    }

    public function formNuevaIncidencia(){
        //mostramos el formulario
        return view ('/profesores/formIncidencia');
    }

    public function RegistrarNuevaIncidencia(Request $request){
        //validar la existencia 
        $i=Incidencia::all()->where(['aula'=>$request->aula, 'cod_equipo'=>$request->cod_equipo,'cod_incidencia'=>$request->cod_incidencia]);
            
        //aqui iba la condicion para verificar que la incidencia no existe
        //
        // if ($i)

            if($request->descripcion == null){
                $request->descripcion=" ";
            }
            //creamos la incidencia volvemos al home
            error_log("creamos incidencias");
            $incidecina=Incidencia::create([
                'user_id' => auth::user()->id,
                'aula'=>$request->aula,
                'cod_equipo'=>$request->cod_equipo,
                'cod_incidencia'=>$request->cod_incidencia,
                'admin_id'=>0, // esto requiere que exista un admin de serie, sino da error al crear
                'estado'=>'Sin asignar',
                'descripcion'=>$request->descripcion,
                'tipo_equipo'=>$request->tipo_equipo
            ]); 

        //redireccion al home del usuario
        return redirect ('/homeProfesor');

    }

    public function Editar($id){
        error_log("editar " . $id);
        $findIncidencia=Incidencia::all()->where('id',$id)->first();
        return Response::json($findIncidencia);
    }

    public function EditarFinalizar(Request $request){
        
        $findIncidencia=Incidencia::all()->where('id',$request->id);
        if($request->descripcion == null){
            $request->descripcion=" ";
        }
        DB::table('incidencias')
            ->where('id', $request->id)
            ->update(['aula' => $request->aula, 'cod_incidencia'=>$request->cod_incidencia, 'cod_equipo'=>$request->cod_equipo,'descripcion'=>$request->descripcion, 'tipo_equipo'=>$request->tipo_equipo]);
        return redirect ('/homeProfesor');
    }

    /********************************************* ADMINS *************************************************************/
    public function admin()
    {
        //error_log(auth::user()->id);
        //guardamos en un array las incidencias no asignadas (admin=0)
        $aTodasIncidencias=Incidencia::all()->where('admin_id',0);
        //guardamos en un array las incidencias del usuario 
        $aMisIncidencias=Incidencia::all()->where('admin_id',auth::user()->id);
        //pasamos al home los dos arrays, uno para cada tabla. 
        return view('/admins/homeAdmin', ['aTodas'=> $aTodasIncidencias,'aMias'=>$aMisIncidencias]);
    }
    /*
    public function changeStatus($data)
    {
        error_log("eadfadfafdafasdfasdfa ");
        error_log(auth::user()->id);
        error_log($data);
        //$data = array('id'=>$name);
        //error_log($name + "la id");
        DB::table('incidencias')
            ->where('id', $data)
            ->update(['admin_id' => auth::user()->id]);

        return response()->json(['success'=>'Status change successfully.']);

    }*/
    //adquirir (dialogo)
    public function updateAdmin($id){
        error_log("update con dialog");
        $findIncidencia=Incidencia::all()->where('id',$id)->first();
        return Response::json(['incidencia'=>$findIncidencia]);
    }
    public function updateAdminFin(Request $request){
        error_log("FIN update con dialog");
        DB::table('incidencias')
            ->where('id', $request->id)
            ->update(['admin_id' => auth::user()->id, 'estado'=>'En proceso']);
        return redirect ('/homeAdmin');

    }
    //adquirir con link (formulario)
    /*
    public function adquirir($id){
        $findIncidencia=Incidencia::all()->where('id',$id)->first();
        return view ('/admins/formAdquirir', ['incidencia'=>$findIncidencia]);
    }
    public function adquirirFin(Request $request){
        //error_log($request->id);
        DB::table('incidencias')
            ->where('id', $request->id)
            ->update(['estado' => 'En proceso', 'admin_id'=>auth::user()->id]);
        return redirect ('/homeAdmin');
    }
    */

    //Estado
    public function estado($id){
        /* FORMULARIO
        $findIncidencia=Incidencia::all()->where('id',$id)->first();
        $profesor=User::all()->where('id',$findIncidencia->user_id);
        //error_log($profesor[0]['name'] . " " . $profesor[0]['apellido'] );
        $profe= $profesor[0]['name'] . " " .  $profesor[0]['apellido'] ;
        error_log($profe);
        return view ('/admins/estadoIncidencia', ['incidencia'=>$findIncidencia, 'profesor'=>$profe]);
        */
        $findIncidencia=Incidencia::all()->where('id',$id)->first();
        return Response::json($findIncidencia);
    }
    public function estadoFin(Request $request){
        //error_log($request->id);        
        DB::table('incidencias')
            ->where('id', $request->id)
            ->update(['estado' => $request->estado ]);
        if($request->estado=='Finalizado'){
            DB::table('incidencias')
            ->where('id', $request->id)
            ->delete();
        }
        if($request->estado=='Sin asignar'){
            DB::table('incidencias')
                ->where('id', $request->id)
                ->update(['admin_id'=>0]);
        }
        return redirect ('/homeAdmin');
    }
}
