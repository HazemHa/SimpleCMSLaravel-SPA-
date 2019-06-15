<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class CommentsResource extends JsonResource {
/**
 * Transform the resource into an array.
 *
 * @param  IlluminateHttpRequest  $request
 * @return array
 */
public function toArray($request) {
/* for one record 
 
   return new CommentsResource(Comments::find($id)); 

 for multi records 

return CommentsResource::collection(Comments::all());
 */ 
return [
'user_id' => $this->user_id,
'post_id' => $this->post_id,
'name' => $this->name,
'email' => $this->email,
'subject' => $this->subject,
'message' => $this->message,
'created_at' => $this->created_at,
'updated_at' => $this->updated_at
];
}
}
