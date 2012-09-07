<?php
!defined('DO_ACCESS') AND DIE('GO AWAY!');

class DOEventRole extends DOEvent
{
	public function onBeforeRequest($mca)
	{
		parent::onBeforeRequest($mca);
	}
	public function onAfterRequest($mca,$content)
	{
		parent::onAfterRequest($mca,$content);
	}
}