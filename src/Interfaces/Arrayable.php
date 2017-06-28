<?php

/**
 * Arrayable.php
 * Date: 28.06.2017
 * Time: 11:14
 * Author: Maksim Klimenko
 * Email: mavsan@gmail.com
 */

namespace AmoCRM\Interfaces;

interface Arrayable
{
    /**
     * @return array
     */
    public function toArray();
}