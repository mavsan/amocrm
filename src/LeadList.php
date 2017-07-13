<?php
/**
 * LeadList.php
 * Date: 13.07.2017
 * Time: 9:47
 * Author: Maksim Klimenko
 * Email: mavsan@gmail.com
 */

namespace AmoCRM;


class LeadList
{
    protected $_founded = [];

    /**
     * Найти сделки по строке запроса. Возвращает:
     * - boolean false, если ничего не найдено;
     * - массив объектов типа Lead, если что-то найдено.
     *
     * @see https://developers.amocrm.ru/rest_api/leads_list.php
     *
     * @param \AmoCRM\Handler $handler
     * @param string          $query
     *
     * @return array|false
     */
    public function getByQuery(Handler $handler, $query)
    {
        $handler->request(new Request(Request::GET, ['query' => $query],
            ['leads', 'list']));

        $this->analyzeSearchResult($handler);

        return $this->_founded;
    }

    /**
     * Анализ ответа
     *
     * @param \AmoCRM\Handler $handler
     */
    protected function analyzeSearchResult(Handler $handler)
    {
        if ($handler->result === false) {
            $this->_founded = false;

            return;
        }

        $result = $handler->result;

        $handler->result = $result;

        foreach ($handler->result->leads as $lead) {
            $this->_founded[] = new Lead($lead);
        }
    }

    /**
     * Найти сделку по ID сделки. Возвращает:
     * - boolean false, если ничего не найдено;
     * - массив объектов типа Lead, если что-то найдено.
     *
     * @param \AmoCRM\Handler $handler
     * @param string          $id
     *
     * @return array|false
     */
    public function getByID(Handler $handler, $id)
    {
        $handler->request(new Request(Request::GET, ['id' => $id],
            ['leads', 'list']));

        $this->analyzeSearchResult($handler);

        return $this->_founded;
    }
}