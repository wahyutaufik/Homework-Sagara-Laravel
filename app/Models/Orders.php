<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Observers\CitiesObserver as Observer;
use Illuminate\Support\Facades\Schema;

class Orders extends Resources
{
    protected $rules = array();

    protected $structures = array(
        "id" => [
            'name' => 'id',
            'default' => null,
            'label' => 'ID',
            'display' => false,
            'validation' => [
                'create' => null,
                'update' => null,
                'delete' => null,
            ],
            'primary' => true,
            'required' => true,
            'type' => 'integer',
            'validated' => false,
            'nullable' => false,
            'note' => null
        ],
        "seller_id" => [
            'name' => 'seller_id',
            'default' => null,
            'label' => 'Seller',
            'display' => true,
            'validation' => [
                'create' => 'required|integer',
                'update' => 'required|integer',
                'delete' => null,
            ],
            'primary' => false,
            'required' => true,
            'type' => 'reference',
            'validated' => true,
            'nullable' => false,
            'note' => null,
            'placeholder' => 'Seller',
            // Options reference
            'reference' => "sellers", // Select2 API endpoint => /api/v1/countries
            'relationship' => 'seller', // relationship request datatable
            'option' => [
                'value' => 'id',
                'label' => 'fullname'
            ]
        ],
        "customer_id" => [
            'name' => 'customer_id',
            'default' => null,
            'label' => 'Customer',
            'display' => true,
            'validation' => [
                'create' => 'required|integer',
                'update' => 'required|integer',
                'delete' => null,
            ],
            'primary' => false,
            'required' => true,
            'type' => 'reference',
            'validated' => true,
            'nullable' => false,
            'note' => null,
            'placeholder' => 'Customer',
            // Options reference
            'reference' => "customers", // Select2 API endpoint => /api/v1/countries
            'relationship' => 'customer', // relationship request datatable
            'option' => [
                'value' => 'id',
                'label' => 'fullname'
            ]
        ],
        "product_id" => [
            'name' => 'product_id',
            'default' => null,
            'label' => 'Product',
            'display' => true,
            'validation' => [
                'create' => 'required|integer',
                'update' => 'required|integer',
                'delete' => null,
            ],
            'primary' => false,
            'required' => true,
            'type' => 'reference',
            'validated' => true,
            'nullable' => false,
            'note' => null,
            'placeholder' => 'Product',
            // Options reference
            'reference' => "products", // Select2 API endpoint => /api/v1/countries
            'relationship' => 'product', // relationship request datatable
            'option' => [
                'value' => 'id',
                'label' => 'name'
            ]
        ],
        "description" => [
            'name' => 'description',
            'default' => null,
            'label' => 'Description',
            'display' => true,
            'validation' => [
                'create' => 'required|string',
                'update' => 'required|string',
                'delete' => null,
            ],
            'primary' => false,
            'required' => true,
            'type' => 'textarea',
            'validated' => true,
            'nullable' => false,
            'note' => null,
            'placeholder' => 'Description',
            // Options textarea
            'option' => [
                'rows' => 3,
                // 'cols' => 2
            ]
        ],
        "created_at" => [
            'name' => 'created_at',
            'default' => null,
            'label' => 'Created At',
            'display' => false,
            'validation' => [
                'create' => null,
                'update' => null,
                'delete' => null,
            ],
            'primary' => false,
            'required' => false,
            'type' => 'datetime',
            'validated' => false,
            'nullable' => false,
            'note' => null
        ],
        "updated_at" => [
            'name' => 'updated_at',
            'default' => null,
            'label' => 'Updated At',
            'display' => false,
            'validation' => [
                'create' => null,
                'update' => null,
                'delete' => null,
            ],
            'primary' => false,
            'required' => false,
            'type' => 'datetime',
            'validated' => false,
            'nullable' => false,
            'note' => null
        ],
        "deleted_at" => [
            'name' => 'deleted_at',
            'default' => null,
            'label' => 'Deleted At',
            'display' => false,
            'validation' => [
                'create' => null,
                'update' => null,
                'delete' => null,
            ],
            'primary' => false,
            'required' => false,
            'type' => 'datetime',
            'validated' => false,
            'nullable' => false,
            'note' => null
        ]
    );

    protected $forms = array(
        [
            [
                'class' => 'col-6',
                'field' => 'seller_id'
            ],
            [
                'class' => 'col-6',
                'field' => 'customer_id'
            ],
            [
                'class' => 'col-6',
                'field' => 'product_id'
            ],
            [
                'class' => 'col-6',
                'field' => 'description'
            ]
        ],
    );

    public function seller() {
        return $this->belongsTo('App\Models\Sellers', 'seller_id', 'id')->withTrashed();
    }

    public function customer() {
        return $this->belongsTo('App\Models\Customers', 'customer_id', 'id')->withTrashed();
    }

    public function product() {
        return $this->belongsTo('App\Models\Products', 'product_id', 'id')->withTrashed();
    }
}
