<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class CategoryResource extends JsonResource {
/**
 * Transform the resource into an array.
 *
 * @param  IlluminateHttpRequest  $request
 * @return array
 */
public function toArray($request) {
/* for one record 
 
   return new CategoryResource(Category::find($id)); 

 for multi records 

return CategoryResource::collection(Category::all());
 */ 
return [
'name' => $this->name,
'description' => $this->description,
'created_at' => $this->created_at,
'updated_at' => $this->updated_at
];
}
}
