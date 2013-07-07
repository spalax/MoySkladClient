<?php
namespace Zf2ClientMoysklad\Metadata\Collector;


interface CollectorInterface
{
    /**
     * @return array
     */
    public function collect();
}