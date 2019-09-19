<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function video(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'video_link' => 'required',
            'video_new_name' => 'required',
        ],[
            'video_link.required' => '请输入视频链接！',
            'video_new_name.required' => '请输入保存视频的新名称！',
        ]);
        if ( $validator->fails() ){
            return redirect('home' )->withErrors( $validator )->withInput();
        }
        $link_address = Arr::get( $input,'video_link');
        $baseUrl = trim( dirname( $link_address,1) );
        $content = '';
        try{
            $links = file( $link_address );
            foreach ( $links  as $link ){
                if ( $link[0] != '#' ){
                    $content .= file_get_contents($baseUrl . '/' . trim($link));
                }
            }
            Storage::disk( 'public' )->put('video.txt',$content);
            $file_path = storage_path('app/public/video.txt');
            return response()->download($file_path,Arr::get( $input,'video_new_name' ) . '.mp4');
        }catch (\Exception $exception){
            $validator->errors()->add('auth_url','链接解析失败,请重试！');
            return redirect('home' )->withErrors( $validator )->withInput();
        }

    }
}
