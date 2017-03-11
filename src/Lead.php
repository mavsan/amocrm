<?php
/**
 * Управление лидами
 */

namespace AmoCRM;

class Lead extends Entity
{
    /** @var  string наименование сделки */
    public $name;
    /** @var  int ИД ответственного пользователя */
    public $responsible_user_id;
    /** @var  string теги */
    public $tags;
    /** @var  int ИД статуса сделки */
    public $status_id;
    /** @var  number бюджет сделки */
    public $price;
    /** @var array дополнительные поля сделки */
    public $custom_fields;
    /** @var array теги в виде массива */
    private $tags_array;
    
    public function __construct()
    {
        $this->key_name = 'leads';
        $this->url_name = $this->key_name;
        $this->custom_fields = [];
        $this->tags_array = [];
    }
    
    /**
     * Наименование сделки
     *
     * @param string $value
     *
     * @return $this
     */
    public function setName($value)
    {
        $this->name = $value;
        
        return $this;
    }
    
    /**
     * ИД ответственного пользователя
     *
     * @param int $value
     *
     * @return $this
     */
    public function setResponsibleUserId($value)
    {
        $this->responsible_user_id = $value;
        
        return $this;
    }
    
    /**
     * ИД статуса сделки
     *
     * @param int $value
     *
     * @return $this
     */
    public function setStatusId($value)
    {
        $this->status_id = $value;
        
        return $this;
    }
    
    /**
     * Бюджет сделки
     *
     * @param $value
     *
     * @return $this
     */
    public function setPrice($value)
    {
        $this->price = $value;
        
        return $this;
    }
    
    /**
     * Теги
     *
     * @param string|array $value
     *
     * @return $this
     */
    public function setTags($value)
    {
        if (!is_array($value)) {
            $value = [$value];
        }
        
        $this->tags_array = array_merge($this->tags_array, $value);
        $this->tags = implode(',', $this->tags_array);
        
        return $this;
    }
    
    /**
     * Установка дополнительных полей сделки
     *
     * @param int         $customFieldID ИД дополнительного поля
     * @param string      $value         значение дополнительного поля
     * @param bool|string $enum          ENUM этого поля
     *
     * @return $this
     */
    public function setCustomField($customFieldID, $value, $enum = false)
    {
        $field = [
            'id'     => $customFieldID,
            'values' => [],
        ];
        
        $field_value = [];
        $field_value['value'] = $value;
        
        if ($enum) {
            $field_value['enum'] = $enum;
        }
        
        $field['values'][] = $field_value;
        
        $this->custom_fields[] = $field;
        
        return $this;
    }
}
