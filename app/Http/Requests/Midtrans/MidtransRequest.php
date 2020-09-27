<?php

namespace App\Http\Requests\Midtrans;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MidtransRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'name'                  => Auth::user()->name,
            'email'                 => Auth::user()->email,
            'user_id'               => Auth::id(),
            'payment_method'        => 'midtrans',
            'status'                => 'initial',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount'                => 'required|numeric',
            'currency'              => 'string|required',
            'local_transaction_id'  => 'string|required',
        ];
    }
}
