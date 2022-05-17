<?php

namespace App\Models\dashboard;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $guard = 'admin';
    protected $guard_name = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function SearchByKeyword($keyword)
    {
        return $this->where("name", "LIKE", "%$keyword%")
            ->orWhere("email", "LIKE", "%$keyword%");
    }

    public function SearchByKeywordAndColumn($columns)
    {
        $data = $this->where('id', 0);
        foreach ($columns as $column => $value) {
            if ($value != '') {
                $data->orWhere($column, "LIKE", "%$value%");
            }
        }
        return $data;
    }
}
