<?php

namespace Icinga\Module\Dashly\Controllers;

use dipl\Web\CompatController;

class DashletController extends CompatController
{
    /**
     * @throws \Icinga\Exception\ProgrammingError
     */
    public function dummyAction()
    {
        $this->content()->getAttributes()->set('class', 'number ok');
        $this->content()->add(13);
    }
}
