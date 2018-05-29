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
            'categories' => 'required',
            'description' => 'required|min:5|max:2000',
            
            'start_date' => 'required_without_all:recurrent.date.from, recurrent.date.to|date|after:yesterday',
            'start_time' => 'required_without_all:recurrent.time.from, recurrent.time.to|date_format:H:i',
            'end_date' => 'required_without_all:recurrent.date.from, recurrent.date.to|date|after:start_date',
            'end_time' => 'required_without_all:recurrent.time.from, recurrent.time.to|date_format:H:i',
            'recurrent.time.from' => 'required_without:start_time|date_format:H:i',
            'recurrent.time.to' => 'required_without:end_time|date_format:H:i',
            'recurrent.date.from' => 'required_without:start_time|date',
            'recurrent.date.to' => 'required_without:end_time|date',

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
