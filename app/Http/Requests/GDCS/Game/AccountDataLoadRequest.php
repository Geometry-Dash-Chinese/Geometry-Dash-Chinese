<?php

namespace App\Http\Requests\GDCS\Game;

use App\Models\GDCS\Account;
use Illuminate\Validation\Rule;

class AccountDataLoadRequest extends Request
{
    public function authorize(): bool
    {
        return $this->auth() && !empty($this->account);
    }

    public function rules(): array
    {
        return [
            'gameVersion' => [
                'required',
                'integer',
            ],
            'binaryVersion' => [
                'required',
                'integer',
            ],
            'gdw' => [
                'required',
                'boolean',
            ],
            'userName' => [
                'required',
                'string',
                Rule::exists(Account::class, 'name'),
            ],
            'password' => [
                'required',
                'string',
            ],
            'secret' => [
                'required',
                'string',
                'in:Wmfv3899gc9',
            ],
        ];
    }
}