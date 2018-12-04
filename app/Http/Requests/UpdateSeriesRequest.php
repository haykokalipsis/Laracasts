<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeriesRequest extends FormRequest
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
            'title' =>'required',
            'description' => 'required',
        ];
    }

    public function uploadSeriesImage()
    {
        $uploadedImage = $this->image;
        $this->fileName = str_slug($this->title) . '.' . $uploadedImage->getClientOriginalExtension();
        $uploadedImage->storePubliclyAs('series', $this->fileName);

        return $this;
    }

    public function updateSeries($series)
    {
        if($this->hasFile('image') ) {
            $series->image_url = 'series/' . $this->uploadSeriesImage()->fileName;
        }

        $series->title = $this->title;
        $series->description = $this->description;
        $series->slug = str_slug($this->title);

        $series->save();

        session()->flash('success', 'Successfully updated series');

        return redirect()->route('series.index');
    }
}
