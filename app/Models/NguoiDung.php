<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;


class NguoiDung extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table ='nguoidung';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'role',
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
	public function DonHang(): HasMany
	{
		return $this->hasMany(DonHang::class, 'nguoidung_id', 'id');
	}
    public function BaiViet(): HasMany
    {
       return $this->hasMany(BaiViet::class, 'nguoidung_id', 'id');
    }
    
    public function BinhLuanBaiViet(): HasMany
    {
        return $this->hasMany(BinhLuanBaiViet::class, 'nguoidung_id', 'id');
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustumResetPasswordNotification($token));
    }
    
}
class CustumResetPasswordNotification extends ResetPassword
{
    public function toMail($notifiable)
    {
        return(new MailMessage)
        ->subject('Khôi phục mật khẩu')
        ->line('Bạn vừa yêu cầu' .config('app.name') . 'Khôi phục mật khẩu mình')
        ->line('Liên kết đặt lại mk này sẽ hêts hạn trong chút xíu')
        ->line('Vui lòng nhấn vào nút "Khôi phục nhập mật khấu" để tiến hành cấp mk')
        ->action('Khôi phục mật khẩu', url(config('app.url') . route('password.reset', $this->token, false)))
        ->line('Nếu bạn không yêu cầu đặt lại mật khẩu, xin vui lòng không làm gì thêm và báo lại cho quản trị hệ thống về vấn đề này.');
    }
}