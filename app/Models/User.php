<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements HasMedia, Auditable
{
    use InteractsWithMedia;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'works_at',
        'position_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function drafts(): HasMany
    {
        return $this->hasMany(Draft::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(UserActivity::class);
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function recipients(): HasMany
    {
        return $this->hasMany(Recipient::class);
    }

    public function threads(): BelongsToMany
    {
        return $this->belongsToMany(Thread::class,'participants','user_id','thread_id');
    }

    public function newThreadsCount(): int
    {
        return $this->threadsWithNewMessages()->count();
    }

    public function unreadMessagesCount(): int
    {
        return DB::table('recipients')
        ->join('messages','recipients.message_id','=','messages.id')
        ->join('users','recipients.user_id','=','users.id')
        ->where('users.id','=',$this->id)
        ->where('messages.status','=','sent')
        ->whereNull('recipients.last_read')->count();
    }

    public function threadsWithNewMessages(): Collection
    {
        return $this->threads()
            ->where(function (Builder $q) {
                $q->whereNull(Models::table('participants') . '.last_read');
                $q->orWhere(Models::table('threads') . '.updated_at', '>', $this->getConnection()->raw($this->getConnection()->getTablePrefix() . Models::table('participants') . '.last_read'));
            })->get();
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(OrganizationHierarchy::class,'works_at','id')->withDefault([
            'name_short' => '',
        ]);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class,'position_id','id');
    }

    public function scopeInternalUser(Builder $query): Builder
    {
        $org    = auth()->user()->organization->getRoot();
        $orgs   = $org->allChildren()->pluck('id')->toArray();
        $orgs[] = $org->id;

        return $query->whereIn('works_at',$orgs);
    }

    public function getAllMedia(): MediaCollection
    {
        if(auth()->user()->hasRole(['admin','front desk']))
            $media = Media::where('collection_name',$this->organization->name_short)->get();
        else
            $media  = $this->getMedia($this->organization->getRoot()->name_short);

        $shared = Message::sharedMedia();

        return $media->merge($shared)->unique('id');
    }

    public function scopeGetFrontDesk(Builder $query)
    {
        return $query->with('organization:id,name_short')
            ->select('id','name as label','works_at')
            ->role('front desk')
            ->where('id','!=',auth()->id());
    }

    public static function promote($users, $newOrgId){
        foreach($users as $user)
        {
            $user->works_at = $newOrgId;
            $user->save();
        }
    }
}
