<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class NavigationsResource extends JsonResource {
/**
 * Transform the resource into an array.
 *
 * @param  IlluminateHttpRequest  $request
 * @return array
 */
public function toArray($request) {
/* for one record 
 
   return new NavigationsResource(Navigations::find($id)); 

 for multi records 

return NavigationsResource::collection(Navigations::all());
 */ 
return [
'link_text' => $this->link_text,
'url' => $this->url,
'description' => $this->description,
'group_id' => $this->group_id,
'click_count' => $this->click_count,
'created_at' => $this->created_at,
'updated_at' => $this->updated_at
];
}
}
