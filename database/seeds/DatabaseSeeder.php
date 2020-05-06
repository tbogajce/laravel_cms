<?php

use App\Category;
use App\Comment;
use App\CommentReply;
use App\Photo;
use App\Post;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // if we have some relationships and don't want to get foreign key errors
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // empty tables before seeding
        DB::table('users')->truncate();
        DB::table('posts')->truncate();
        DB::table('roles')->truncate();
        DB::table('categories')->truncate();
        DB::table('photos')->truncate();
        DB::table('comments')->truncate();
        DB::table('comment_replies')->truncate();

        factory(User::class, 10)->create()->each(function($user){
            $user->posts()->save(factory(Post::class)->make());
        });

        factory(Role::class, 3)->create();
        factory(Category::class, 10)->create();
        factory(Photo::class, 1)->create();

        factory(Comment::class, 10)->create()->each(function($comment){
            $comment->replies()->save(factory(CommentReply::class)->make());
        });






        // $this->call(UsersTableSeeder::class);
    }
}
