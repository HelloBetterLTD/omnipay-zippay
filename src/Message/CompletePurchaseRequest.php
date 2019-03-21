<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 8/15/18
 * Time: 9:58 AM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\OmnipayZipPay\Message;


use Omnipay\Common\Message\AbstractRequest;
use zipMoney\Api\Query;
use zipMoney\Request\QueryOrder;

class CompletePurchaseRequest extends AbstractRequest
{

	public function setPaymentRef($ref)
	{
		$this->parameters->set('payment_ref', $ref);
	}

	public function getData()
	{

		$data = $this->httpRequest->query->all();
		$parameters = $this->getParameters();
		$orderID = $parameters['payment_ref'];

		$query = new Query();
		$queryOrder = new QueryOrder();
		$queryOrder->id = $orderID;

		$query->request->orders[] = $queryOrder;
		$isSuccessful = false;
		try{
			$response = $query->process();
			if($response->isSuccess()){
				$array = $response->toArray();
				if(!empty($array['order_statuses'])) {
					foreach ($array['order_statuses'] as $order_status) {
						if($orderID == $order_status['id'] && $order_status['status'] == 'Captured') {
							$isSuccessful = true;
						}
					}
				}
			}

		} catch (Exception $e){
		}
		$data['order_success'] = $isSuccessful;
		return $data;
	}

	public function sendData($data)
	{
		return $this->response = new CompletePurchaseResponse($this, $data);
	}

}