<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DevelopedList;
use Illuminate\Auth\Access\HandlesAuthorization;

class DevelopedListPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_developed::list');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DevelopedList $developedList): bool
    {
        return $user->can('view_developed::list');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_developed::list');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DevelopedList $developedList): bool
    {
        return $user->can('update_developed::list');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DevelopedList $developedList): bool
    {
        return $user->can('delete_developed::list');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_developed::list');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, DevelopedList $developedList): bool
    {
        return $user->can('force_delete_developed::list');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_developed::list');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, DevelopedList $developedList): bool
    {
        return $user->can('restore_developed::list');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_developed::list');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, DevelopedList $developedList): bool
    {
        return $user->can('replicate_developed::list');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_developed::list');
    }
}
