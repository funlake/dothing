<?php
namespace Application\Modules\Admin\Event;
!defined('DO_ACCESS') and DIE("Go Away!");
class User extends \Dothing\Lib\Event
{
	public function onBeforeRequest($params = array())
	{
		list($mca) = $params;
		parent::onBeforeRequest($mca);
	}
	public function onAfterRequest($params = array())
	{
		list($mca,$content) = $params;
		parent::onAfterRequest($mca,$content);
	}
}