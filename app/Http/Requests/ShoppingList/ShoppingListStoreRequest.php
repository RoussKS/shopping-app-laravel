<?php

declare(strict_types=1);

namespace App\Http\Requests\ShoppingList;

use App\Models\ShoppingList;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ShoppingListStoreRequest
 *
 * @package App\Http\Requests\ShoppingList
 */
class ShoppingListStoreRequest extends FormRequest
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
        return $gate->allows('create', [ShoppingList::class]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Only validation required is handled by the ShoppingListPolicy, authenticated user without Shopping List.
        ];
    }
}
