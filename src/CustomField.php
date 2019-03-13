<?php

namespace Trexology\Extendable;

use Illuminate\Database\Eloquent\Model;
use Trexology\Extendable\Providers\CustomFieldConfigProvider;

class CustomField extends Model
{
    // value accessor
    protected $appends = ['value'];

    // unguard all fields
    public $guarded = [];

    // disable timestamps
    public $timestamps = false;


    /**
     * Return column name for current custom field value
     *
     * @return string
     */
    public function getAttributeName()
    {
        return CustomFieldConfigProvider::fieldType($this->entity_type, $this->field_name);
    }


    /**
     * Get value for current custom field
     *
     * @return mixed
     */
    public function getValueAttribute()
    {
        $attributeName = $this->getAttributeName();
        return $this->$attributeName;
    }


    /**
     * @param $value
     * @return $this
     * @throws \Exception
     */
    public function setValueAttribute($value)
    {
        if ($value instanceof self) {
            throw new \Exception('Invalid custom attribute value');
        }

        $attributeName = $this->getAttributeName();
        $this->$attributeName = $value;
        return $this;
    }


    /**
     * Return custom field value as string
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->value;
    }

    public function printCustomField()
    {
      $fieldConfigs = CustomFieldConfigProvider::customFieldConfigs($this->entity_type);

      switch ($fieldConfigs[$this->field_name]['type']) {
          case CustomFieldType::Checkbox:
              return "<input></input>";
          case CustomFieldType::Select:
              return "<input></input>";
          case CustomFieldType::String:
              return "<input></input>";
          case CustomFieldType::Radio:
              return 'stringvalue';
          case CustomFieldType::Text:
              return 'textvalue';
          case CustomFieldType::DateTime:
              return 'datetime';
          case CustomFieldType::Boolean:
              return 'number';
          default:
              return "<input></input>";

          // TODO: handled the different UI output for different type
      }
    }
}
