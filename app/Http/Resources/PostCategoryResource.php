<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class PostCategoryResource extends JsonResource {
/**
 * Transform the resource into an array.
 *
 * @param  IlluminateHttpRequest  $request
 * @return array
 */
public function toArray($request) {
/* for one record 
 
   return new PostCategoryResource(PostCategory::find($id)); 

 for multi records 

return PostCategoryResource::collection(PostCategory::all());
 */ 
return [
'name' => $this->name,
'slugs' => $this->slugs,
'created_at' => $this->created_at,
'updated_at' => $this->updated_at
];
}
}
