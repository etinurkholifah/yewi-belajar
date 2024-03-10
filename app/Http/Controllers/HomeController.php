<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{   
    
    
    public function dashboard(){
        return view('dashboard');
    }

    public function index(){
        $friends = Friend::all();
        $quotes =$this->fetchApiQuotes();

        return view('views.layout.dashboard',[
            'friends' => $friends,
            'quotes'  => $quotes
        ]);

        $data = User::get();
        return view('index',compact('data'));

    }
    public function create(){
        return view('create');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'email'     => 'required|email',
            'nama'      =>  'required',
            'password'  =>  'required',
        ]);

        if($validator-> fails()) return redirect()->back()->withInput()->withErrors($validator);


        $data['email'] = $request->email;
        $data['name'] = $request->nama;
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('index');
    }
    public function edit(Request $request, $id){
        $data = User::find($id);
       
        return view('edit',compact('data'));
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'email'     => 'required|email',
            'nama'      =>  'required',
            'password'  =>  'nullable',
        ]);

        if($validator-> fails()) return redirect()->back()->withInput()->withErrors($validator);


        $data['email'] = $request->email;
        $data['name'] = $request->nama;
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }
        
        User::whereId($id)->update($data);

        return redirect()->route('index');
    }
    public function delete(Request $request, $id){
        $data = User::find($id);

        if($data){
            $data->delete();
        }
        return redirect()->route('index');
    }

        public function fetchApiQuotes(){
            $client = new Client();
            $url = "https://api.api-ninjas.com/v1/quotes";
            $api_key = "eQOB3CzeeaEiPf6+kXajow==5wtUyBdMYebDoUgH";
    
            try {
                $response = $client->request('GET', $url,[
                    'headers'=>[
                        'x-api-key'=>$api_key
                    ]
                ]);
                //return response()->json($response);
                if($response->getStatusCode() ==200){
                    $response_ninja_api = json_decode($response->getBody()->getContents(),true);
                    return response()->json([
                        'code' => 200,
                        'message' => 'Data Fetched',
                        'data' => $response_ninja_api
                    ]);
                }else {
                    return response()->json([
                        'code'=>404,
                        'message'=>'Whoopss! Sepertinya ada kesalahan'
                    ]);
                }
            }catch(ClientException $e){
                $response = $e->getResponse();
                $response_ninja_api = json_decode($response->getBody()->getContents(),true);
                return response()->json([
                    'code' => 400,
                    'message' => 'Whoopss',
                    'data' => $response_ninja_api
                ]);
            }
        }
    }