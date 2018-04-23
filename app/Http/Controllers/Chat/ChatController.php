<?php

namespace App\Http\Controllers\Chat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    
    protected $data = null;
    

    public function __construct(){
        $this->data = new \stdClass();
        $this->date = date ("Y-m-d H:i:s");
    }

    public function Login() {
    	return view('chat.login');
    }

    public function ChatRoom() {
    	return view('chat.chat_room');
    }

}
