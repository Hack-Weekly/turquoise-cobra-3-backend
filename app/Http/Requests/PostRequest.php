<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (auth()) return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "title" => "required|string",
            "content" => "required",
            "meta_data" => "array|min:1",
            "tags" => "array|min:1",
        ];
    }
    public function messages(): array
    {
        return [
            "title.required" => "Oh come on!! What's a blog post without a title, eh?",
            "title.string" => "Hmmm.. You seem to have added more than just letters, number and characters in your title🤔",
            "content.required" => "Such Empty... Much Wow!?",
            "meta_data.min" => "At least add 1 Meta Tag for your blog",
            "tags.min" => "Tags help people find Blogs relater to their interest... I urge you to add at least 1 tag!",
        ];
    }
}
