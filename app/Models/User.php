<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    protected $guard_name = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'codigo',
        'dni',
        'name',
        'email',
        'password',
        'sede_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function SolicitudDePedido(){
        return $this->hasMany(SolicitudDePedido::class,'solicitante');
    }

    public function ProgramacionDeTractor(){
        return $this->hasMany(ProgramacionDeTractor::class,'tractorista');
    }
    public function Implementos(){
        return $this->hasMany(Implemento::class,'responsable');
    }
    public function Sede(){
        return $this->belongsTo(Sede::class);
    }
    public function SupervisorModel(){
        return $this->belongsTo(User::class,'supervisor');
    }
    public function canAccessFilament(): bool{
        return $this->is_admin;
    }
}
