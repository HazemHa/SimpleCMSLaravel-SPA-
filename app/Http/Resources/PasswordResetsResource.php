<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class PasswordResetsResource extends JsonResource {
/**
 * Transform the resource into an array.
 *
 * @param  IlluminateHttpRequest  $request
 * @return array
 */
public function toArray($request) {
/* for one record 
 
   return new PasswordResetsResource(PasswordResets::find($id)); 

 for multi records 

return PasswordResetsResource::collection(PasswordResets::all());
 */ 
return [
'email' => $this->email,
'token' => $this->token,
'created_at' => $this->created_at,
'created_at' => $this->created_at,
'updated_at' => $this->updated_at
];
}
}
