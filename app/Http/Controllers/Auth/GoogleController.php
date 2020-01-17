<?php

namespace App\Http\Controllers\Auth;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Exception;
use App\User;
use App\Admin;
class GoogleController extends Controller
{
    
    public function redirectToGoogle(){
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback(){
        try{
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_id', $user->id)->first();
            error_log($finduser);
            if($finduser){
                //$persona=explode(" ",$user->name);
                //error_log($persona[1] . " " . $persona[2]);
                Auth::login($finduser);
                return redirect('/homeProfesor');
            }else{
                $finduser = Admin::where('google_id', $user->id)->first();
                
                if($finduser){
                    Auth::login($finduser);
                    return redirect('/homeAdmin');
                }else{
                    $e=explode('@',$user->email);//sacamos lo que vaya separado por el @
                    
                    $persona=explode(" ",$user->name);//sacamos lo que este separado por un espacio
                    
                    $izena=$persona[0];//nombre
                    $abizena=$persona[1] ;//apellido
                    if(count($persona)>2){
                        $abizena.= " ".$persona[2];
                    }
                    /*
                    //CASO ADMIN                
                    $newUser=Admin::create([
                        'name' => $izena,
                        'apellido'=>$abizena,
                        'email'=>$user->email,
                        'google_id'=>$user->id,
                        'password'=>encrypt('123456password')
                    ]);
                    error_log($user->name);
                    Auth::login($newUser);
                    return redirect('/homeAdmin');*/
                    //CASO USUARIOS
                    if($e[1]=='plaiaundi.net'){
                        $newUser=User::create([
                            'name' => $izena,
                            'apellido'=>$abizena,
                            'email'=>$user->email,
                            'google_id'=>$user->id,
                            'password'=>encrypt('123456password')
                        ]);
                        error_log($user->name);
                        Auth::login($newUser);
                    }else{
                        $newUser=Admin::create([
                            'name' => $izena,
                            'apellido'=>$abizena,
                            'email'=>$user->email,
                            'google_id'=>$user->id,
                            'password'=>encrypt('123456password')
                        ]);
                        error_log($user->name);
                        Auth::login($newUser);
                        return redirect('/homeAdmin');
                    }
                }
                return redirect('/homeProfesor');
            }
        }catch(Esception $e){
            dd($e->getMessage());
        }
    }
}
