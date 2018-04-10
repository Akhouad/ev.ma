<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class EditEvent extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();    
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|min:5',
            'description' => 'required|min:5|max:255',
            'start_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_date' => 'required|date|after:start_date',
            'end_time' => 'required|date_format:H:i',
            'type_id' => 'required|exists:types,id',
            'access_type' => 'required',
            'tickets_url' => 'nullable|url',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'phone' => 'nullable|numeric|size:11',
            'cover_original' => 'nullable|image|max:1000000',
        ];
    }
}
