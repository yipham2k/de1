<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   */
  public function rules(): array
  {
    $rules = [
      'category_id' => 'required|exists:categories,id',
      'name' => 'required|string|max:255',
      'slug' => 'required|string|max:255|unique:products,slug,' . $this->product,
      'description' => 'nullable|string',
      'current_price' => 'required|numeric|min:0',
      'original_price' => 'nullable|numeric|min:0',
      'image' => 'nullable|string|max:255',
      'active' => 'boolean',
      'stock' => 'required|integer|min:0',
    ];

    // Nếu là cập nhật, bỏ qua slug hiện tại
    if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
      $rules['slug'] = 'required|string|max:255|unique:products,slug,' . $this->product;
    }

    return $rules;
  }

  /**
   * Get the error messages for the defined validation rules.
   */
  public function messages(): array
  {
    return [
      'category_id.required' => 'Vui lòng chọn danh mục',
      'category_id.exists' => 'Danh mục không hợp lệ',
      'name.required' => 'Tên sản phẩm không được để trống',
      'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự',
      'slug.required' => 'Slug không được để trống',
      'slug.unique' => 'Slug đã tồn tại, vui lòng chọn slug khác',
      'current_price.required' => 'Giá hiện tại không được để trống',
      'current_price.numeric' => 'Giá hiện tại phải là số',
      'current_price.min' => 'Giá hiện tại không được âm',
      'original_price.numeric' => 'Giá gốc phải là số',
      'original_price.min' => 'Giá gốc không được âm',
      'stock.required' => 'Số lượng tồn kho không được để trống',
      'stock.integer' => 'Số lượng tồn kho phải là số nguyên',
      'stock.min' => 'Số lượng tồn kho không được âm',
    ];
  }
}
