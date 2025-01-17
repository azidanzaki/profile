<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaResource extends JsonResource
{
    public $status;
    public $message;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function __construct($status, $message, $resouce){
        parent::__construct($resouce);
        $this->status =$status;
        $this->message =$message;
    }
    
    public function toArray($request)
    {
        return [
            'succes'  => $this ->status,
            'message' => $this -> message,
            'data'    => $this ->resource
        ];
    }
}
