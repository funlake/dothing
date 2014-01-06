<?php
!defined('DO_ACCESS') and DIE("Go Away!");
class DOEventUser extends DOEvent
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