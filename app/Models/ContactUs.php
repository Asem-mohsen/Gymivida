<?php



namespace App\Models;

use App\Enums\AppLocale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactUs extends Model
{
    protected $table = 'contact_us';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'product_id',
        'wants_registration_email',
        'registration_token',
        'registration_email_sent_at',
        'status',
        'locale',
    ];

    protected $casts = [
        'wants_registration_email' => 'boolean',
        'registration_email_sent_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'locale' => AppLocale::class,
    ];

    public const STATUS_NEW = 'new';

    public const STATUS_IN_PROGRESS = 'in_progress';

    public const STATUS_RESOLVED = 'resolved';

    /**
     * @return array<string, string>
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_NEW => 'New',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_RESOLVED => 'Resolved',
        ];
    }

    /**
     * Locale used for user-facing emails related to this contact.
     */
    public function preferredLocale(): string
    {
        return AppLocale::normalize($this->locale)->value;
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
