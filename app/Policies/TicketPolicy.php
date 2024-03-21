<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
	use HandlesAuthorization;

	public function update(User $user, Ticket $ticket): bool
	{
		if ($user->hasRole('admin')) {
			return true;
		}

		if ($user->hasRole('agent') && $user->id === $ticket->agent_id) {
			return true;
		}

		return false;
	}

	public function delete(User $user): bool
	{
		return $user->hasRole('admin');
	}
}
