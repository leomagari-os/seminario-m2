<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Tudai\CuentaCorriente\Observer;

use \Magento\Framework\Event\ObserverInterface;

class AdminhtmlCustomerSaveAfter implements ObserverInterface
{
  protected $logger;
  protected $adminSession;
  public function __construct(
      \Psr\Log\LoggerInterface $logger,
      \Magento\Backend\Model\Auth\Session $adminSession

  ){
      $this->logger=$logger;
      $this->adminSession=$adminSession;
  }


  public function execute(\Magento\Framework\Event\Observer $observer)
  {
      $customer= $observer->getData('customer');
      $adminUser= $this->adminSession->getUser()->getName();
      $value= $customer->getCustomAttribute('enable_customer_credit')->getValue();
      $customerName=$customer->getFirstName()." ".$customer->getLastName();

      $this->logger->info(sprintf("Observer-%s -Guardado con valor %s por el administrador %s.",$customerName,$value,$adminUser));

  }
}
