<?php
class DOIndexEvent extends DOEvent
{
	public function onBeforeRequest($mca)
	{
		DOTemplate::SetTemplate(DO_ADMIN_TEMPLATE);
		DOTemplate::SetTemplateUriPath(DOTemplate::GetTemplate());
		parent::onBeforeRequest($mca);
	}
}