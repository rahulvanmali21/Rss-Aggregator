<?php

namespace App\Http\Requests;

use App\Rules\RssUrl;
use Illuminate\Foundation\Http\FormRequest;

class StoreRssFeedRequest extends FormRequest
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
            "rss_url"=> ["required","max:255",new RssUrl]
        ];
    }
}
