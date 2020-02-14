# Resources 를 이용하여 api 만들기

1. `routes/api.php` 라우트 추가
```php
Route::group(['prefix' => 'v1'], function(){
    Route::resource('boards', 'api\\v1\\BoardController');
});
```

2. `artisan make:resource Board`
```php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\Comment as CommentResource;

class Board extends JsonResource {

    public function toArray($request){

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'title' => $this->title,
            'body' => $this->body,
            'thumbnail' => $this->thumbnail,
            'view_cnt' => $this->view_cnt,
            'like_cnt' => $this->like_cnt,
            'comment_cnt' => $this->comment_cnt,
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];

    }

}
```

3. `artisan make:resource User`
```php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource {

    public function toArray($request){
        return [
            'id' => $this->id,
            'name' => $this->name,
            'nickname' => $this->nickname,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'last_login_at' => $this->last_login_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}

```

4. `artisan make:resource Comment`
```php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\User as UserResource;

class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request){
        return [
            'id' => $this->id,
            'commentable_type' => $this->commentable_type,
            'commentable_id' => $this->commentable_id,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'body' => $this->body,
            'like_cnt' => $this->like_cnt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

}
```

5. `artisan make:controller ap1/v1/BoardController`
```php
namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Board;
use App\Http\Resources\Board as BoardResource;

class BoardController extends Controller {

    public function index(Request $request){

        $boards = Board::with(['user', 'thumbnail'])->orderBy('id', 'desc');
        $boards = $boards->paginate(15);

        return BoardResource::collection($boards);

    }

    public function show(Request $request, $id){
        return new BoardResource(Board::with(['user', 'thumbnail', 'comments.user'])->find($id));
    }
```

