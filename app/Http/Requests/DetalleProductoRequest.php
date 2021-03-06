<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetalleProductoRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "id_producto" => "required|numeric|min:1",
            "cantidad" => "required|numeric|min:1",
            "valor_unitario" => "required|numeric|min:1",
            "descripcion" => "required|string",
        ];
    }
}
