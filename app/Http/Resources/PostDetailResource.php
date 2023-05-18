<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
     public function toArray($request)
    {
        return [
            'id' => $this -> id,
            'Golongan' => $this -> Golongan,
            'Kategori' => $this -> Kategori,
            'Manfaat' => $this -> Manfaat,
            'Digunakan_oleh' => $this -> Digunakan_oleh,
            'Bentuk_Obat' => $this -> Bentuk_obat,
            'created_at' => date_format($this->created_at,"Y/m/d H:i:s"),
            'author' => $this -> author,
            'writer' => $this -> writer,
            'comments' => $this-> whenLoaded('comments'),
        ];
    }
}
