<?php

namespace App\Policies;

use App\Models\Adoption;
use App\Models\User;

class AdoptionPolicy
{
    /* -----------------------------------------------------------------
     |  Global override – uncomment if you need an admin “god mode”
     |------------------------------------------------------------------
     |
     |  public function before(User $user, string $ability): bool|null
     |  {
     |      if ($user->is_admin) {
     |          return true; // super-user sees & does everything
     |      }
     |      return null;      // fall back to per-ability checks
     |  }
     |------------------------------------------------------------------ */

    /**
     * May the user list *their* adoption requests?
     * We just require them to be logged-in.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * May the user view a specific adoption request?
     *
     * – Adopter can always see their own request  
     * – Pet owner can see requests for their pet
     */
    public function view(User $user, Adoption $adoption): bool
    {
        return $adoption->user_id === $user->id
            || $user->id === optional($adoption->pet)->owner_id;
    }

    /**
     * May the user start a new adoption request?
     * (You could check phone-verified / profile-complete flags here.)
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * May the user update (e.g. cancel) the request?
     * We reuse the same rule as *view()*; tweak if you need stricter control.
     */
    public function update(User $user, Adoption $adoption): bool
    {
        return $this->view($user, $adoption);
    }

    /**
     * May the user delete the request?
     * Usually only the adopter can hard-delete (if ever).
     */
    public function delete(User $user, Adoption $adoption): bool
    {
        return $adoption->user_id === $user->id;
    }

    /**
     * Restore / force-delete – disable unless you really need them.
     */
    public function restore(User $user, Adoption $adoption): bool
    {
        return false;
    }

    public function forceDelete(User $user, Adoption $adoption): bool
    {
        return false;
    }
}
