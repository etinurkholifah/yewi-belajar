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
            $quotes = $this->fetchApiQuotes();
        // dd($quotes);
            return view('dashboard', [
                'friends' => $friends,
                'quotes'  => $quotes,
            ]);

        $data = User::get();
        return view('index',compact('data'));

    }
    public function create(){
        return view('create');
    }
    public function store(Request $request){
        
        $validator = Validator::make($request->all(),[
            'nama'      =>  'required',
            'email'     => 'required|email',
            'number'    => 'required',
            'sosmed'    => 'required',
            'password'  =>  'required',
        ]);

        if($validator-> fails()) return redirect()->back()->withInput()->withErrors($validator);


        $data['name'] = $request->nama;
        $data['email'] = $request->email;
        $data['number'] = $request->number;
        $data['sosmed'] = $request->sosmed;
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
            
            'nama'      =>  'required',
            'email'     => 'required|email',
            'number'      =>  'required',
            'sosmed'      =>  'required',
            'password'  =>  'nullable',
        ]);

        if($validator-> fails()) return redirect()->back()->withInput()->withErrors($validator);


        $data['name'] = $request->nama;
        $data['email'] = $request->email;
        $data['number'] = $request->number;
        $data['sosmed'] = $request->sosmed;
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
                    return $response_ninja_api[0]["quote"];
                    // return response()->json([
                    //     'code' => 200,
                    //     'message' => 'Data Fetched',
                    //     'data' => $response_ninja_api
                    // ]);
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