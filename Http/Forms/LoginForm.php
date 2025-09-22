<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
    protected array $errors = [];

    public function __construct(public array $attributes)
    {
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please enter a valid email address';
        }

        if (!Validator::string($attributes['password'], 7, 255)) {
            $this->errors['password'] = 'Please provide a password at least 7 characters long';
        }
    }

    /**
     * @throws ValidationException
     */
    public static function validate($attributes): static
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    /**
     * @throws ValidationException
     */
    public function throw(): void
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function failed(): bool
    {
        return count($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function error($key, $message): self
    {
        $this->errors[$key] = $message;

        return $this;
    }
}