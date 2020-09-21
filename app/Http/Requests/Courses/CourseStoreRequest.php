<?php

namespace App\Http\Requests\Courses;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CourseStoreRequest extends FormRequest
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

//    protected function prepareForValidation()
//    {
//        $this->merge([
//            'user_id' => Auth::user()->id,
//            'slug' => unique_slug($this->title),
//        ]);
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'category_id' => 'required',
            'topic_id' => 'required',
        ];
    }
}
