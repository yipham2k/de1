<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductImageRequest extends FormRequest
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
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'product_id' => 'required|exists:products,id',
      'image_path' => 'required|string|max:255',
      'is_main' => 'boolean',
      'display_order' => 'integer|min:0',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   */
  public function messages(): array
  {
    return [
      'product_id.required' => 'Vui lòng chọn sản phẩm',
      'product_id.exists' => 'Sản phẩm không hợp lệ',
      'image_path.required' => 'Đường dẫn hình ảnh không được để trống',
      'image_path.max' => 'Đường dẫn hình ảnh không được vượt quá 255 ký tự',
      'display_order.integer' => 'Thứ tự hiển thị phải là số nguyên',
      'display_order.min' => 'Thứ tự hiển thị không được âm',
    ];
  }
}
