<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $first_given_name
 * @property string|null $second_given_name
 * @property string $first_family_name
 * @property string $second_family_name
 * @property string $email
 * @property string $password
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_given_name',
        'second_given_name',
        'first_family_name',
        'second_family_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFullname(): string
    {
        $parts = [
            $this->first_given_name,
            $this->second_given_name,
            $this->first_family_name,
            $this->second_family_name,
        ];

        // Remove any null or empty values
        $parts = array_filter($parts, fn ($name) => ! empty($name));

        // Concatenate with spaces
        return implode(' ', $parts);
    }
}
