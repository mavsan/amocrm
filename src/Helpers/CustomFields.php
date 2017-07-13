<?php
/**
 * CustomFields.php
 * Date: 13.07.2017
 * Time: 10:19
 * Author: Maksim Klimenko
 * Email: mavsan@gmail.com
 */

namespace AmoCRM\Helpers;


use AmoCRM\CustomField;

trait CustomFields
{
    /** @var array дополнительные поля сделки */
    public $custom_fields = [];

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
        $cf = new CustomField($customFieldID);
        $presentID = -1;

        /** @var CustomField $custom_field */
        foreach ((array)$this->custom_fields as $id => $custom_field) {
            if ($custom_field->getId() == $customFieldID) {
                $cf = $custom_field;
                $presentID = $id;
                break;
            }
        }

        $cf->setValue($value, $enum);

        $presentID > -1
            ? $this->custom_fields[$presentID] = $cf
            : $this->custom_fields[] = $cf;

        return $this;
    }

    /**
     * Создание класса из данных найденного контакта, дополнительные поля
     *
     * @param \stdClass $searchResult
     */
    protected function fillDataFromSearchResultCustomFields(
        \stdClass $searchResult
    ) {
        if (property_exists($searchResult, 'custom_fields')) {
            foreach ((array)$searchResult->custom_fields as $custom_field) {
                $cf = new CustomField($custom_field->id);
                $cf->setValues($custom_field->values);

                $this->custom_fields[] = $cf;
            }
        }
    }
}