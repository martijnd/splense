<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */

namespace App\Models {
	/**
	 * App\Models\Event
	 *
	 * @property int $id
	 * @property string $title
	 * @property int $user_id
	 * @property \Illuminate\Support\Carbon|null $closed_at
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \App\Models\User $creator
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Expense[] $expenses
	 * @property-read int|null $expenses_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
	 * @property-read int|null $users_count
	 * @method static \Database\Factories\EventFactory factory(...$parameters)
	 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
	 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEndedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTitle($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUserId($value)
	 */
	class Event extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\EventUser
	 *
	 * @property int $id
	 * @property int $user_id
	 * @property int $event_id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @method static \Illuminate\Database\Eloquent\Builder|EventUser newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|EventUser newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|EventUser query()
	 * @method static \Illuminate\Database\Eloquent\Builder|EventUser whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|EventUser whereEventId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|EventUser whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|EventUser whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|EventUser whereUserId($value)
	 */
	class EventUser extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\Expense
	 *
	 * @property int $id
	 * @property string $title
	 * @property int $user_id
	 * @property int $event_id
	 * @property int $amount
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \App\Models\Event $event
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $participants
	 * @property-read int|null $participants_count
	 * @property-read \App\Models\User $payer
	 * @method static \Database\Factories\ExpenseFactory factory(...$parameters)
	 * @method static \Illuminate\Database\Eloquent\Builder|Expense newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Expense newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|Expense query()
	 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereAmount($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereEventId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereTitle($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereUserId($value)
	 */
	class Expense extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\ExpenseUser
	 *
	 * @property int $id
	 * @property int $user_id
	 * @property int $expense_id
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseUser newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseUser newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseUser query()
	 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseUser whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseUser whereExpenseId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseUser whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseUser whereUpdatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseUser whereUserId($value)
	 */
	class ExpenseUser extends \Eloquent
	{
	}
}

namespace App\Models {
	/**
	 * App\Models\User
	 *
	 * @property int $id
	 * @property string $name
	 * @property string $email
	 * @property \Illuminate\Support\Carbon|null $email_verified_at
	 * @property string $password
	 * @property string|null $remember_token
	 * @property \Illuminate\Support\Carbon|null $created_at
	 * @property \Illuminate\Support\Carbon|null $updated_at
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
	 * @property-read int|null $events_count
	 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
	 * @property-read int|null $notifications_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
	 * @property-read int|null $tokens_count
	 * @method static \Database\Factories\UserFactory factory(...$parameters)
	 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|User query()
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
	 */
	class User extends \Eloquent
	{
	}
}
