Laravel Extendable package
==========================

[![License](https://img.shields.io/github/license/trexology/extendable.svg)](https://packagist.org/packages/trexology/extendable)
[![Downloads](https://img.shields.io/packagist/dt/trexology/extendable.svg)](https://packagist.org/packages/trexology/extendable)
[![Version-stable](https://img.shields.io/packagist/v/trexology/extendable.svg)](https://packagist.org/packages/trexology/extendable)


## How to install

### Composer Install

```sh
composer require trexology/extendable
```

### Laravel Service Provider (not required for laravel version above 5.5)

Add service provider in `app/config/app.php`

```php
'providers' => [
    Trexology\Extendable\Providers\ExtendableServiceProvider::class,
];
```


Publish configs, templates and run migrations.

```php
php artisan vendor:publish --provider="Trexology\Extendable\Providers\ExtendableServiceProvider"
php artisan migrate
```

## Usage

### Add traits

Add model trait to models, where you want to use custom fields.

```php
use Trexology\Extendable\Traits\Extendable;
class Article extends \Illuminate\Database\Eloquent\Model {
    use Extendable;
}
```

### Config fields

Use `app/config/custom-fields.php` to configure your fields.

```php
return [
    'App\User' => [                                                     // model name
        'gender' => [                                                    // field name
            'title' => 'Gender',                                         // field title (can be used in views)
            'type' => \Trexology\Extendable\CustomFieldType::Radio,     // field type
            'options' => [                                              // possible values/labels
                'male' => 'Male',
                'female' => 'Female'
            ],
            'default' => 'male'                                              // default value
        ]
    ]
];
```

### Assign/retrieve customfield values

Assign custom field values as regular values.

```php
$data = [
    'title' => 'Awesome Article!!!', // regular field
    'gender' => 'male'               // custom filed     
];

$article = new Article();
$article->fill($data);
$article->save();
```

Retrieve custom field values.

```php
$article = Article::find(1);
$article->gender->value; // 1
echo $article->gender;   // 1

$article->customFields; // return collection of custom fields
```

### Field types

| FieldType                 | DB DataType  | Example               |
|---------------------------|--------------|-----------------------|
| CustomFieldType::String   | VARCHAR(255) | `Lorem`               |
| CustomFieldType::Text     | TEXT         | `Lorem Ipsum...`      |
| CustomFieldType::Select   | VARCHAR(255) | `en_us`               |
| CustomFieldType::Radio    | VARCHAR(255) | `off`                 |
| CustomFieldType::Checkbox | VARCHAR(255) | `0`                   |
| CustomFieldType::DateTime | TIMESTAMP    | `2015-01-19 03:14:07` |
