<?php
// File: app/Models/Adoption.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Adoption extends Model
{
    use HasFactory;

    /* -----------------------------------------------------------------
     |  Constants
     |------------------------------------------------------------------
     */

    public const STATUS_DRAFT     = 'draft';
    public const STATUS_PENDING   = 'pending';
    public const STATUS_APPROVED  = 'approved';
    public const STATUS_REJECTED  = 'rejected';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    /* -----------------------------------------------------------------
     |  Mass-assignable attributes
     |------------------------------------------------------------------
     */

    protected $fillable = [
        'user_id',
        'pet_id',
        'status',
        'application_data',
        'admin_notes',
        'user_notes',
        'requested_at',
        'approved_at',
        'completed_at',
        'rejected_at',
        'rejection_reason',
        'final_fee',
        'reference_number',
        'current_step',
        'terms_accepted',
        'mobile_verified',
        'verification_code',
        'verification_sent_at',
    ];

    /* -----------------------------------------------------------------
     |  Attribute casting
     |------------------------------------------------------------------
     */

    protected $casts = [
        'application_data'   => 'array',
        'requested_at'       => 'datetime',
        'approved_at'        => 'datetime',
        'completed_at'       => 'datetime',
        'rejected_at'        => 'datetime',
        'verification_sent_at' => 'datetime',
        'final_fee'          => 'decimal:2',
        'current_step'       => 'integer',
        'terms_accepted'     => 'boolean',
        'mobile_verified'    => 'boolean',
    ];

    /* -----------------------------------------------------------------
     |  Relationships
     |------------------------------------------------------------------
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    /* -----------------------------------------------------------------
     |  Global scopes / Model events
     |------------------------------------------------------------------
     */

    protected static function booted(): void
    {
        // Automatically generate a unique reference number on create
        static::creating(function (self $adoption) {
            if (empty($adoption->reference_number)) {
                $adoption->reference_number = strtoupper(Str::random(10));
            }
        });
    }

    /* -----------------------------------------------------------------
     |  Query scopes
     |------------------------------------------------------------------
     */

    public function scopeStatus(Builder $query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeDraft(Builder $query)     { return $this->scopeStatus($query, self::STATUS_DRAFT); }
    public function scopePending(Builder $query)   { return $this->scopeStatus($query, self::STATUS_PENDING); }
    public function scopeApproved(Builder $query)  { return $this->scopeStatus($query, self::STATUS_APPROVED); }
    public function scopeRejected(Builder $query)  { return $this->scopeStatus($query, self::STATUS_REJECTED); }
    public function scopeCompleted(Builder $query) { return $this->scopeStatus($query, self::STATUS_COMPLETED); }
    public function scopeCancelled(Builder $query) { return $this->scopeStatus($query, self::STATUS_CANCELLED); }

    /* -----------------------------------------------------------------
     |  Business-logic helpers
     |------------------------------------------------------------------
     */

    public function markRequested(): void
    {
        $this->update([
            'status'       => self::STATUS_PENDING,
            'requested_at' => now(),
        ]);
    }

    public function approve(): void
    {
        $this->update([
            'status'      => self::STATUS_APPROVED,
            'approved_at' => now(),
        ]);
    }

    public function complete(): void
    {
        $this->update([
            'status'       => self::STATUS_COMPLETED,
            'completed_at' => now(),
        ]);

        // Keep the pet table in sync
        $this->pet()->update(['status' => 'adopted']);
    }

    public function reject(string $reason = null): void
    {
        $this->update([
            'status'           => self::STATUS_REJECTED,
            'rejected_at'      => now(),
            'rejection_reason' => $reason,
        ]);
    }

    public function cancel(): void
    {
        $this->update(['status' => self::STATUS_CANCELLED]);
    }

    /* -----------------------------------------------------------------
     |  Verification helpers
     |------------------------------------------------------------------
     */

    /**
     * Push a new mobile verification code and record the send-time.
     */
    public function sendVerificationCode(): string
    {
        $code = random_int(100000, 999999);

        $this->forceFill([
            'verification_code'   => $code,
            'verification_sent_at' => now(),
        ])->save();

        // You’d publish an event / job here to actually send the SMS/email.
        // event(new VerificationCodeGenerated($this));

        return (string) $code;
    }

    /**
     * Check the code the user typed and mark them verified if correct.
     */
    public function verifyCode(string $code): bool
    {
        if ($this->verification_code === $code) {
            return tap($this)->update([
                'mobile_verified'   => true,
                'verification_code' => null,
            ]);
        }

        return false;
    }
}
