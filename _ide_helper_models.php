<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Admin
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string|null $profile_picture
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereProfilePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUpdatedAt($value)
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Brand
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\System> $systems
 * @property-read int|null $systems_count
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand withoutTrashed()
 */
	class Brand extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BusinessInfo
 *
 * @property-read \App\Models\RegisterDropdown|null $approvedBy
 * @property-read \App\Models\RegisterDropdown|null $classification
 * @property-read \App\Models\RegisterDropdown|null $companySize
 * @property-read mixed $cr_sce_id_path
 * @property-read mixed $logo_path
 * @property-read \App\Models\RegisterDropdown|null $roleInCompany
 * @property-read \App\Models\RegisterDropdown|null $segment
 * @property-read \App\Models\RegisterDropdown|null $target
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessInfo whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessInfo whereLocales(string $column, array $locales)
 */
	class BusinessInfo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\City
 *
 * @property int $id
 * @property int $country_id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Country $country
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereUpdatedAt($value)
 */
	class City extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Company
 *
 * @property int $id
 * @property int|null $admin_id
 * @property array|null $company_name
 * @property string|null $whatsapp
 * @property int|null $company_size_id
 * @property string|null $website
 * @property string|null $land_line
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $target_id
 * @property string|null $logo
 * @property string|null $cr_sce_id
 * @property int|null $speciality_id
 * @property string|null $classification_ids
 * @property string|null $approved_by_ids
 * @property string|null $segment_ids
 * @property int|null $country_id
 * @property int|null $city_id
 * @property int $is_approved
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $admin
 * @property-read \App\Models\City|null $city
 * @property-read \App\Models\RegisterDropdown|null $companySize
 * @property-read \App\Models\Country|null $country
 * @property-read mixed $approved_by
 * @property-read mixed $classifications
 * @property-read mixed $cr_sce_id_path
 * @property-read mixed $logo_path
 * @property-read mixed $segments
 * @property-read mixed $speciality_type
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Speciality|null $speciality
 * @property-read \App\Models\RegisterDropdown|null $target
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereApprovedByIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereClassificationIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCompanySizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCrSceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereLandLine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereSegmentIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereSpecialityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereTargetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereWhatsapp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Company withoutTrashed()
 */
	class Company extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ConsultationService
 *
 * @property int $id
 * @property int $service_id
 * @property int $consultation_service_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RegisterDropdown $service
 * @method static \Illuminate\Database\Eloquent\Builder|ConsultationService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsultationService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsultationService query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConsultationService whereConsultationServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsultationService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsultationService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsultationService whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ConsultationService whereUpdatedAt($value)
 */
	class ConsultationService extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Country
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\City> $cities
 * @property-read int|null $cities_count
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 */
	class Country extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Key
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\System> $systems
 * @property-read int|null $systems_count
 * @method static \Illuminate\Database\Eloquent\Builder|Key newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Key newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Key onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Key query()
 * @method static \Illuminate\Database\Eloquent\Builder|Key whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Key whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Key whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Key whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Key whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Key whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Key whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Key withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Key withoutTrashed()
 */
	class Key extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Otp
 *
 * @property int $id
 * @property string $email
 * @property string $otp
 * @property string|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Otp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Otp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Otp query()
 * @method static \Illuminate\Database\Eloquent\Builder|Otp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Otp whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Otp whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Otp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Otp whereOtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Otp whereUpdatedAt($value)
 */
	class Otp extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property int|null $company_id
 * @property int $user_id
 * @property int|null $system_1_id
 * @property int|null $system_2_id
 * @property int|null $system_3_id
 * @property int|null $brand_id
 * @property int $type
 * @property array $description
 * @property string|null $approved_by
 * @property int $is_used
 * @property int $unit_id
 * @property int $unit_price
 * @property string $expiration_date
 * @property int $min_qty
 * @property int $min_value
 * @property string|null $db
 * @property int $delivery_id
 * @property int $warranty_id
 * @property string $warranty_by_ids
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $is_approved
 * @property-read \App\Models\RegisterDropdown|null $approvedBy
 * @property-read \App\Models\Brand|null $brand
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\RegisterDropdown|null $delivery
 * @property-read mixed $approved_by_list
 * @property-read mixed $warranty_by
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductImage> $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductKey> $keys
 * @property-read int|null $keys_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Product> $products
 * @property-read int|null $products_count
 * @property-read \App\Models\System|null $system1
 * @property-read \App\Models\System|null $system2
 * @property-read \App\Models\System|null $system3
 * @property-read \App\Models\RegisterDropdown|null $unit
 * @property-read \App\Models\User $user
 * @property-read \App\Models\RegisterDropdown|null $warranty
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeliveryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMinQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMinValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSystem1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSystem2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSystem3Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereWarrantyByIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereWarrantyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product withoutTrashed()
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductImage
 *
 * @property int $id
 * @property int $product_id
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $image_path
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage withoutTrashed()
 */
	class ProductImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductKey
 *
 * @property int $id
 * @property int $product_id
 * @property int $key_id
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Key $key
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|ProductKey newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductKey newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductKey onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductKey query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductKey whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductKey whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductKey whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductKey whereKeyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductKey whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductKey whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductKey whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductKey withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductKey withoutTrashed()
 */
	class ProductKey extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RegisterDropdown
 *
 * @property int $id
 * @property array $title
 * @property int $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $is_approved
 * @method static \Database\Factories\RegisterDropdownFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterDropdown newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterDropdown newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterDropdown onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterDropdown query()
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterDropdown whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterDropdown whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterDropdown whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterDropdown whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterDropdown whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterDropdown whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterDropdown whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterDropdown whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterDropdown whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterDropdown withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterDropdown withoutTrashed()
 */
	class RegisterDropdown extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RegistrationType
 *
 * @property int $id
 * @property array $name
 * @property array $description
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $image_path
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Speciality> $specialities
 * @property-read int|null $specialities_count
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationType query()
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationType whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationType whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationType whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegistrationType whereUpdatedAt($value)
 */
	class RegistrationType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Service
 *
 * @property int $id
 * @property int $type
 * @property int $system_id
 * @property string $status
 * @property int $user_id
 * @property array|null $description
 * @property int|null $target_project_size
 * @property string|null $profile_file
 * @property string|null $equipment_for_rent
 * @property string|null $price
 * @property int|null $price_per
 * @property string|null $year_of_manufacture
 * @property string|null $brand
 * @property int|null $visible_for_how_many
 * @property int|null $country_of_origin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServiceApprovedBy> $approvedBy
 * @property-read int|null $approved_by_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServiceCity> $cities
 * @property-read int|null $cities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ConsultationService> $consultationServices
 * @property-read int|null $consultation_services_count
 * @property-read \App\Models\RegisterDropdown|null $countryOfOrigin
 * @property-read mixed $is_approved
 * @property-read mixed $profile_file_path
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServicePhoto> $photos
 * @property-read int|null $photos_count
 * @property-read \App\Models\RegisterDropdown|null $pricePer
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServiceSegment> $segments
 * @property-read int|null $segments_count
 * @property-read \App\Models\System $system
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServiceSystem> $systems
 * @property-read int|null $systems_count
 * @property-read \App\Models\RegisterDropdown|null $targetProject
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServiceType> $typeOfServices
 * @property-read int|null $type_of_services_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Service consultation()
 * @method static \Illuminate\Database\Eloquent\Builder|Service filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCountryOfOrigin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereEquipmentForRent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Service wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service wherePricePer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereProfileFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereSystemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereTargetProjectSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereVisibleForHowMany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereYearOfManufacture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Service withoutTrashed()
 */
	class Service extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceApprovedBy
 *
 * @property int $id
 * @property int $service_id
 * @property int $approved_by_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RegisterDropdown $approvedBy
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceApprovedBy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceApprovedBy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceApprovedBy query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceApprovedBy whereApprovedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceApprovedBy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceApprovedBy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceApprovedBy whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceApprovedBy whereUpdatedAt($value)
 */
	class ServiceApprovedBy extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceCity
 *
 * @property int $id
 * @property int $city_id
 * @property int $service_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\City $city
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCity query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCity whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCity whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCity whereUpdatedAt($value)
 */
	class ServiceCity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServicePhoto
 *
 * @property int $id
 * @property int $service_id
 * @property string $photo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $photo_path
 * @method static \Illuminate\Database\Eloquent\Builder|ServicePhoto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServicePhoto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServicePhoto query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServicePhoto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServicePhoto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServicePhoto wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServicePhoto whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServicePhoto whereUpdatedAt($value)
 */
	class ServicePhoto extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceSegment
 *
 * @property int $id
 * @property int $segment_id
 * @property int $service_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RegisterDropdown $segment
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSegment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSegment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSegment query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSegment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSegment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSegment whereSegmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSegment whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSegment whereUpdatedAt($value)
 */
	class ServiceSegment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceSystem
 *
 * @property int $id
 * @property int|null $system_id
 * @property int|null $service_id
 * @property string $system_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Service|null $service
 * @property-read \App\Models\RegisterDropdown|null $system
 * @property-read \App\Models\System|null $systemService
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSystem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSystem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSystem query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSystem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSystem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSystem whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSystem whereSystemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSystem whereSystemNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSystem whereUpdatedAt($value)
 */
	class ServiceSystem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceType
 *
 * @property int $id
 * @property int $service_id
 * @property int $type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RegisterDropdown $type
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceType whereUpdatedAt($value)
 */
	class ServiceType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Setting
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Speciality
 *
 * @property int $id
 * @property int $user_type
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RegistrationType> $registrationTypes
 * @property-read int|null $registration_types_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Speciality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Speciality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Speciality query()
 * @method static \Illuminate\Database\Eloquent\Builder|Speciality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speciality whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speciality whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Speciality whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Speciality whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speciality whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Speciality whereUserType($value)
 */
	class Speciality extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\System
 *
 * @property int $id
 * @property array $title
 * @property int|null $parent_system_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $ref_no
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Brand> $brands
 * @property-read int|null $brands_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, System> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, System> $descendants
 * @property-read int|null $descendants_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Key> $keys
 * @property-read int|null $keys_count
 * @property-read System|null $parent
 * @method static \Database\Factories\SystemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|System newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|System newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|System onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|System query()
 * @method static \Illuminate\Database\Eloquent\Builder|System whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereParentSystemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereRefNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|System withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|System withoutTrashed()
 */
	class System extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SystemBrand
 *
 * @property int $id
 * @property int $system_id
 * @property int|null $brand_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Brand|null $brand
 * @property-read \App\Models\System $system
 * @method static \Database\Factories\SystemBrandFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|SystemBrand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemBrand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemBrand query()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemBrand whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemBrand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemBrand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemBrand whereSystemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemBrand whereUpdatedAt($value)
 */
	class SystemBrand extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SystemKey
 *
 * @property int $id
 * @property int $system_id
 * @property int|null $key_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Key|null $key
 * @property-read \App\Models\System $system
 * @method static \Database\Factories\SystemKeyFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|SystemKey newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemKey newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemKey query()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemKey whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemKey whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemKey whereKeyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemKey whereSystemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemKey whereUpdatedAt($value)
 */
	class SystemKey extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property int $speciality_id
 * @property string $full_name
 * @property string $phone
 * @property string $email
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $email_verified_at
 * @property int $current_step
 * @property int $account_status
 * @property string|null $whatsapp
 * @property string|null $short_brief
 * @property int $issue_to_po
 * @property string|null $bank_details
 * @property string|null $logo
 * @property string|null $cr_sce_id
 * @property int|null $country_id
 * @property int|null $city_id
 * @property int|null $company_id
 * @property int $is_admin
 * @property string|null $segment_ids
 * @property int|null $role_in_company_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\City|null $city
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\Country|null $country
 * @property-read mixed $cr_sce_id_path
 * @property-read mixed $is_verified
 * @property-read mixed $logo_path
 * @property-read mixed $segments
 * @property-read mixed $speciality_type
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\RegisterDropdown|null $roleInCompany
 * @property-read \App\Models\Speciality|null $speciality
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserSystem> $userSystems
 * @property-read int|null $user_systems_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAccountStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBankDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCrSceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentStep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIssueToPo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleInCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSegmentIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereShortBrief($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSpecialityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWhatsapp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserSystem
 *
 * @property int $id
 * @property int $user_id
 * @property int $main_system_id
 * @property int|null $system1_id
 * @property int|null $system2_id
 * @property int|null $system3_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\System|null $mainSystem
 * @property-read \App\Models\System|null $system1
 * @property-read \App\Models\System|null $system2
 * @property-read \App\Models\System|null $system3
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserSystem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSystem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSystem query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSystem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSystem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSystem whereMainSystemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSystem whereSystem1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSystem whereSystem2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSystem whereSystem3Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSystem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSystem whereUserId($value)
 */
	class UserSystem extends \Eloquent {}
}

