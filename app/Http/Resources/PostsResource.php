<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class PostsResource extends JsonResource {
/**
 * Transform the resource into an array.
 *
 * @param  IlluminateHttpRequest  $request
 * @return array
 */
public function toArray($request) {
/* for one record 
 
   return new PostsResource(Posts::find($id)); 

 for multi records 

return PostsResource::collection(Posts::all());
 */ 
return [
'user_id' => $this->user_id,
'title' => $this->title,
'content' => $this->content,
'category' => $this->category,
'image' => $this->image,
'status' => $this->status,
'created_at' => $this->created_at,
'updated_at' => $this->updated_at
];
}
}
