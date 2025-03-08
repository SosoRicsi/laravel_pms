<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class NotSameAsOld implements ValidationRule
{
    private mixed $old_value;

    public function __construct(mixed $old_value)
    {
        $this->old_value = $old_value;

    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->old_value === $value) {
            $fail(':attribute.sameasold')->translate();
        }
    }
}
