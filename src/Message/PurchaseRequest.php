<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 8/15/18
 * Time: 9:58 AM
 * To change this template use File | Settings | File Templates.
 */

namespace SilverStripers\OmnipayZipPay\Message;


use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest;
use zipMoney\Api\ChargesApi;
use zipMoney\Model\CreateChargeRequest;
use zipMoney\Model\CreateCheckoutRequest;

class PurchaseRequest extends AbstractRequest
{

	public function getOrderId()
	{
		$orderID = $this->parameters->get('order_id');
		return $orderID ? $orderID : $this->getTransactionId();
	}

	public function setCartURL($url)
	{
		return $this->setParameter('cart_url', $url);
	}

	public function getCartURL()
	{
		return $this->getParameter('cart_url');
	}

	public function setCity($city)
	{
		return $this->setParameter('city', $city);
	}

	public function getCity()
	{
		return $this->getParameter('city');
	}

	public function setState($state)
	{
		return $this->setParameter('state', $state);
	}

	public function getState()
	{
		return $this->getParameter('state');
	}

	public function setPostalCode($postalCode)
	{
		return $this->setParameter('postal_code', $postalCode);
	}

	public function getPostalCode()
	{
		return $this->getParameter('postal_code');
	}

	public function setCountry($country)
	{
		return $this->setParameter('country', $country);
	}

	public function getCountry()
	{
		return $this->getParameter('country');
	}

	public function getData()
	{
		return array(
			'currency_code' => $this->getCurrency(),
			'order_id' => $this->getOrderId(),
			'cart_url' => $this->getCartURL(),
			'success_url' => $this->getReturnUrl(),
			'cancel_url' => $this->getCancelUrl(),
			'error_url' => $this->getNotifyUrl(),
			'decline_url' => $this->getNotifyUrl(),
			'total' => $this->getAmount(),
			'txn_id' => $this->getTransactionId(),
			'city' => $this->getCity(),
			'state' => $this->getState(),
			'postal_code' => $this->getPostalCode(),
			'country' => $this->getCountry()
		);
	}

	public function sendData($data)
	{
		$api = new ChargesApi();

		$body = new CreateChargeRequest([
			'authority' => [
				'type' => 'account_token',
				'value' => '52360cd6-cd63-4a4e-98f3-d41e3913dd4b'
			],
			'reference' => $data['txn_id'],
			'amount' => $data['total'],
			'currency' => $data['currency_code'],
			'capture' => false,
			'order' => [
				'reference' => $data['order_id'],
				'shipping' => [
					'address' => [
						'city' => $data['city'],
						'state' => $data['state'],
						'postal_code' => $data['postal_code'],
						'country' => $data['country']
					]
				],
				'items' => [
					'name' => $data['items_name'],
					'amount' => $data['total'],
					'type' => 'sku'
				]
			]
		]);
		$idempotency_key = md5($data['order_id']);

		try {
			$result = $api->chargesCreate($body, $idempotency_key);
			print_r($result);
			die();
		} catch (\Exception $e) {
			echo $e->getMessage();
			die();
			$exception = new InvalidRequestException('TEST TEST' . $e->getMessage());
			throw $exception;
		}



		/*
		$checkout = new Checkout();
		$checkout->request->charge = false;
		$checkout->request->currency_code = $data['currency_code'];
		$checkout->request->txn_id = false;
		$checkout->request->order_id =  $data['order_id'];
		$checkout->request->in_store = false;


		$checkout->request->cart_url =  $data['cart_url'];
		$checkout->request->success_url =  $data['success_url'];
		$checkout->request->cancel_url =  $data['cancel_url'];
		$checkout->request->error_url =  $data['error_url'];
		$checkout->request->decline_url =  $data['decline_url'];

		$order = new Order();
		$order->id = $data['order_id'];
		$order->tax = 0;
		$order->shipping_tax = 0;
		$order->shipping_value = 0;
		$order->total = $data['total'];

		$checkout->request->order = $order;
		try{
			$response = $checkout->process();
			$this->response = new PurchaseResponse($this, $data);
			if($response->isSuccess()){
				$redirectURL = $response->getRedirectUrl();
				$this->response->setRedirectURL($redirectURL);
			} else {
				$responseArray = $response->toArray();
				$message = isset($responseArray['Message']) ? $responseArray['Message'] : null;
				$exception = new InvalidRequestException($message);
				throw $exception;
			}
			return $this->response;

		} catch (\Exception $e){
			$exception = new InvalidRequestException($e->getMessage());
			throw $exception;
		}

		*/

	}


}