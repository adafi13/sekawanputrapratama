<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'contact_person',
        'email',
        'phone',
        'address',
        'website',
        'industry',
        'tax_id',
        'notes',
    ];

    /**
     * Get all leads for this customer.
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    /**
     * Get all projects for this customer.
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get all quotations for this customer.
     */
    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }

    /**
     * Get all invoices for this customer through projects.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class)->through('projects');
    }

    /**
     * Get customer display name.
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->company_name;
    }

    /**
     * Get total revenue from this customer.
     */
    public function getTotalRevenueAttribute(): float
    {
        return $this->projects()
            ->with('invoices')
            ->get()
            ->flatMap->invoices
            ->where('status', 'paid')
            ->sum('amount');
    }

    /**
     * Get outstanding invoices amount.
     */
    public function getOutstandingAmountAttribute(): float
    {
        return $this->projects()
            ->with('invoices')
            ->get()
            ->flatMap->invoices
            ->whereIn('status', ['pending', 'sent', 'overdue'])
            ->sum('amount');
    }
}
