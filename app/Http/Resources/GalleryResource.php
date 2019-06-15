<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class GalleryResource extends JsonResource {
/**
 * Transform the resource into an array.
 *
 * @param  IlluminateHttpRequest  $request
 * @return array
 */
public function toArray($request) {
/* for one record 
 
   return new GalleryResource(Gallery::find($id)); 

 for multi records 

return GalleryResource::collection(Gallery::all());
 */ 
return [
'name' => $this->name,
'path' => $this->path,
'status' => $this->status,
'created_at' => $this->created_at,
'updated_at' => $this->updated_at
];
}
}
