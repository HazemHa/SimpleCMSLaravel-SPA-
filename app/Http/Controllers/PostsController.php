<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
class PostsController extends Controller
{
/***Store a newly created resource in storage.*
 *
@param\Illuminate\Http\Request $request *
@return\Illuminate\Http\Response *
 */
    public function store(Request $request)
    {
/*
$validatedData = $request->validate([
'user_id' => 'required',
'title' => 'required',
'content' => 'required',
'category_id' => 'required',
'image' => 'required',
'status_id' => 'required',
'click' => 'required'
]);
 */

/*
$validator = Validator::make($request->all(), [
'user_id' => 'required',
'title' => 'required',
'content' => 'required',
'category_id' => 'required',
'image' => 'required',
'status_id' => 'required',
'click' => 'required'
]);
if ($validator->fails()) {
return redirect()->back()
->withErrors($validator)
->withInput();
}
 */

// $request->validated();
        $newRecord = new Posts;
        $newRecord->user_id = $request->user_id;
        $newRecord->title = $request->title;
        $newRecord->content = $request->content;
        $newRecord->category_id = $request->category_id;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/posts');
            $path = preg_replace('/public/','storage', $path);
        }
        $newRecord->image = env('APP_URL').'/'.$path;
        $newRecord->status_id = $request->status_id;
        $result = $newRecord->save();

/*
$newRecord = App\undefined::create(['user_id'=>$request->user_id,
'title'=>$request->title,
'content'=>$request->content,
'category_id'=>$request->category_id,
'image'=>$request->image,
'status_id'=>$request->status_id,
'click'=>$request->click
]);

 */
        return $this->createResponseMessage($result);
    }

    // this for update record :
    /***
    Update the specified resource in storage.**
    @param\Illuminate\Http\Request $request *
    @param int $id *
    @return\Illuminate\Http\Response *
     */
    public function update(Request $request, $id)
    {
/*
$validatedData = $request->validate([
'user_id' => 'required',
'title' => 'required',
'content' => 'required',
'category_id' => 'required',
'image' => 'required',
'status_id' => 'required',
'click' => 'required'
]);
 */

/*
$validator = Validator::make($request->all(), [
'user_id' => 'required',
'title' => 'required',
'content' => 'required',
'category_id' => 'required',
'image' => 'required',
'status_id' => 'required',
'click' => 'required'
]);
if ($validator->fails()) {
return redirect()->back()
->withErrors($validator)
->withInput();
}
 */

        $UpdatedRecord = App\Posts::find($id);
        $UpdatedRecord->user_id = $request->user_id;
        $UpdatedRecord->title = $request->title;
        $UpdatedRecord->content = $request->content;
        $UpdatedRecord->category_id = $request->category_id;
        $UpdatedRecord->image = $request->image;
        $UpdatedRecord->status_id = $request->status_id;
        $UpdatedRecord->click = $request->click;
        $result = $UpdatedRecord->save();

/*
$result = $UpdatedRecord->update($request->all()); */

        return $this->createResponseMessage($result);

    }

// this for destroy record :
    /***
    Remove the specified resource from storage.*
     *
    @param int $id *
    @return\Illuminate\Http\Response
     **/
    public function destroy($id)
    {

        $record = App\Posts::findOrFail($id);
        $result = App\Posts::destroy($record->id);

        return $this->createResponseMessage($result);
    }

}
