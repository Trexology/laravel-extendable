Laravel Extendable package
==========================

[![License](https://img.shields.io/github/license/trexology/laravel-extendable.svg)](https://packagist.org/packages/trexology/laravel-extendable)
[![Downloads](https://img.shields.io/packagist/dt/trexology/laravel-extendable.svg)](https://packagist.org/packages/trexology/laravel-extendable)
[![Version-stable](https://img.shields.io/packagist/v/trexology/laravel-extendable.svg)](https://packagist.org/packages/trexology/laravel-extendable)


## How to install

### Composer Install

```sh
composer require trexology/laravel-extendable
```

### Laravel Service Provider (not required for laravel version above 5.5)

Add service provider in `app/config/app.php`

```php
'providers' => [
    Trexology\Extendable\ExtendableServiceProvider::class,
];
```


Publish configs, templates and run migrations.

```php
php artisan vendor:publish --provider="Trexology\Extendable\ExtendableServiceProvider"
php artisan migrate
```

## Usage

### Add traits

Add model trait to models, where you want to use custom fields.

```php
class Article extends \Illuminate\Database\Eloquent\Model {
    use Trexology\Extendable\ModelTrait;
}
```

### Config fields

Use `app/config/custom-fields.php` to configure your fields.

```php
return [
    'App\Room' => [                                                     // model name
        'light' => [                                                    // field name
            'title' => 'Light',                                         // field title (can be used in views)
            'type' => \Trexology\Extendable\CustomFieldType::Radio,     // field type
            'options' => [                                              // possible values/labels
                0 => 'Off',
                1 => 'On'
            ],
            'default' => 1                                              // default value
        ]
    ]
];
```

### Assign/retrieve customfield values

Assign custom field values as regular values.

```php
$data = [
    'title' => 'Awesome Article!!!', // regular field
    'recomended' => 1                // custom filed     
];

$article = new Article();
$article->fill($data);
$article->save();
```

Retrieve custom field values.

```php
$article = Article::find(1);
$article->recomended->value; // 1
echo $article->recomended;   // 1
```

### Field types

|---------------------------|--------------|-----------------------|
| FieldType                 | DB DataType  | Example               |
|---------------------------|--------------|-----------------------|
| CustomFieldType::String   | VARCHAR(255) | `Lorem`               |
| CustomFieldType::Text     | TEXT         | `Lorem Ipsum...`      |
| CustomFieldType::Select   | VARCHAR(255) | `en_us`               |
| CustomFieldType::Radio    | VARCHAR(255) | `off`                 |
| CustomFieldType::Checkbox | VARCHAR(255) | `0`                   |
| CustomFieldType::DateTime | TIMESTAMP    | `2015-01-19 03:14:07` |
