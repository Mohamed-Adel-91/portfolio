<?php

namespace App\Services;

use App\Imports\ProductsImport;
use App\Models\Product;
use App\Models\ProductImage;
use App\Traits\FileUploadTrait;
use Auth;
use Carbon\Carbon;

class ProductService
{
    use FileUploadTrait;
    public function import($file, $type)
    {
        try {
            $import = new ProductsImport($type);
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                $errors = $import->failures()->toArray();
                $flattenedErrors = array_reduce($errors, 'array_merge', []);
                return ['status' => false, 'errors' => $flattenedErrors];
            }
            return ['status' => true, 'errors' => null];
        } catch (\Exception $e) {
            return ['status' => false, 'errors' => null];
        }
    }



    public function submitProduct(array $data)
    {
        $preparedData = $this->prepareProductData($data);
        $product = new Product();
        $product = $product->fill($preparedData);
        $product->save();
        if (isset($preparedData['keys'])) {
            $this->attachKeys($product, $preparedData['keys']);
        }
        if (isset($preparedData['photos'])) {
            $this->attachPhotos($product, $preparedData['photos']);
        }
        return $product;
    }

    public function updateProduct(array $data, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return ['status' => false, 'data' => null, 'message' => __('api.data_not_found')];
        }
        if ($product->user_id != Auth::user()->id) {
            return ['status' => false, 'data' => null, 'message' => __('api.action_not_authorized')];
        }


        $preparedData = $this->prepareProductData($data, $product);
        $product->fill($preparedData);
        $product->save();
        if (isset($preparedData['keys'])) {
            $this->updateKeys($product, $preparedData['keys']);
        }

        if (isset($preparedData['photos'])) {
            $this->updatePhotos($product, $preparedData['photos']);
        }
        return ['status' => true, 'data' => $product, 'message' => __('api.data.loaded')];
    }

    protected function prepareProductData(array $data)
    {
        return [
            'company_id' => Auth::user()->company_id,
            'user_id' => Auth::user()->id,
            'type' => $data['type'],
            'system_1_id' => $data['system_1_id'],
            'system_2_id' => $data['system_2_id'] ?? null,
            'system_3_id' => $data['system_3_id'] ?? null,
            'brand_id' => $data['brand_id'],
            'description' => [
                'en' => $data['description_en'],
                'ar' => $data['description_ar'],
            ],
            'approved_by' => array_key_exists('approved_by_ids', $data) && count($data['approved_by_ids']) > 0 ? implode(',', $data['approved_by_ids']) : null,
            'unit_id' => $data['unit_id'],
            'unit_price' => $data['unit_price'],
            'expiration_date' => Carbon::parse($data['expiration_date'])->format('Y-m-d'),
            'min_qty' => $data['min_qty'],
            'min_value' => $data['unit_price'] * $data['min_qty'],
            'delivery_id' => $data['delivery_id'],
            'warranty_id' => $data['warranty_id'],
            'is_used' => array_key_exists('is_used', $data) ? $data['is_used'] : false,
            'warranty_by_ids' => implode(',', $data['warranty_by_ids']),
            'db' => $data['db'] ?? null,
            'keys' => $data['keys'] ?? null,
            'photos' => $data['photos'] ?? null,
        ];
    }

    protected function attachKeys(Product $product, array $keys)
    {
        foreach ($keys as $keyRow) {
            $product->keys()->create([
                'key_id' => $keyRow['key_id'],
                'value' => $keyRow['value']
            ]);
        }
    }

    protected function attachPhotos(Product $product, array $photos)
    {
        foreach ($photos as $photo) {
            $uploadedPhoto = $this->uploadFile([$photo], ['product-images']);
            ProductImage::create(['product_id' => $product->id, 'image' => $uploadedPhoto[0]]);
        }
    }


    public function duplicateProductById($productId)
    {
        $originalProduct = Product::find($productId);
        if (!$originalProduct) {
            return ['status' => false, 'data' => null, 'message' => __('api.data_not_found')];
        }

        if ($originalProduct->user_id != Auth::user()->id) {
            return ['status' => false, 'data' => null, 'message' => __('api.action_not_authorized')];
        }
        $duplicatedProduct = (new ProductService)->duplicateProduct($originalProduct);
        return ['status' => true, 'data' => $duplicatedProduct, 'message' => __('api.data_loaded')];
    }


    public function duplicateProduct(Product $originalProduct)
    {
        $newProduct = $originalProduct->replicate();
        $newProduct->save();
        foreach ($originalProduct->keys as $key) {
            $newProduct->keys()->create([
                'key_id' => $key->key_id,
                'value' => $key->value,
            ]);
        }
        foreach ($originalProduct->images as $image) {
            $newProduct->images()->create([
                'image' => $image->image,
            ]);
        }
        return $newProduct;
    }


    protected function updateKeys(Product $product, array $keys)
    {
        $product->keys()->delete();
        foreach ($keys as $keyRow) {
            $product->keys()->create([
                'key_id' => $keyRow['key_id'],
                'value' => $keyRow['value']
            ]);
        }
    }

    protected function updatePhotos(Product $product, array $photos)
    {
        foreach ($photos as $photo) {
            $uploadedPhoto = $this->uploadFile([$photo], ['product-images']);
            ProductImage::create(['product_id' => $product->id, 'image' => $uploadedPhoto[0]]);
        }
    }

    public function deleteProductImage($id)
    {
        $productImage = ProductImage::find($id);
        if (!$productImage) {
            return ['status' => false, 'data' => null, 'message' => __('api.data_not_found')];
        }
        $file =   'uploads/product-images/' . $productImage->image;
        if (file_exists($file)) {
            unlink($file);
        }
        $productImage->delete();
        return ['status' => true, 'data' => null, 'message' => __('api.deleted_successfully')];
    }
}
