<?php

declare(strict_types=1);

namespace App\Http\Requests\ShoppingItem;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ShoppingItemDestroyRequest
 *
 * @package App\Http\Requests\ShoppingItem
 */
class ShoppingItemDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     *
     * @return bool
     */
    public function authorize(Gate $gate): bool
    {
        // Pass Shopping Item route param (model binding) to ShoppingItemPolicy, to validate user authorization.
        return $gate->allows('delete', [$this->route('shopping_item')]);
    }

    /**
     * Get the validation rules that apply to the request.
     * ShoppingItemPolicy handles whether the user can create a shopping item for the shopping list.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
