<?php
// https://stackoverflow.com/questions/51091501/laravel-many-to-many-on-pivot-table-with-eloquent

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Course;
use App\Models\Role;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function PHPSTORM_META\map;

class User extends Authenticatable implements MustVerifyEmail
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'birthday',
        'gender',
        'picture',

        'mobile',
        'phone',
        'mobile_verified_at',
        'phone_verified_at',

        'profession',
        'biography',
        'branch',
        'aware_of_df',
        'work_status',
        'price_hour',

        'street',
        'street_number',
        'address_info',
        'postal_code',
        'city',
        'state',
        'country',
        'lat',
        'lng',

        'facebook',
        'linkedin',
        'instagram',
        'youtube',
        'tiktok',
        'twitter',
        'skype',
        'snapchat',
        'pinterest',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function assignRole($role)
    {
        $this->roles()->sync($role);
    }

    public function hasRole($id)
    {
        return in_array($id, $this->roles()->pluck('id')->toArray());
    }

    public function permissions()
    {
        return $this->roles->map->permissions->flatten()->pluck('slug')->unique();
    }

    public function teaches()
    {
        return $this->belongsToMany(Course::class, 'registrations', 'user_id', 'course_id')
            ->using('App\Models\Registration')
            ->withPivot('role')
            ->wherePivot('role', 'instructor')
            ->withTimestamps();
    }

    public function assists()
    {
        return $this->belongsToMany(Course::class, 'registrations', 'user_id', 'course_id')
            ->using('App\Models\Registration')
            ->withPivot('role')
            ->wherePivot('role', 'assistant')
            ->withTimestamps();
    }

    public function learns()
    {
        return $this->belongsToMany(Course::class, 'registrations', 'user_id', 'course_id')
            ->using('App\Models\Registration')
            ->withPivot('role', 'status')
            ->wherePivot('role', 'student')
            ->withTimestamps();
    }

    public function pendingCourses()
    {
        return $this->belongsToMany(Course::class, 'registrations', 'user_id', 'course_id')
            ->using('App\Models\Registration')
            ->withPivot('status')
            ->wherePivot('status', 'pre-registered')
            ->wherePivot('role', 'student')
            ->withTimestamps();
    }

    // public function pendingCoursesIDs()
    // {
    //     $ids = [];
    //     foreach ($this->pendingCourses as $item) {
    //         $ids[] = $item->id;
    //     }
    //     return $ids;    
    // }

    public function payedCourses()
    {
        return $this->belongsToMany(Course::class, 'registrations', 'user_id', 'course_id')
            ->using('App\Models\Registration')
            ->withPivot('status')
            ->wherePivot('status', 'payed')
            ->wherePivot('role', 'student')
            ->withTimestamps();
    }

    public function getAvatarAttribute()
    {

        if (!$this->picture) {
            return $this->gender === 'male' ? asset('images/avatar-male.png') : asset('images/avatar-female.png');
        }

        return $this->picture;
    }

    public function isAdmin()
    {
        $admin = Role::where('slug', 'admin')->first();
        return in_array($admin->id, $this->roles()->pluck('id')->toArray());
        //return $admin;
    }

    public function scopeWomen()
    {
        return $this->whereGender('female');
    }

    public function scopeMen()
    {
        return $this->whereGender('male');
    }

    public function registrationStatus($id, $uid = null)
    {
        if ($uid === null) {
            $uid = $this->id;
        }
        // Log::notice('course_id: ' . $id);
        
        $result = DB::table('registrations')
            ->where('user_id', $uid)
            ->where('course_id', $id)
            ->where('role', 'student')
            ->get();

        // Log::info($result);
        
        $status = collect($result)->map(function ($item) {
            return $item->status;
        })->first();
        
        // Log::error($status);
        return $status;
    }

    public function registrationDate($id)
    {
        $result = DB::table('registrations')
            ->where('user_id', $this->id)
            ->where('course_id', $id)
            ->where('role', 'student')
            ->get();

        $date = collect($result)->map(function ($item, $key) {
            return $item->created_at;
        })->first();
        return $date;
    }

    public function updateRegistrationStatus($id)
    {
        $registration = DB::table('registrations')
            ->where('user_id', $this->id)
            ->where('course_id', $id)
            ->get();
        dd($registration);
        return $registration;
    }

    public function isRegistered($id)
    {
        return in_array($id, $this->learns()->pluck('course_id')->toArray());
    }

    public function useReduced(): bool
    {
        if ($this->work_status != 'working') {
            return true;
        } else {
            return false;
        }
    }
}


// $user = User::find($userID);
//     $categoryIDs = $request->input('categories');

//     $result = DB::table('building_category')
//         ->where('building_id', $buildingID)
//         ->whereIn('category_id', $categoryIDs)
//         ->get();

//     $buildingCategories = collect($result)->map(function ($item, $key) {
//         return $item->id;
//     });

//     // now sync the collection as an array
//     $user->buildingCategories()->sync($buildingCategories->toArray());