<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * Get all user blogs or posts.
    */
   public function blogs()
   {
       return $this->hasMany(Blog::class);
   }

   /**
   * Get all user comments.
   */
  public function comments()
  {
      return $this->hasMany(Comment::class);
  }
}
