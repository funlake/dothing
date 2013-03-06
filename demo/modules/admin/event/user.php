<?php
!defined('DO_ACCESS') and DIE("Go Away!");
class DOEventUser extends DOEvent
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