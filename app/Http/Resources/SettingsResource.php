<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class SettingsResource extends JsonResource {
/**
 * Transform the resource into an array.
 *
 * @param  IlluminateHttpRequest  $request
 * @return array
 */
public function toArray($request) {
/* for one record 
 
   return new SettingsResource(Settings::find($id)); 

 for multi records 

return SettingsResource::collection(Settings::all());
 */ 
return [
'site_name' => $this->site_name,
'site_email' => $this->site_email,
'site_location' => $this->site_location,
'site_aboutUs' => $this->site_aboutUs,
'created_at' => $this->created_at,
'updated_at' => $this->updated_at
];
}
}
