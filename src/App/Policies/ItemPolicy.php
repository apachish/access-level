<?php

namespace Apachish\AccessLevel\App\Policies;


use Apachish\AccessLevel\Models\User;
use Apachish\AccessLevel\Models\Item;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before($user, $ability)
    {
        //
    }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \Apachish\AccessLevel\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
       return auth()->check();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Apachish\AccessLevel\Models\User  $user
     * @param  \Apachish\AccessLevel\Models\Item  $item
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Item $item)
    {
       return auth()->check();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Apachish\AccessLevel\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->roles()->whereIn("name", ["admin", "author"])->count())
            return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Apachish\AccessLevel\Models\User  $user
     * @param  \Apachish\AccessLevel\Models\Item  $item
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Item $item)
    {
        if ($user->roles()->where("name", ["admin"])->count())
            return true;
        elseif ($user->roles()->where("name",  "author")->count() && $item->user_id == $user->id)
            return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Apachish\AccessLevel\Models\User  $user
     * @param  \Apachish\AccessLevel\Models\Item  $item
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Item $item)
    {
        if ($user->roles()->where("name", ["admin"])->count())
            return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \Apachish\AccessLevel\Models\User  $user
     * @param  \Apachish\AccessLevel\Models\Item  $item
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Item $item)
    {
        if ($user->roles()->where("name", ["admin"])->count())
            return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \Apachish\AccessLevel\Models\User  $user
     * @param  \Apachish\AccessLevel\Models\Item  $item
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Item $item)
    {
        if ($user->roles()->where("name", ["admin"])->count())
            return true;
    }
}
