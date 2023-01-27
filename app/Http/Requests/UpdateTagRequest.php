<?php


namespace app\Http\Requests;

use App\Models\Posts\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTagRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title'           => [
                'string',
                'required',
                'unique:post_tag,title,' . request()->route('tag')->id,
                'max:191'
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