<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class NavigationGroupsResource extends JsonResource {
/**
 * Transform the resource into an array.
 *
 * @param  IlluminateHttpRequest  $request
 * @return array
 */
public function toArray($request) {
/* for one record 
 
   return new NavigationGroupsResource(NavigationGroups::find($id)); 

 for multi records 

return NavigationGroupsResource::collection(NavigationGroups::all());
 */ 
return [
'name' => $this->name,
'slug' => $this->slug,
'created_at' => $this->created_at,
'updated_at' => $this->updated_at
];
}
}
