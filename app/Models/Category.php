<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
	use HasFactory;

	public function tickets(): BelongsToMany
	{
		return $this->belongsToMany(Ticket::class, 'category_ticket', 'category_id', 'ticket_id');
	}
}
