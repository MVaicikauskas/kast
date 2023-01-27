<?php


namespace app\Http\Requests;

use App\Models\Posts\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTagRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title'           => [
                'string',
                'required',
                'unique:post_tag',
                'max:191'
            ],
            'slug'           => [
                'string',
                'required',
                'unique:post_tag',
            ],
            'seo_title'       => [
                'string',
                'max:75',
                'nullable',
            ],
            'seo_description' => [
                'string',
                'max:320',
                'nullable',
            ],
            'comments'        => [
                'string',
                'nullable',
                'max:191',
            ],
        ];
    }
}