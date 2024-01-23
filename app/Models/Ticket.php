<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ticket extends Model
{
	use HasFactory;

	protected $fillable = [
		'title',
		'description',
		'file_paths',
		'status',
		'priority',
		'agent_id'
	];

	public function users(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function labels(): BelongsToMany
	{
		return $this->belongsToMany(Label::class);
	}

	public function categories(): BelongsToMany
	{
		return $this->belongsToMany(Category::class);
	}
}
