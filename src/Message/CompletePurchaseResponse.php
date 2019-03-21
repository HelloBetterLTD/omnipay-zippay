<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 8/15/18
 * Time: 9:59 AM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\OmnipayZipPay\Message;


use Omnipay\Common\Message\AbstractResponse;
use zipMoney\Request\QueryOrder;

class CompletePurchaseResponse extends AbstractResponse
{
	public function isSuccessful()
	{

		$data = $this->getRequest()->getData();
		return isset($data['order_success']) && $data['order_success'] == 1;
	}

	public function getMessage()
	{
		return '';
	}

	public function getCode()
	{
		return '';
	}

	public function getTransactionReference()
	{
		return '';
	}

}