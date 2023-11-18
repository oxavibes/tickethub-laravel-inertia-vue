<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ticket extends Model
{
	use HasFactory;

	public function users(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function labels(): BelongsToMany
	{
		return $this->belongsToMany(Label::class, 'ticket_label', 'ticket_id', 'label_id');
	}
}
