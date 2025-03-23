<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true; // Cho phép tất cả người dùng gửi request này
  }

  /**
   * Get the validation rules that apply to the request.
   */
  public function rules(): array
  {
    $rules = [
      'name' => 'required|string|max:255',
      'slug' => 'required|string|max:255|unique:categories,slug',
      'description' => 'nullable|string',
      'active' => 'boolean',
    ];

    // Nếu là cập nhật, bỏ qua slug hiện tại
    if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
      $rules['slug'] = 'required|string|max:255|unique:categories,slug,' . $this->category;
    }

    return $rules;
  }

  /**
   * Get the error messages for the defined validation rules.
   */
  public function messages(): array
  {
    return [
      'name.required' => 'Tên danh mục không được để trống',
      'name.max' => 'Tên danh mục không được vượt quá 255 ký tự',
      'slug.required' => 'Slug không được để trống',
      'slug.unique' => 'Slug đã tồn tại, vui lòng chọn slug khác',
      'slug.max' => 'Slug không được vượt quá 255 ký tự',
    ];
  }
}
