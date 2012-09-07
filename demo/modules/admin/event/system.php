<?php
!defined('DO_ACCESS') and DIE("Go Away!");

class DOEventSystem extends DOEvent
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