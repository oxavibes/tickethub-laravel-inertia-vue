<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function agent()
	{
		return $this->belongsTo(User::class, 'agent_id');
	}

	public function labels(): BelongsToMany
	{
		return $this->belongsToMany(Label::class);
	}

	public function categories(): BelongsToMany
	{
		return $this->belongsToMany(Category::class);
	}

	public function assignAgent(User $agent)
	{
		if ($agent->hasRole('agent')) {
			// Assign the agent to the ticket
			$this->agent()->associate($agent);
			$this->save();
		}
	}

	public function removeAgent()
	{
		$this->agent()->dissociate();
		$this->save();
	}
}
