<?php

namespace App\Http\Requests\GDCS;

use App\Http\Requests\GDCS\Game\Request;
use App\Models\GDCS\Account;
use Illuminate\Validation\Rule;

class ChallengeFetchRequest extends Request
{
    public function authorize(): bool
    {
        return $this->auth() && ! empty($this->user);
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
            'accountID' => [
                'sometimes',
                'exclude_if:accountID,0',
                'required',
                'integer',
                Rule::exists(Account::class, 'id'),
            ],
            'gjp' => [
                'required_with:accountID',
                'nullable',
                'string',
            ],
            'uuid' => [
                'required_without:accountID',
                'integer',
            ],
            'udid' => [
                'required_with:uuid',
                'string',
            ],
            'chk' => [
                'required',
                'string',
            ],
            'secret' => [
                'required',
                'string',
                'in:Wmfd2893gb7',
            ],
        ];
    }
}
