<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    /**
 * Transform the resource into an array.
 *
 * @param  IlluminateHttpRequest  $request
 * @return array
 */
    public function toArray($request)
    {
        /* for one record

   return new UsersResource(Users::find($id));

 for multi records

return UsersResource::collection(Users::all());
 */
        return [
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'about' => $this->about,
            'image' => $this->image,
            'password' => $this->password,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}