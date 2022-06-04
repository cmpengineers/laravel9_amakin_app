<?php

namespace App\Http\Requests;

use App\Models\HomeSlider;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHomeSliderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('home_slider_edit');
    }

    public function rules()
    {
        return [
            'home_sliders' => [
                'array',
            ],
        ];
    }
}
