<?php

namespace Icinga\Module\Dashly\Controllers;

use dipl\Html\Html;
use dipl\Web\CompatController;
use dipl\Web\Url;

class DashboardController extends CompatController
{
    /**
     * @throws \Icinga\Exception\IcingaException
     * @throws \Icinga\Exception\ProgrammingError
     */
    public function indexAction()
    {
        if ($this->params->get('showFullscreen')) {
            $this->addSingleTab('Dashboard');
        }
        // $board = Html::tag('div', ['class' => 'gridster']);
        // $this->content()->add($board);
        $board = $this->content();
        $board->getAttributes()->set('class', 'gridster');

        $board->add($this->dashlet('monitoring/list/hosts', [
            'host_problem' => 1,
            'sort' => 'host_severity',
            'view' => 'compact',
        ], 1, 1)->prepend($this->title('Host Problems')));
        $board->add($this->dashlet('director/hosts', [
            'view' => 'compact',
        ], 1, 3));
        $board->add($this->dashlet('monitoring/list/hosts', [
            'sort' => 'host_severity',
            'view' => 'compact',
        ], 2, 3));
        $board->add($this->dashlet('dashly/dashlet/dummy', [
        ], 2, 5));
    }

    protected function title($title)
    {
        return Html::tag('h1', null, $title);
    }

    protected function dashlet($url, $params, $row, $col)
    {
        $container = Html::tag('div', [
            'class' => 'container',
            'data-icinga-url' => Url::fromPath($url, $params)->getAbsoluteUrl(),
        ], '...');
        return Html::tag('div', [
            'class' => 'gridster-dashlet',
            'data-row' => $row,
            'data-col' => $col,
            'data-sizex' => 2,
            'data-sizey' => 2,
        ], $container);
    }
}
