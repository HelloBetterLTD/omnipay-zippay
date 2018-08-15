<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 8/15/18
 * Time: 9:58 AM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\OmnipayZipPay\Messages;


use Omnipay\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
{

	public function getData()
	{
		
	}

	public function sendData($data)
	{
		return $this->response = new PurchaseResponse($this, $data);
	}

}