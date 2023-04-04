<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Debtor
 *
 * @property int $id
 * @property string $name
 * @property int $phone
 * @property int|null $reserve_phone
 * @property string $balance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaction> $transactions
 * @property-read int|null $transactions_count
 * @method static \Database\Factories\DebtorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor showDebtorsPercentWhereHasDebts()
 * @method static \Illuminate\Database\Eloquent\Builder|Debtor whereHasDebts()
 */
	class Debtor extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $user_id
 * @property int $debtor_id
 * @property string $pay_amount
 * @property string $received_amount
 * @property string $transaction_remark
 * @property string $transaction_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Debtor|null $debtor
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction search($term)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction showDebtsPercent()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction showPaidDebtsPercent()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction totalDebts()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction totalDebtsPaid()
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
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
 * @property string|null $avatar
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Debtor> $debtors
 * @property-read int|null $debtors_count
 * @property-read mixed $avatar_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaction> $transactions
 * @property-read int|null $transactions_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

